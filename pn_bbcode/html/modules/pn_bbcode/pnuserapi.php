<?php
// $Id$
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// Thatware - http://thatware.org/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Hinrich Donner
// changed to pn_bbcode: larsneo
// ----------------------------------------------------------------------

/**
 * @package PostNuke_Utility_Modules
 * @subpackage pn_bbcode
 * @credits to Bravecobra for the phps function (webmaster@bravecobra.com)
 * @license http://www.gnu.org/copyleft/gpl.html
*/

/**
 * the hook function
*/
function pn_bbcode_userapi_transform($args) 
{
    extract($args);

    // Argument check
    if ((!isset($objectid)) ||
        (!isset($extrainfo))) {
        pnSessionSetVar('errormsg', _PNBBCODE_ARGSERROR);
        return;
    }

    if (is_array($extrainfo)) {
        foreach ($extrainfo as $text) {
            $result[] = pn_bbcode_transform($text);
        }
    } else {
        $result = pn_bbcode_transform($extrainfo);
    }

    return $result;
}

/**
 * the wrapper for a string var (simple up to now)
*/
function pn_bbcode_transform($text) 
{
    $message = pn_bbcode_encode($text, $is_html_disabled=false);
    return $message;
}


/**
 * bbdecode/bbencode functions:
 * Rewritten - Nathan Codding - Aug 24, 2000
 * quote, code, and list rewritten again in Jan. 2001.
 * All BBCode tags now implemented. Nesting and multiple occurances should be 
 * handled fine for all of them. Using str_replace() instead of regexps often
 * for efficiency. quote, list, and code are not regular, so they are 
 * implemented as PDAs - probably not all that efficient, but that's the way it is. 
 *
 * Note: all BBCode tags are case-insensitive.
 *
 * some changes for PostNuke: larsneo - Jan, 12, 2003
 * different [img] tag conversion against XSS
 */
function pn_bbcode_encode($message, $is_html_disabled) 
{
	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$message = " " . $message;
	
	// First: If there isn't a "[" and a "]" in the message, don't bother.
	if (! (strpos($message, "[") && strpos($message, "]")) ) {
		// Remove padding, return.
		$message = substr($message, 1);
		return $message;	
	}

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$message = pn_bbcode_encode_code($message, $is_html_disabled);

    // Step 1 - remove all html tags, we do not want to change them!!
    $htmlcount = preg_match_all("/<(?:[^\"\']+?|.+?(?:\"|\').*?(?:\"|\')?.*?)*?>/i", $message, $html);
    for ($i=0; $i < $htmlcount; $i++) {
        $message = preg_replace('/(' . preg_quote($html[0][$i], '/') . ')/', " PNBBCODEHTMLREPLACEMENT{$i} ", $message, 1);
    }

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.	
	$message = pn_bbcode_encode_quote($message);

	// [PHPS] and [/PHPS] for marking php source code
	$message = pn_bbcode_encode_phps($message, $is_html_disabled);

	// [list] and [list=x] for (un)ordered lists.
	$message = pn_bbcode_encode_list($message);

	// [b] and [/b] for bolding text.
	$message = preg_replace("/\[b\](.*?)\[\/b\]/si", "<strong>\\1</strong>", $message);

	// [i] and [/i] for italicizing text.
	$message = preg_replace("/\[i\](.*?)\[\/i\]/si", "<em>\\1</em>", $message);

	// [img]image_url_here[/img] code..
	$message = preg_replace("#\[img\](http://)?(.*?)\[/img\]#si", "<img src=\"http://\\2\" />", $message);
	//$message = preg_replace("/\[img\](.*?)\[\/img\]/si", "<IMG SRC=\"\\1\" BORDER=\"0\">", $message);

    // three new bbcodes, thanks to Chris Miller (r3ap3r)
    // [u] and [/u] for underlining text.
    $message = preg_replace("/\[u\](.*?)\[\/u\]/si", "<span style=\"text-decoration:underline;\">\\1</span>", $message);

    // [color] and [/color] for coloring text.
    if(pnModGetVar('pn_bbcode', 'color_enabled')=="yes") {
        $message = preg_replace("#\[color=black\](.*?)\[/color\]#si", "<span style=\"color:black;\">\\1</span>", $message);
        $message = preg_replace("#\[color=darkred\](.*?)\[/color\]#si", "<span style=\"color:darkred;\">\\1</span>", $message);
        $message = preg_replace("#\[color=red\](.*?)\[/color\]#si", "<span style=\"color:red;\">\\1</span>", $message);
        $message = preg_replace("#\[color=orange\](.*?)\[/color\]#si", "<span style=\"color:orange\\1;\">\\1</span>", $message);
        $message = preg_replace("#\[color=brown\](.*?)\[/color\]#si", "<span style=\"color:brown;\">\\1</span>", $message);
        $message = preg_replace("#\[color=yellow\](.*?)\[/color\]#si", "<span style=\"color:yellow;\">\\1</span>", $message);
        $message = preg_replace("#\[color=green\](.*?)\[/color\]#si", "<span style=\"color:green;\">\\1</span>", $message);
        $message = preg_replace("#\[color=olive\](.*?)\[/color\]#si", "<span style=\"color:olive;\">\\1</span>", $message);
        $message = preg_replace("#\[color=cyan\](.*?)\[/color\]#si", "<span style=\"color:cyan;\">\\1</span>", $message);
        $message = preg_replace("#\[color=blue\](.*?)\[/color\]#si", "<span style=\"color:blue;\">\\1</span>", $message);
        $message = preg_replace("#\[color=darkblue\](.*?)\[/color\]#si", "<span style=\"color:darkblue;\">\\1</span>", $message);
        $message = preg_replace("#\[color=indigo\](.*?)\[/color\]#si", "<span style=\"color:indigo;\">\\1</span>", $message);
        $message = preg_replace("#\[color=violet\](.*?)\[/color\]#si", "<span style=\"color:violet;\">\\1</span>", $message);
        $message = preg_replace("#\[color=white\](.*?)\[/color\]#si", "<span style=\"color:white;\">\\1</span>", $message);
        $message = preg_replace("#\[color=black\](.*?)\[/color\]#si", "<span style=\"color:black;\">\\1</span>", $message);
        // freestyle color
        if(pnModGetVar('pn_bbcode', 'allow_usercolor')=="yes") {
            $message = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "<span style=\"color:\\1;\">\\2</span>", $message);
        } else {
            $message = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "\\2", $message);
        }
    } else {
        $message = preg_replace("#\[color=(.*?)\](.*?)\[/color\]#si", "\\2", $message);
    }
        
    // [size] and [/size] for setting the size of text.
    if(pnModGetVar('pn_bbcode', 'size_enabled')=="yes") {
        $message = preg_replace("/\[size=tiny\](.*?)\[\/size\]/si", "<span style=\"font-size:".pnModGetVar('pn_bbcode', 'size_tiny').";\">\\1</span>", $message);
        $message = preg_replace("/\[size=small\](.*?)\[\/size\]/si", "<span style=\"font-size:".pnModGetVar('pn_bbcode', 'size_small').";\">\\1</span>", $message);
        $message = preg_replace("/\[size=normal\](.*?)\[\/size\]/si", "<span style=\"font-size:".pnModGetVar('pn_bbcode', 'size_normal').";\">\\1</span>", $message);
        $message = preg_replace("/\[size=large\](.*?)\[\/size\]/si", "<span style=\"font-size:".pnModGetVar('pn_bbcode', 'size_large').";\">\\1</span>", $message);
        $message = preg_replace("/\[size=huge\](.*?)\[\/size\]/si", "<span style=\"font-size:".pnModGetVar('pn_bbcode', 'size_huge').";\">\\1</span>", $message);
        // freestyle size
        if(pnModGetVar('pn_bbcode', 'allow_usersize')=="yes") {
            $message = preg_replace("/\[size=([0-9]+)\](.*?)\[\/size\]/si", "<span style=\"font-size:\\1px;\">\\2</span>", $message);
        } else {
            $message = preg_replace("/\[size=([0-9]+)\](.*?)\[\/size\]/si", "\\2", $message);
        }
    } else {
        $message = preg_replace("/\[size=(.*?)\](.*?)\[\/size\]/si", "\\2", $message);
    }
    
	// Patterns and replacements for URL and email tags..
	$patterns = array();
	$replacements = array();

	// [url]xxxx://www.phpbb.com[/url] code..
	$patterns[0] = "#\[url\]([a-z]+?://){1}(.*?)\[/url\]#si";
	$replacements[0] = '<a href="\1\2" >\1\2</a>';

	// [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
	$patterns[1] = "#\[url\](.*?)\[/url\]#si";
	$replacements[1] = '<a href="http://\1">\1</a>';

	// [url=xxxx://www.phpbb.com]phpBB[/url] code.. 
	$patterns[2] = "#\[url=([a-z]+?://){1}(.*?)\](.*?)\[/url\]#si";
	$replacements[2] = '<a href="\1\2">\3</a>';

	// [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
	$patterns[3] = "#\[url=(.*?)\](.*?)\[/url\]#si";
	$replacements[3] = '<a href="http://\1">\2</a>';

	// [email]user@domain.tld[/email] code..
	$patterns[4] = "#\[email\](.*?)\[/email\]#si";
	$replacements[4] = '<a href="mailto:\1">\1</a>';

	$message = preg_replace($patterns, $replacements, $message);

    // replace the links that we removed before
    for ($i = 0; $i < $htmlcount; $i++) {
        $message = preg_replace("/ PNBBCODEHTMLREPLACEMENT{$i} /", $html[0][$i], $message, 1);
    }

	// Remove our padding from the string..
	$message = substr($message, 1);
	return $message;

} // pn_bbcode_encode()

/**
 * Nathan Codding - Jan. 12, 2001.
 * Performs [quote][/quote] bbencoding on the given string, and returns the results.
 * Any unmatched "[quote]" or "[/quote]" token will just be left alone. 
 * This works fine with both having more than one quote in a message, and with nested quotes.
 * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
 *
 * Note: This function assumes the first character of $message is a space, which is added by 
 * bbencode().
 */
function pn_bbcode_encode_quote($message)
{
	// First things first: If there aren't any "[quote=" or "[quote] strings in the message, we don't
	// need to process it at all.
	if (!strpos(strtolower($message), "[quote=") && !strpos(strtolower($message), "[quote]"))
	{
		return $message;	
	}

    add_stylesheet_header();

    $quotebody = pnModGetVar('pn_bbcode', 'quote');
	
	$stack = Array();
	$curr_pos = 1;
	while ($curr_pos && ($curr_pos < strlen($message)))
	{	
		$curr_pos = strpos($message, "[", $curr_pos);
	
		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos)
		{
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending quote tag.
			$possible_start = substr($message, $curr_pos, 6);
			$possible_end_pos = strpos($message, "]", $curr_pos);
			$possible_end = substr($message, $curr_pos, $possible_end_pos - $curr_pos + 1);
			if (strcasecmp("[quote", $possible_start) == 0)
			{
				// We have a starting quote tag.
				// Push its position on to the stack, and then keep going to the right.
				array_push($stack, $curr_pos);
				++$curr_pos;
			}
			else if (strcasecmp("[/quote]", $possible_end) == 0)
			{
				// We have an ending quote tag.
				// Check if we've already found a matching starting tag.
				if (sizeof($stack) > 0)
				{
					// There exists a starting tag. 
					// We need to do 2 replacements now.
					$start_index = array_pop($stack);

					// everything before the [quote=xxx] tag.
					$before_start_tag = substr($message, 0, $start_index);

                    // find the end of the start tag
                    $start_tag_end = strpos($message, "]", $start_index);
                    $start_tag_len = $start_tag_end - $start_index + 1;
                    if($start_tag_len > 7) {
                        $username = substr($message, $start_index + 7, $start_tag_len - 8);
                    } else {
                        $username = 'Zitat';
                    }

					// everything after the [quote=xxx] tag, but before the [/quote] tag.
				    $between_tags = substr($message, $start_index + $start_tag_len, $curr_pos - ($start_index + $start_tag_len));

					// everything after the [/quote] tag.
					$after_end_tag = substr($message, $curr_pos + 8);

                    $quotetext = str_replace('%u', $username, $quotebody);
                    $quotetext = str_replace('%t', $between_tags, $quotetext);
					$message = $before_start_tag . $quotetext . $after_end_tag;
				
					// Now.. we've screwed up the indices by changing the length of the string. 
					// So, if there's anything in the stack, we want to resume searching just after it.
					// otherwise, we go back to the start.
					if (sizeof($stack) > 0)
					{
						$curr_pos = array_pop($stack);
						array_push($stack, $curr_pos);
						++$curr_pos;
					}
					else
					{
						$curr_pos = 1;
					}
				}
				else
				{
					// No matching start tag found. Increment pos, keep going.
					++$curr_pos;	
				}
			}
			else
			{
				// No starting tag or ending tag.. Increment pos, keep looping.,
				++$curr_pos;	
			}
		}
	} // while
	
	return $message;
	
} // pn_bbcode_encode_quote()

/**
 * Nathan Codding - Jan. 12, 2001.
 * Performs [code][/code] bbencoding on the given string, and returns the results.
 * Any unmatched "[code]" or "[/code]" token will just be left alone. 
 * This works fine with both having more than one code block in a message, and with nested code blocks.
 * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
 *
 * Note: This function assumes the first character of $message is a space, which is added by 
 * bbencode().
 */

function pn_bbcode_encode_code($message, $is_html_disabled)
{
	// First things first: If there aren't any "[code]" strings in the message, we don't
	// need to process it at all.
	if (!strpos(strtolower($message), "[code]"))
	{
		return $message;	
	}
	
    add_stylesheet_header();
    $codebody = pnModGetVar('pn_bbcode', 'code');
    
	// Second things second: we have to watch out for stuff like [1code] or [/code1] in the 
	// input.. So escape them to [#1code] or [/code#1] for now:
	$message = preg_replace("/\[([0-9]+?)code\]/si", "[#\\1code]", $message);
	$message = preg_replace("/\[\/code([0-9]+?)\]/si", "[/code#\\1]", $message);
	
	$stack = Array();
	$curr_pos = 1;
	$max_nesting_depth = 0;
	while ($curr_pos && ($curr_pos < strlen($message)))
	{	
		$curr_pos = strpos($message, "[", $curr_pos);
	
		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos)
		{
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending code tag.
			$possible_start = substr($message, $curr_pos, 6);
			$possible_end = substr($message, $curr_pos, 7);
			if (strcasecmp("[code]", $possible_start) == 0)
			{
				// We have a starting code tag.
				// Push its position on to the stack, and then keep going to the right.
				array_push($stack, $curr_pos);
				++$curr_pos;
			}
			else if (strcasecmp("[/code]", $possible_end) == 0)
			{
				// We have an ending code tag.
				// Check if we've already found a matching starting tag.
				if (sizeof($stack) > 0)
				{
					// There exists a starting tag. 
					$curr_nesting_depth = sizeof($stack);
					$max_nesting_depth = ($curr_nesting_depth > $max_nesting_depth) ? $curr_nesting_depth : $max_nesting_depth;
					
					// We need to do 2 replacements now.
					$start_index = array_pop($stack);

					// everything before the [code] tag.
					$before_start_tag = substr($message, 0, $start_index);

					// everything after the [code] tag, but before the [/code] tag.
					$between_tags = substr($message, $start_index + 6, $curr_pos - $start_index - 6);

					// everything after the [/code] tag.
					$after_end_tag = substr($message, $curr_pos + 7);

					$message = $before_start_tag . "[" . $curr_nesting_depth . "code]";
					$message .= $between_tags . "[/code" . $curr_nesting_depth . "]";
					$message .= $after_end_tag;
					
					// Now.. we've screwed up the indices by changing the length of the string. 
					// So, if there's anything in the stack, we want to resume searching just after it.
					// otherwise, we go back to the start.
					if (sizeof($stack) > 0)
					{
						$curr_pos = array_pop($stack);
						array_push($stack, $curr_pos);
						++$curr_pos;
					}
					else
					{
						$curr_pos = 1;
					}
				}
				else
				{
					// No matching start tag found. Increment pos, keep going.
					++$curr_pos;	
				}
			}
			else
			{
				// No starting tag or ending tag.. Increment pos, keep looping.,
				++$curr_pos;	
			}
		}
	} // while
	
	if ($max_nesting_depth > 0)
	{
		for ($i = 1; $i <= $max_nesting_depth; ++$i)
		{
			$start_tag = pn_escape_slashes(preg_quote("[" . $i . "code]"));
			$end_tag = pn_escape_slashes(preg_quote("[/code" . $i . "]"));
			
			$match_count = preg_match_all("/$start_tag(.*?)$end_tag/si", $message, $matches);
	
			for ($j = 0; $j < $match_count; $j++)
			{
				$before_replace = pn_escape_slashes(preg_quote($matches[1][$j]));
				//$after_replace = $matches[1][$j];
                // add line numbers if requested
                if(pnModGetVar('pn_bbcode', 'linenumbers') == 'yes') {
                    $lines = explode("\n", $matches[1][$j]);
                    $after_replace = "";
                    if(is_array($lines) && count($lines)>0) {
                        for($lcnt=0;$lcnt<count($lines); $lcnt++) {
                            $after_replace .= sprintf("%03d", $lcnt+1) . ": " . $lines[$lcnt] . "\n";
                        }
                    }
                } else {
                    $after_replace = $matches[1][$j];
                }
                $after_replace =str_replace("<", "&lt;", $after_replace);
                $after_replace =str_replace(">", "&gt;", $after_replace);
                
                // replace space with entity
                $after_replace =str_replace(" ", "&nbsp;", $after_replace);
                // and tab with for entities
                $after_replace =str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $after_replace);

		        // we have to find this string and replace it	        
				$str_to_match = $start_tag . $before_replace . $end_tag;

                // replace %h with _PNBBCODE_CODE                
				$codetext = str_replace("%h", pnVarPrepForDisplay(_PNBBCODE_CODE), $codebody);
                // replace %c with code                
  	            $codetext = str_replace("%c",  $after_replace, $codetext);
                // replace %e with urlencoded code (prepared for javascript)               
				$codetext = str_replace("%e", urlencode(nl2br($after_replace)), $codetext);
				$message = preg_replace("/$str_to_match/si", "<!--code-->" . $codetext . "<!--/code-->", $message);
			}
		}
	}
	
	// Undo our escaping from "second things second" above..
	$message = preg_replace("/\[#([0-9]+?)code\]/si", "[\\1code]", $message);
	$message = preg_replace("/\[\/code#([0-9]+?)\]/si", "[/code\\1]", $message);
	return $message;
	
} // pn_bbcode_encode_code()

/**
 * Nathan Codding - Jan. 12, 2001.
 * Performs [list][/list] and [list=?][/list] bbencoding on the given string, and returns the results.
 * Any unmatched "[list]" or "[/list]" token will just be left alone. 
 * This works fine with both having more than one list in a message, and with nested lists.
 * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
 *
 * Note: This function assumes the first character of $message is a space, which is added by 
 * bbencode().
 */
function pn_bbcode_encode_list($message)
{		
	$start_length = array();
	$start_length['ordered'] = 8;
	$start_length['unordered'] = 6;

	// First things first: If there aren't any "[list" strings in the message, we don't
	// need to process it at all.
	if (!strpos(strtolower($message), "[list")) {
		return $message;	
	}

    add_stylesheet_header();

	$stack = array();
	$curr_pos = 1;
	while ($curr_pos && ($curr_pos < strlen($message)))	{	
		$curr_pos = strpos($message, "[", $curr_pos);

		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos) {
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending list tag.
			$possible_ordered_start = substr($message, $curr_pos, $start_length['ordered']);
			$possible_unordered_start = substr($message, $curr_pos, $start_length['unordered']);
			$possible_end = substr($message, $curr_pos, 7);
			if (strcasecmp("[list]", $possible_unordered_start) == 0) {
				// We have a starting unordered list tag.
				// Push its position on to the stack, and then keep going to the right.
				array_push($stack, array($curr_pos, ""));
				++$curr_pos;
			} else if (preg_match("/\[list=([a1])\]/si", $possible_ordered_start, $matches)) {
				// We have a starting ordered list tag.
				// Push its position on to the stack, and the starting char onto the start
				// char stack, the keep going to the right.
				array_push($stack, array($curr_pos, $matches[1]));
				++$curr_pos;
			} else if (strcasecmp("[/list]", $possible_end) == 0) {
				// We have an ending list tag.
				// Check if we've already found a matching starting tag.
				if (sizeof($stack) > 0) {
					// There exists a starting tag. 
					// We need to do 2 replacements now.
					$start = array_pop($stack);
					$start_index = $start[0];
					$start_char = $start[1];
					$is_ordered = ($start_char != "");
					$start_tag_length = ($is_ordered) ? $start_length['ordered'] : $start_length['unordered'];

					// everything before the [list] tag.
					$before_start_tag = substr($message, 0, $start_index);

					// everything after the [list] tag, but before the [/list] tag.
					$between_tags = substr($message, $start_index + $start_tag_length, $curr_pos - $start_index - $start_tag_length);
					// Need to replace [*] with <li> inside the list.
					$between_tags = str_replace("[*]", "<li>", $between_tags);
					
					// everything after the [/list] tag.
					$after_end_tag = substr($message, $curr_pos + 7);

					if ($is_ordered) {
						$message = $before_start_tag . '<ol type=' . $start_char . '>';
						$message .= $between_tags . '</ol>';
					} else {
						$message = $before_start_tag . '<ul>';
						$message .= $between_tags . "</ul>";
					}

					$message .= $after_end_tag;
					
					// Now.. we've screwed up the indices by changing the length of the string. 
					// So, if there's anything in the stack, we want to resume searching just after it.
					// otherwise, we go back to the start.
					if (sizeof($stack) > 0) {
						$a = array_pop($stack);
						$curr_pos = $a[0];
						array_push($stack, $a);
						++$curr_pos;
					} else {
						$curr_pos = 1;
					}
				} else {
					// No matching start tag found. Increment pos, keep going.
					++$curr_pos;	
				}
			} else {
				// No starting tag or ending tag.. Increment pos, keep looping.,
				++$curr_pos;	
			}
		}
	} // while

	return $message;

} // pn_bbcode_encode_list()

/**
 * Nathan Codding - Oct. 30, 2000
 *
 * Escapes the "/" character with "\/". This is useful when you need
 * to stick a runtime string into a PREG regexp that is being delimited 
 * with slashes.
 */
function pn_escape_slashes($input)
{
	$output = str_replace('/', '\/', $input);
	return $output;
}

/**
 * larsneo - Jan. 11, 2003
 *
 * removes instances of <br /> since sometimes they are stored in DB :(
 */
function pn_bbcode_br2nl($str) 
{
    return preg_replace("=<br(>|([\s/][^>]*)>)\r?\n?=i", "\n", $str);
}

/**
 * encode php source code
 *
 * Credits for this function go to BraveCobra (webmaster@bravecobra.com)
 *
 */
function pn_bbcode_encode_phps($message, $is_html_disabled)
{
	// First things first: If there aren't any "[phps]" strings in the message, we don't
	// need to process it at all.
	if (!strpos(strtolower($message), "[phps]"))
	{
		return $message;
	}

    add_stylesheet_header();

	// Second things second: we have to watch out for stuff like [1code] or [/code1] in the
	// input.. So escape them to [#1code] or [/code#1] for now:
	$message = preg_replace("/\[([0-9]+?)phps\]/si", "[#\\1phps]", $message);
	$message = preg_replace("/\[\/phps([0-9]+?)\]/si", "[/phps#\\1]", $message);

    $codeheader_start = pnModGetVar('pn_bbcode', 'codeheader_start');
    $codeheader_end   = pnModGetVar('pn_bbcode', 'codeheader_end');
    $codebody_start   = pnModGetVar('pn_bbcode', 'codebody_start');
    $codebody_end     = pnModGetVar('pn_bbcode', 'codebody_end');

    $search = array();
    $replace = array();

    $match_count = preg_match_all("/(\[phps\])(.*?)(\[\/phps\])/si", $message, $matches);
    for($cnt=0; $cnt<$match_count; $cnt++) {
        $replacestr = htmlentities($matches[2][0]);  
//        $replacestr = ereg_replace("&lt;","<", $replacestr);
//        $replacestr = ereg_replace("&gt;",">", $replacestr);
//        $replacestr = ereg_replace("&amp;","&",$replacestr);
        $replacestr = preg_replace("=<br(>|([\s/][^>]*)>)\r?\n?=i", "\n", $replacestr);
        $search[] = "/" . preg_quote($matches[2][0]) . "/";
        $replace[] = highlight_string($replacestr, true);
    }

    // opening tag
    $search[] = "/\[phps\]/si";
    $replace[] = $codeheader_start . _PNBBCODE_CODE . $codeheader_end . $codebody_start;
    // closing tag
    $search[] = "/\[\/phps\]/si";
    $replace[] = $codebody_end;
    $message = preg_replace($search, $replace, $message);
    $message = str_replace("<code>","", $message);
    $message = str_replace("</code>","",$message);
    $message = str_replace("\n\n","\n",$message);

	// Undo our escaping from "second things second" above..
	$message = preg_replace("/\[#([0-9]+?)phps\]/si", "[\\1phps]", $message);
	$message = preg_replace("/\[\/phps#([0-9]+?)\]/si", "[/phps\\1]", $message);
	return $message;

} // bcPhpHighlight_encode_phps()

/**
 * add_stylesheet_header
 *
 */
function add_stylesheet_header()
{
    // add the style sheet file to the additional_header array
    $stylesheet = "modules/pn_bbcode/pnstyle/style.css";
    $stylesheetlink = "<link rel=\"stylesheet\" href=\"$stylesheet\" type=\"text/css\" />";
    global $additional_header;
    if(is_array($additional_header)) {
        $values = array_flip($additional_header);
        if(!array_key_exists($stylesheetlink, $values) && file_exists($stylesheet) && is_readable($stylesheet)) {
            $additional_header[] = $stylesheetlink;
        }
    } else {
        if(file_exists($stylesheet) && is_readable($stylesheet)) {
            $additional_header[] = $stylesheetlink;
        }
    }
    return;
}
?>