<?php

/**
 * BBCode
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class BBCode_Api_User extends Zikula_AbstractApi
{
    /**
     * Code highliter values
     * none 
     */
    const HILITE_NONE = 0;

    /**
     * Code highliter values
     * geshi with linenumbers 
     */
    const HILITE_GESHI_WITH_LN = 1;

    /**
     * Code highliter values
     * geshi without linenumbers
     */
    const HILITE_GESHI_WITHOUT_LN = 2;

    /**
     * Code highliter values
     * google code prettifier
     */
    const HILITE_GOOGLE = 3;
    
    /**
     * the wrapper for a string var (simple up to now)
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
    public function transform($args)
    {
        $message = $args['message'];
        // check the user agent - if it is a bot, return immediately
        $robotslist = array("ia_archiver",
            "googlebot",
            "mediapartners-google",
            "yahoo!",
            "msnbot",
            "jeeves",
            "lycos");
        $useragent = System::serverGetVar('HTTP_USER_AGENT');
        for ($cnt = 0; $cnt < count($robotslist); $cnt++) {
            if (strpos(strtolower($useragent), $robotslist[$cnt]) !== false) {
                return $message;
            }
        }

        // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
        // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
        $message = ' ' . $message;

        // First: If there isn't a "[" and a "]" in the message, don't bother.
        if (!(strpos($message, "[") && strpos($message, "]"))) {
            // Remove padding, return.
            $message = substr($message, 1);
            return $message;
        }

        // [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
        if ($this->getVar('code_enabled')) {
            $message = $this->encode_code($message);
        }

        // move all links out of the text and replace them with placeholders
        $linkscount = preg_match_all('/<a(.*)>(.*)<\/a>/siU', $message, $links);
        for ($i = 0; $i < $linkscount; $i++) {
            $message = preg_replace('/(' . preg_quote($links[0][$i], '/') . ')/', " BBCODELINKREPLACEMENT{$i} ", $message, 1);
        }

        // Step 1 - remove all html tags, we do not want to change them!!
        /* $htmlcount = preg_match_all("/<(?:[^\"\']+?|.+?(?:\"|\').*?(?:\"|\')?.*?)*?>/i", $message, $html); */
        $htmlcount = preg_match_all("#</?\w+((\s+\w+(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)/?>#i", $message, $html);
        for ($i = 0; $i < $htmlcount; $i++) {
            $message = preg_replace('/(' . preg_quote($html[0][$i], '/') . ')/', " BBCODEHTMLREPLACEMENT{$i} ", $message, 1);
        }

        // replace NOPARSE
        $noparsecount = preg_match_all('/\[noparse\](.*)\[\/noparse\]/siU', $message, $noparse);
        for ($i = 0; $i < $noparsecount; $i++) {
            $message = preg_replace('/(' . preg_quote($noparse[0][$i], '/') . ')/', " BBCODENOPARSEREPLACEMENT{$i} ", $message, 1);
        }

        // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
        if ($this->getVar('quote_enabled')) {
            $message = $this->encode_quote($message);
        }

        // [list] and [list=x] for (un)ordered lists.
        $message = $this->encode_list($message);

        // [b] and [/b] for bolding text.
        $message = preg_replace("/\[b\](.*?)\[\/b\]/si", "<strong>\\1</strong>", $message);

        // [i] and [/i] for italicizing text.
        $message = preg_replace("/\[i\](.*?)\[\/i\]/si", "<em>\\1</em>", $message);

        // [img]image_url_here[/img] code..
        if ($this->getVar('lightbox_enabled') == false) {
            // no lightbox :-(
            $message = preg_replace("#\[img\](.*?)\[/img\]#si", '<img class="bbcode_thumbnail" src="\\1" alt="\\1" />', $message);
        } else {
            // use lightbox :-)
            $message = preg_replace("#\[img\](.*?)\[/img\]#si", '<a href="\\1" rel="lightbox" title="\\1"><img class="bbcode_thumbnail" src="\\1" alt="\\1" width="' . DataUtil::formatForDisplay($this->getVar('lightbox_previewwidth')) . '"/></a>', $message, -1, $img_replacement_count);
            if ($img_replacement_count > 0) {
                // load lightbox stuff only if at least one img tag has been found
                PageUtil::addVar('javascript', 'zikula.imageviewer');
            }
        }

        // three new bbcodes, thanks to Chris Miller (r3ap3r)
        // [u] and [/u] for underlining text.
        $message = preg_replace("/\[u\](.*?)\[\/u\]/si", "<span style=\"text-decoration:underline;\">\\1</span>", $message);

        // [color] and [/color] for coloring text.
        if ($this->getVar('color_enabled')) {
            $message = preg_replace("#\[color=black\](.*?)\[/color\]#si", "<span style=\"color:black;\">\\1</span>", $message);
            $message = preg_replace("#\[color=darkred\](.*?)\[/color\]#si", "<span style=\"color:darkred;\">\\1</span>", $message);
            $message = preg_replace("#\[color=red\](.*?)\[/color\]#si", "<span style=\"color:red;\">\\1</span>", $message);
            $message = preg_replace("#\[color=orange\](.*?)\[/color\]#si", "<span style=\"color:orange;\">\\1</span>", $message);
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
            // freestyle color
            if ($this->getVar('allow_usercolor') == "yes") {
                $message = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "<span style=\"color:\\1;\">\\2</span>", $message);
            } else {
                $message = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "\\2", $message);
            }
        } else {
            $message = preg_replace("#\[color=(.*?)\](.*?)\[/color\]#si", "\\2", $message);
        }

        // [size] and [/size] for setting the size of text.
        if ($this->getVar('size_enabled')) {
            $message = preg_replace("/\[size=tiny\](.*?)\[\/size\]/si", "<span style=\"font-size:" . $this->getVar('size_tiny') . ";\">\\1</span>", $message);
            $message = preg_replace("/\[size=small\](.*?)\[\/size\]/si", "<span style=\"font-size:" . $this->getVar('size_small') . ";\">\\1</span>", $message);
            $message = preg_replace("/\[size=normal\](.*?)\[\/size\]/si", "<span style=\"font-size:" . $this->getVar('size_normal') . ";\">\\1</span>", $message);
            $message = preg_replace("/\[size=large\](.*?)\[\/size\]/si", "<span style=\"font-size:" . $this->getVar('size_large') . ";\">\\1</span>", $message);
            $message = preg_replace("/\[size=huge\](.*?)\[\/size\]/si", "<span style=\"font-size:" . $this->getVar('size_huge') . ";\">\\1</span>", $message);
            // freestyle size
            if ($this->getVar('allow_usersize') == "yes") {
                $message = preg_replace("/\[size=([0-9]+)\](.*?)\[\/size\]/si", "<span style=\"font-size:\\1px;\">\\2</span>", $message);
            } else {
                $message = preg_replace("/\[size=([0-9]+)\](.*?)\[\/size\]/si", "\\2", $message);
            }
        } else {
            $message = preg_replace("/\[size=(.*?)\](.*?)\[\/size\]/si", "\\2", $message);
        }

        // [math] and [/math] for posting math code converted via mimetex cgi script
        if ($this->getVar('mimetex_enabled')) {
            $mimetex_url = $this->getVar('mimetex_url');
            if (isset($mimetex_url) && ($mimetex_url != "")) {
                switch (ModUtil::getName()) {
                    case 'Wikula': // for this module we have to use a special syntax
                        $message = preg_replace("/\[math\](.*?)\[\/math\]/si", '{{image url="' . $mimetex_url . '?' . "\\1" . '"}}', $message);
                        break;
                    default:
                        $message = preg_replace("/\[math\](.*?)\[\/math\]/si", "<img src=\"" . $mimetex_url . "?\\1\" />", $message);
                }
            }
        }

        // spoiler tag
        if ($this->getVar('spoiler_enabled')) {
            $spoiler = str_replace('%s', '\\1', $this->getVar('spoiler'));
            $spoiler = str_replace('%h', $this->__('Spoiler follows'), $spoiler);
            $message = preg_replace("/\[spoiler\](.*?)\[\/spoiler\]/si", $spoiler, $message);
        }



        // [url]xxxx://www.phpbb.com[/url] code..
        $message = preg_replace_callback(
                "#\[url\]([a-z]+?://){1}(.*?)\[/url\]#si", Array($this, 'linktest_callback_0'), $message);

        // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
        $message = preg_replace_callback(
                "#\[url\](.*?)\[/url\]#si", Array($this, 'linktest_callback_1'), $message);

        // [url=xxxx://www.phpbb.com]phpBB[/url] code..
        $message = preg_replace_callback(
                "#\[url=([a-z]+?://){1}(.*?)\](.*?)\[/url\]#si", Array($this, 'linktest_callback_2'), $message);

        // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
        $message = preg_replace_callback(
                "#\[url=(.*?)\](.*?)\[/url\]#si", Array($this, 'linktest_callback_3'), $message);

        // [email]user@domain.tld[/email] code..
        $message = preg_replace_callback(
                "#\[email\](.*?)\[/email\]#si", Array($this, 'linktest_callback_4'), $message);

        // restore NOPARSE
        for ($i = 0; $i < $noparsecount; $i++) {
            // trick: [1] contains the text without the real noparse tag, so we do not
            // need to remove them manually
            $message = preg_replace("/ BBCODENOPARSEREPLACEMENT{$i} /", $noparse[1][$i], $message, 1);
        }

        // replace the tags and links that we removed before
        for ($i = 0; $i < $htmlcount; $i++) {
            $message = preg_replace("/ BBCODEHTMLREPLACEMENT{$i} /", $html[0][$i], $message, 1);
        }
        for ($i = 0; $i < $linkscount; $i++) {
            $message = preg_replace("/ BBCODELINKREPLACEMENT{$i} /", $links[0][$i], $message, 1);
        }

        // Remove our padding from the string..
        $message = substr($message, 1);
        return $message;
    }

// bbcode_encode()

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
    public function encode_quote($message)
    {
        // First things first: If there aren't any "[quote=" or "[quote] strings in the message, we don't
        // need to process it at all.
        if (!strpos(strtolower($message), "[quote=") && !strpos(strtolower($message), "[quote]")) {
            return $message;
        }

        $quotebody = str_replace(array("\r", "\n"), '', $this->getVar('quote'));

        $stack = array();
        $curr_pos = 1;
        while ($curr_pos && ($curr_pos < strlen($message))) {
            $curr_pos = strpos($message, "[", $curr_pos);

            // If not found, $curr_pos will be 0, and the loop will end.
            if ($curr_pos) {
                // We found a [. It starts at $curr_pos.
                // check if it's a starting or ending quote tag.
                $possible_start = substr($message, $curr_pos, 6);
                $possible_end_pos = strpos($message, "]", $curr_pos);
                $possible_end = substr($message, $curr_pos, $possible_end_pos - $curr_pos + 1);
                if (strcasecmp("[quote", $possible_start) == 0) {
                    // We have a starting quote tag.
                    // Push its position on to the stack, and then keep going to the right.
                    array_push($stack, $curr_pos);
                    ++$curr_pos;
                } else if (strcasecmp("[/quote]", $possible_end) == 0) {
                    // We have an ending quote tag.
                    // Check if we've already found a matching starting tag.
                    if (sizeof($stack) > 0) {
                        // There exists a starting tag.
                        // We need to do 2 replacements now.
                        $start_index = array_pop($stack);

                        // everything before the [quote=xxx] tag.
                        $before_start_tag = substr($message, 0, $start_index);

                        // find the end of the start tag
                        $start_tag_end = strpos($message, "]", $start_index);
                        $start_tag_len = $start_tag_end - $start_index + 1;
                        if ($start_tag_len > 7) {
                            $username = DataUtil::formatForDisplay(substr($message, $start_index + 7, $start_tag_len - 8));
                        } else {
                            $username = DataUtil::formatForDisplay($this->__('Quote'));
                            ;
                        }

                        // everything after the [quote=xxx] tag, but before the [/quote] tag.
                        $between_tags = substr($message, $start_index + $start_tag_len, $curr_pos - ($start_index + $start_tag_len));
                        // everything after the [/quote] tag.
                        $after_end_tag = substr($message, $curr_pos + 8);

                        $quotetext = str_replace('%u', $username, $quotebody);
                        $quotetext = str_replace('%t', $between_tags, $quotetext);

                        // rfe [ 1243208 ] credits to msandersen
                        // color handling
                        $colors['bgcolor1'] = ThemeUtil::getVar('bgcolor1', '#FFFFFF');
                        $colors['bgcolor2'] = ThemeUtil::getVar('bgcolor2', '#F5F5F5');
                        $colors['bgcolor3'] = ThemeUtil::getVar('bgcolor3', '#E6E6E6');
                        $colors['bgcolor4'] = ThemeUtil::getVar('bgcolor4', '#DDDDDD');
                        $colors['bgcolor5'] = ThemeUtil::getVar('bgcolor5', '#CCCCCC');
                        $colors['sepcolor'] = ThemeUtil::getVar('sepcolor', '#666666');
                        $colors['textcolor1'] = ThemeUtil::getVar('textcolor1', '#000000');
                        $colors['textcolor2'] = ThemeUtil::getVar('textcolor2', '#222222');
                        foreach ($colors as $colorname => $colorvalue) {
                            $quotetext = str_replace('%' . $colorname, $colorvalue, $quotetext);
                        }

                        $message = $before_start_tag . $quotetext . $after_end_tag;

                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (sizeof($stack) > 0) {
                            $curr_pos = array_pop($stack);
                            array_push($stack, $curr_pos);
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
    }

// bbcode_encode_quote()

    /**
     * Nathan Codding - Jan. 12, 2001.
     * Frank Schummertz - Sept. 2004ff
     * Performs [code][/code] bbencoding on the given string, and returns the results.
     * Any unmatched "[code]" or "[/code]" token will just be left alone.
     * This works fine with both having more than one code block in a message, and with nested code blocks.
     * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
     *
     * Note: This function assumes the first character of $message is a space, which is added by
     * bbencode().
     */
    public function encode_code($message)
    {
        $count = preg_match_all("#(\[code=*(.*?)\])(.*?)(\[\/code\])#si", $message, $bbcode);
        // with $message="[code=php,start=25]php code();[/code]" the array $bbode now contains
        // [0] [code=php,start=25]php code();[/code]
        // [1] [code=php,start=25]
        // [2] php,start=25
        // [3] php code();
        // [4] [/code]

        if ($count > 0 && is_array($bbcode)) {
            // 0 = no highlighting
            // 1 = geshi with linenumbers
            // 2 = geshi without linenumbers
            // 3 = google code prettifier
            $hilite = $this->getVar('syntaxhilite');
            $codebody = str_replace("\n", '', "<!--code-->" . $this->getVar('code') . "<!--/code-->");

            for ($i = 0; $i < $count; $i++) {
                // the code in between incl. code tags
                $str_to_match = "/" . preg_quote($bbcode[0][$i], "/") . "/";

                // no parameters, set some defaults
                //$numbers = ($this->getVar('linenumbers')=='yes') ? true : false;
                $language = 'php';
                $startline = 1;
                // analyze parameters in [2]
                if (strlen($bbcode[2][$i]) > 0) {
                    $parameters = explode(',', $bbcode[2][$i]);
                    if (is_array($parameters) && count($parameters) > 0) {
                        // $parameters[0] is the language
                        // everything else must be parsed
                        $language = $parameters[0];
                        // remove it, its no longer used
                        array_shift($parameters);
                        foreach ($parameters as $parameter) {
                            $singleparam = explode('=', trim($parameter));
                            switch (trim(strtolower($singleparam[0]))) {
                                case 'start':
                                    $startline = $singleparam[1];
                                    break;
                                case 'nolines':
                                    if ($hilite == self::HILITE_GESHI_WITH_LN) {
                                        $hilite = self::HILITE_GESHI_WITHOUT_LN;
                                    }
                                    break;
                                case 'user':
                                    // special for htmlmail, we show the user name instead
                                    // of _BBCODE_CODE
                                    $username = $singleparam[1];
                                    break;
                                default:
                            }
                        }
                    }
                } // parameters analyzed
                // pagesetter workaround:
                if (ModUtil::getName() == 'pagesetter') {
                    $bbcode[3][$i] = html_entity_decode($bbcode[3][$i]);
                }
                $after_replace = trim($bbcode[3][$i]);

                // finally decide which language to use
                switch ($hilite) {
                    case self::HILITE_NONE:
                        $after_replace = '<code>' . nl2br(DataUtil::formatForDisplay($after_replace)) . '</code>';
                        break;
                    case self::HILITE_GESHI_WITH_LN:
                    case self::HILITE_GESHI_WITHOUT_LN:
                        if (!class_exists('GeSHi')) {
                            include_once 'modules/BBCode/includes/geshi.php';
                        }
                        $geshi = new GeSHi($after_replace, $language, 'modules/BBCode/includes/geshi/');
                        $geshi->set_tab_width(4);
                        $geshi->set_case_keywords(GESHI_CAPS_LOWER);
                        $geshi->set_header_type(GESHI_HEADER_DIV);
                        $geshi->set_link_styles(GESHI_LINK, 'padding-left: 0px; background-image: none;');
                        $geshi->set_link_styles(GESHI_HOVER, 'padding-left: 0px; background-image: none;');
                        $geshi->set_link_styles(GESHI_ACTIVE, 'padding-left: 0px; background-image: none;');
                        $geshi->set_link_styles(GESHI_VISITED, 'padding-left: 0px; background-image: none;');
                        if ($hilite == self::HILITE_GESHI_WITH_LN) {
                            $geshi->set_line_style('color: blue; font-weight: bold;', 'color: green;');
                            $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
                            $geshi->start_line_numbers_at($startline);
                        } else {
                            $geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
                        }
                        $after_replace = $geshi->parse_code();
                        // remove \n for single linespacing
                        $after_replace = str_replace("\n", '', $after_replace);
                        break;
                    case self::HILITE_GOOGLE:
                    default:
                        PageUtil::addVar('stylesheet', 'modules/BBCode/javascript/google-code-prettify/prettify.css');
                        PageUtil::addVar('javascript', 'modules/BBCode/javascript/google-code-prettify/prettify.js');
                        PageUtil::addVar('javascript', 'modules/BBCode/javascript/BBCode.User.Hook.PrettifyLoader.js');
                        $after_replace = '<pre class="prettyprint">' . DataUtil::formatForDisplay($after_replace) . '</pre>';
                        break;
                }

                // replace %h with _BBCODE_CODE
                if ($language == 'htmlmail') {
                    $codetext = str_replace("%h", DataUtil::formatForDisplay($this->__('From')) . ': ' . DataUtil::formatForDisplay($username), $codebody);
                } else {
                    $codetext = str_replace("%h", DataUtil::formatForDisplay($this->__('Code')), $codebody);
                }
                // replace %c with code
                $codetext = str_replace("%c", $after_replace, $codetext);
                // replace %e with urlencoded code (prepared for javascript)
                $codetext = str_replace("%e", urlencode(nl2br($after_replace)), $codetext);
                // my fault, admin panel says %j, so we do both :-)
                $codetext = str_replace("%j", urlencode(nl2br($after_replace)), $codetext);

                // rfe [ 1243208 ] credits to msandersen
                // color handling
                $colors['bgcolor1'] = ThemeUtil::getVar('bgcolor1', '#FFFFFF');
                $colors['bgcolor2'] = ThemeUtil::getVar('bgcolor2', '#F5F5F5');
                $colors['bgcolor3'] = ThemeUtil::getVar('bgcolor3', '#E6E6E6');
                $colors['bgcolor4'] = ThemeUtil::getVar('bgcolor4', '#DDDDDD');
                $colors['bgcolor5'] = ThemeUtil::getVar('bgcolor5', '#CCCCCC');
                $colors['sepcolor'] = ThemeUtil::getVar('sepcolor', '#666666');
                $colors['textcolor1'] = ThemeUtil::getVar('textcolor1', '#000000');
                $colors['textcolor2'] = ThemeUtil::getVar('textcolor2', '#222222');
                foreach ($colors as $colorname => $colorvalue) {
                    $codetext = str_replace("%{$colorname}", $colorvalue, $codetext);
                }

                $message = preg_replace($str_to_match, $codetext, $message);
            }
            //$message = str_replace("\n\n","\n",$message);
        }
        return $message;
    }

// bbcode_encode_code()

    /**
     * Nathan Codding - Jan. 12, 2001.
     * Frank Schummertz - Sept. 2004ff
     * Performs [list][/list] and [list=?][/list] bbencoding on the given string, and returns the results.
     * Any unmatched "[list]" or "[/list]" token will just be left alone.
     * This works fine with both having more than one list in a message, and with nested lists.
     * Since that is not a regular language, this is actually a PDA and uses a stack. Great fun.
     *
     * Note: This function assumes the first character of $message is a space, which is added by
     * bbencode().
     */
    public function encode_list($message)
    {
        $start_length = array('ordered' => 8,
            'unordered' => 6);

        // First things first: If there aren't any "[list" strings in the message, we don't
        // need to process it at all.
        if (!strpos(strtolower($message), "[list")) {
            return $message;
        }

        $stack = array();
        $curr_pos = 1;
        while ($curr_pos && ($curr_pos < strlen($message))) {
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
                    $new_between_tags = '';
                    if (sizeof($stack) > 0) {
                        // There exists a starting tag.
                        // We need to do 2 replacements now.
                        $start = array_pop($stack);
                        $start_index = $start[0];
                        $start_char = $start[1];
                        $is_ordered = ($start_char != "");

                        // configure list style
                        // to-do: think about definition lists...
                        if ($is_ordered) {
                            // ordered list
                            // $listitemclass    = 'bbcode_orderedlist_item';
                            $start_tag_length = $start_length['ordered'];
                            $start_tag = '<ol type="' . $start_char . '" class="bbcode_list">';
                            $end_tag = '</ol>';
                        } else {
                            // list
                            // $listitemclass    = 'bbcode_list_item';
                            $start_tag_length = $start_length['unordered'];
                            $start_tag = '<ul class="bbcode_list">';
                            $end_tag = '</ul>';
                        }

                        // everything before the [list] tag.
                        $before_start_tag = substr($message, 0, $start_index);

                        // everything between [list] and [/list] tags.
                        $between_tags = substr($message, $start_index + $start_tag_length, $curr_pos - $start_index - $start_tag_length);

                        // everything after the [/list] tag.
                        $after_end_tag = substr($message, $curr_pos + 7);

                        // replace [*]... with <li>...</li>
                        // even newer: adding of css classes for better styling of bbcode lists not needed with intelligent css,
                        //             see modules/BBCode/style/style.css
                        $listitems = explode('[*]', $between_tags);
                        // listitems may be false, empty or containing [*] if between_tags was empty
                        if (is_array($listitems) && count($listitems) > 0 && $listitems[0] <> '[*]') {
                            for ($cnt = 1; $cnt < count($listitems); $cnt++) {
                                if (!empty($listitems[$cnt])) {
                                    $new_between_tags .= '<li>' . $listitems[$cnt] . '</li>';
                                }
                            }
                        }

                        $message = $before_start_tag
                                . $start_tag
                                . $new_between_tags
                                . $end_tag
                                . $after_end_tag;

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
    }

// bbcode_encode_list()

    /**
     * get_geshi_languages
     * read the languages supported by GeSHi for display in a dropdown list
     *
     */
    public function get_geshi_languages()
    {
        $langs = array();
        if (($this->getVar('syntaxhilite') == self::HILITE_GESHI_WITH_LN) || ($this->getVar('syntaxhilite') == self::HILITE_GESHI_WITHOUT_LN)) {
            $langsfound = FileUtil::getFiles('modules/BBCode/includes/geshi', false, false, '.php', false);
            foreach ($langsfound as $langfound) {
                $langs[] = str_replace(array('modules/BBCode/includes/geshi/', '.php'), '', $langfound);
            }
            asort($langs);
        }
        return $langs;
    }

    /**
     * linktest_callback_0
     * [url]xxxx://www.phpbb.com[/url]
     *      +++++++
     *      matches[1]
     *             +++++++++++++
     *             matches[2]
     *
     */
    protected function linktest_callback_0($matches)
    {

        static $is_allowed;
        static $modname;
        static $our_url;

        if (!isset($is_allowed)) {
            $modname = ModUtil::getName();
            $our_url = System::getBaseUrl();
            $is_allowed = SecurityUtil::checkPermission('bbcode:' . $modname . ':Links', '::', ACCESS_READ);
        }
        if (($is_allowed == false) && (strpos($matches[1] . $matches[2], $our_url) === false)) {
            // not allowed to see links and link is not on our site
            if (UserUtil::isLoggedIn()) {
                return DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*'));
            } else {
                return '<a href="user.php" title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '">' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '</a>';
            }
        } else {
            $matches[1] = trim(strip_Tags($matches[1]));
            $matches[2] = trim(strip_tags($matches[2]));

            $displayurl = $this->minimize_displayurl($matches[1] . $matches[2]);
            return '<a href="' . $matches[1] . $matches[2] . '">' . $displayurl . '</a>';
        }
    }

    /**
     * linktest_callback_1
     * [url]www.phpbb.com[/url] (no xxxx:// prefix).
     *      +++++++++++++
     *      matches[1]
     *
     */
    protected function linktest_callback_1($matches)
    {

        static $is_allowed;
        static $modname;
        static $our_url;

        if (!isset($is_allowed)) {
            $modname = ModUtil::getName();
            $our_url = System::getBaseUrl();
            $is_allowed = SecurityUtil::checkPermission('bbcode:' . $modname . ':Links', '::', ACCESS_READ);
        }

        // try to find out if we have encountered an internal url
        if (!System::varValidate($matches[1], 'url')) {
            $entrypoint = System::getVar('entrypoint', 'index.php');
            if ((strpos($matches[1], $entrypoint) === 0) || (strpos($matches[1], 'module-') === 0)) {
                $matches[1] = System::getBaseUrl() . $matches[1];
            } else {
                $matches[1] = 'http://' . $matches[1];
            }
        }

        if (($is_allowed == false) && (strpos($matches[1], $our_url) === false)) {
            // not allowed to see links and link is not on our site
            if (UserUtil::isLoggedIn()) {
                return DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*'));
            } else {
                return '<a href="user.php" title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '">' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '</a>';
            }
        } else {
            $displayurl = $this->minimize_displayurl($matches[1]);
            return '<a href="' . $matches[1] . '">' . $displayurl . '</a>';
        }
    }

    /**
     * linktest_callback_2
     * [url=xxxx://www.phpbb.com]phpBB[/url]
     *      +++++++
     *      matches[1]
     *             +++++++++++++
     *             matches[2]
     *                           +++++
     *                           matches[3]
     */
    protected function linktest_callback_2($matches)
    {

        static $is_allowed;
        static $modname;
        static $our_url;

        if (!isset($is_allowed)) {
            $modname = ModUtil::getName();
            $our_url = System::getBaseUrl();
            $is_allowed = SecurityUtil::checkPermission('bbcode:' . $modname . ':Links', '::', ACCESS_READ);
        }

        if ((System::varValidate($matches[3], 'url') == true) && ($is_allowed == false) && (strpos($matches[3], $our_url) === false)) {
            $displayurl = DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*'));
        } else {
            $displayurl = $matches[3];
            $title = strip_tags($displayurl);
            $displayurl = trim($this->minimize_displayurl($displayurl));
        }
        if (($is_allowed == false) && (strpos($matches[1] . $matches[2], $our_url) === false)) {
            // not allowed to see links and link is not on our site
            if (UserUtil::isLoggedIn()) {
                return '<span title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '">' . $displayurl . '</span>';
            } else {
                return '<a href="user.php" title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '">' . $displayurl . '</a>';
            }
        } else {
            return '<a href="' . $matches[1] . $matches[2] . '" title="' . $title . '">' . $displayurl . '</a>';
        }
    }

    /**
     * linktest_callback_3
     * [url=www.phpbb.com]phpBB[/url] (no xxxx:// prefix).
     *      +++++++++++++
     *      maches[1]
     *                    +++++
     *                    matches[2]
     *
     */
    protected function linktest_callback_3($matches)
    {

        static $is_allowed;
        static $modname;
        static $our_url;

        if (!isset($is_allowed)) {
            $modname = ModUtil::getName();
            $our_url = System::getBaseUrl();
            $is_allowed = SecurityUtil::checkPermission('bbcode:' . $modname . ':Links', '::', ACCESS_READ);
        }

        // try to find out if we have encountered an internal url
        if (!System::varValidate($matches[1], 'url')) {
            $entrypoint = System::getVar('entrypoint', 'index.php');
            if ((strpos($matches[1], $entrypoint) === 0) || (strpos($matches[1], 'module-') === 0)) {
                $matches[1] = System::getBaseUrl() . $matches[1];
            } else {
                $matches[1] = 'http://' . $matches[1];
            }
        }

        if (System::varValidate($matches[2], 'url') == true) {
            $displayurl = DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*'));
        } else {
            $displayurl = $matches[2];
            $title = strip_tags($displayurl);
            $displayurl = trim($this->minimize_displayurl($displayurl));
        }
        if (($is_allowed == false) && (strpos($matches[1], $our_url) === false)) {
            // not allowed to see links and link is not on our site
            if (UserUtil::isLoggedIn()) {
                return '<span title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '"><strong>' . $displayurl . '</strong></span>';
            } else {
                return '<a href="user.php" title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see the external links*')) . '">' . $displayurl . '</a>';
            }
        } else {
            return '<a href="' . $matches[1] . '" title="' . $title . '">' . $displayurl . '</a>';
        }
    }

    /**
     * linktest_callback_4
     * [email]user@domain.tld[/email]
     *
     */
    protected function linktest_callback_4($matches)
    {

        static $is_allowed;
        static $modname;

        if (!isset($is_allowed)) {
            $modname = ModUtil::getName();
            $is_allowed = SecurityUtil::checkPermission('bbcode:' . $modname . ':Emails', '::', ACCESS_READ);
        }
        if ($is_allowed == false) {
            // not allowed to see emails
            if (UserUtil::isLoggedIn()) {
                return DataUtil::formatForDisplay($this->__('*Not allowed to see emails*'));
            } else {
                return '<a href="user.php" title="' . DataUtil::formatForDisplay($this->__('*Not allowed to see emails*')) . '">' . DataUtil::formatForDisplay($this->__('*Not allowed to see emails*')) . '</a>';
            }
        } else {
            return '<a href="mailto:' . $matches[1] . '" title="' . $matches[1] . '">' . $matches[1] . '</a>';
        }
    }

    /** bbcode_minimize_displayurl
     *  helper function to cut down the displayed url to a maximum length
     *
     *
     */
    public function minimize_displayurl($displayurl)
    {
        // get the maximum size of the urls to show
        $maxsize = ModUtil::getVar('BBCode', 'link_shrinksize');
        if ($maxsize <> 0 && strlen($displayurl) > $maxsize) {
            $before = round($maxsize / 2);
            $after = $maxsize - 1 - $before;
            $displayurl = substr($displayurl, 0, $before) . "&hellip;" . substr($displayurl, strlen($displayurl) - $after, $after);
        }
        return $displayurl;
    }

}
