<?php
// $Id$
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

// begin of no-change-area
// do NOT change the following lines. Although theysa are not language
// relevant they are important for this module
// 0 = no highlighting
define('HILITE_NONE', 0);
// 1 = geshi with linenumbers
define('HILITE_GESHI_WITH_LN', 1);
// 2 = geshi without linenumbers
define('HILITE_GESHI_WITHOUT_LN', 2);
// 3 = google code prettifier
define('HILITE_GOOGLE', 3);
// end of no-change-area

// new in 2.0
define('_BBCODE_GOTOHOMEPAGE', 'visit the bbcode project site');
define('_BBCODE_ADMIN_START', 'Start');
define('_BBCODE_ISHOOKEDWITH', 'Actually bbcode is used with the following modules');
define('_BBCODE_NOTHOOKED', '** bbcode is not used with any module **');
define('_BBCODE_ADDHOOK', 'Activate bbcode for more modules');
define('_BBCODE_ILLEGALVALUE', 'illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%');
define('_BBCODE_CODE_ENABLE', 'Enable code highlighting');
define('_BBCODE_QUOTE_ENABLE', 'Enable quote highlighting');
define('_BBCODE_ADMINMISCCONFIG', 'misc config');
define('_BBCODE_IMGTAGCONFIG', 'IMG-Tag configuration');
define('_BBCODE_LIGHTBOX_ENABLE', 'Use Lightbox in img-tag'); 
define('_BBCODE_LIGHTBOX_PREVIEWWIDTH', 'Width of preview image');
define('_BBCODE_LIGHTBOX_PREVIEWWIDTHINFO', '(50-1000px)');
define('_BBCODE_LIGHTBOX_PREVIEWHEIGHTINFO', 'Height will be calculated by the browser automatically.');
define('_BBCODE_ADMINCONFIG', 'Configuration');
define('_BBCODE_LINK_SHRINKSIZE', 'Shrink links to');
define('_BBCODE_LINK_SHRINKSIZEINFO', 'Shrinks the urls shown to the specified length, 0=no action');
define('_BBCODE_CHARS', 'chars');
define('_BBCODE_SPOILER_ENABLE', 'Enable spoiler tag');
define('_BBCODE_SPOILERCODE', 'HTML for spoiler tag');
define('_BBCODE_SPOILERHINT', '%h = Heading (_BBCODE_SPOILERWARNING), %s = text.');
define('_BBCODE_SPOILERWARNING', 'Spoiler follows:');
define('_BBCODE_SPOILER', 'spoiler');
define('_BBCODE_SPOILER_HINT', 'hide text');

define('_BBCODE_HELPURL', 'http://en.wikipedia.org/wiki/BBCode');
define('_BBCODE_HELPURL_HINT', 'Was ist BBCode?');
define('_BBCODE_ADMINCODECONFIG', 'Configuration [code][/code]');
define('_BBCODE_ADMINCOLORCONFIG', 'Configuration [color][/color]');
define('_BBCODE_ADMINISTRATION', 'bbcode Administration');
define('_BBCODE_ADMINQUOTECONFIG', 'Configuration [quote][/quote]');
define('_BBCODE_ADMINSIZECONFIG', 'Configuration [size][/size]');
define('_BBCODE_ARGSERROR',                 '[bbcode] Internal error! Arguments missing!');
define('_BBCODE_BOLD', 'b');
define('_BBCODE_BOLD_HINT', 'bold text');
define('_BBCODE_CODE', 'Code');
define('_BBCODE_CODEHINT', '%h = Header (_BBCODE_CODE), %c=lines of code, %j=lines of code, escaped for javascript');
define('_BBCODE_CODE_HINT', 'insert code');
define('_BBCODE_CODE_SYNTAXHIGHLIGHTING', 'Select code highlight mode');
define('_BBCODE_CODE_NOSYNTAXHIGHLIGHTING', 'no highlighting');
define('_BBCODE_CODE_GESHIWITHLINENUMBERS', 'GeSHi with line numbers');
define('_BBCODE_CODE_GESHIWITHOUTLINENUMBERS', 'GeSHi without line numbers');
define('_BBCODE_CODE_GOOGLEPRETTIFIER', 'Google Code Prettifier');
define('_BBCODE_COLOR_ALLOWUSERCOLOR', 'Allow userdefined text color');
define('_BBCODE_COLOR_BLACK', 'Black');
define('_BBCODE_COLOR_BLUE', 'Blue');
define('_BBCODE_COLOR_BROWN', 'Brown');
define('_BBCODE_COLOR_CYAN', 'Cyan');
define('_BBCODE_COLOR_DARKBLUE', 'Dark Blue');
define('_BBCODE_COLOR_DARKRED', 'Dark Red');
define('_BBCODE_COLOR_DEFAULT', 'Standard');
define('_BBCODE_COLOR_DEFINE', 'self defined color');
define('_BBCODE_COLOR_ENABLE', 'Enable flexible text colors');
define('_BBCODE_COLOR_GREEN', 'Green');
define('_BBCODE_COLOR_HINT', 'select font color');
define('_BBCODE_COLOR_INDIGO', 'Indigo');
define('_BBCODE_COLOR_OLIVE', 'Olive');
define('_BBCODE_COLOR_ORANGE', 'Orange');
define('_BBCODE_COLOR_RED', 'Red');
define('_BBCODE_COLOR_TEXTCOLORCODE', 'enter color code');
define('_BBCODE_COLOR_VIOLET', 'Violet');
define('_BBCODE_COLOR_WHITE', 'White');
define('_BBCODE_COLOR_YELLOW', 'Yellow');
define('_BBCODE_CONFIGCHANGED', 'Configuration has been changed');
define('_BBCODE_ENTER_EMAIL_ADDRESS','Enter the email address you want to add');
define('_BBCODE_ENTER_LIST_ITEM','Enter the new list item. Note that each list group must be preceeded by a List Open and must be ended with List Close');
define('_BBCODE_ENTER_PAGE_TITLE','Page title');
define('_BBCODE_ENTER_SITE_TITLE','Enter the web site title');
define('_BBCODE_ENTER_TEXT_BOLD','Enter the text that you want to make bold');
define('_BBCODE_ENTER_TEXT_ITALIC','Enter the text that you want to make italic');
define('_BBCODE_ENTER_TEXT_UNDERLINE','enter the underlined text');
define('_BBCODE_ENTER_URL','Enter the URL for the link you want to add');
define('_BBCODE_ENTER_WEBIMAGE_URL','Enter the URL for the image you want to display');
define('_BBCODE_FONTCOLOR', 'Font color');
define('_BBCODE_FONTSIZE', 'Font size');
define('_BBCODE_IMAGE', 'Image');
define('_BBCODE_IMAGE_HINT', 'insert an image');
define('_BBCODE_ITALIC', 'i');
define('_BBCODE_ITALIC_HINT', 'italic text');
define('_BBCODE_LIST_HINT', 'insert list');
define('_BBCODE_LISTCLOSE', '/ul');
define('_BBCODE_LISTCLOSE_HINT', 'close list');
define('_BBCODE_LISTITEM', 'li');
define('_BBCODE_LISTITEM_HINT', 'add list entry');
define('_BBCODE_LISTOPEN', 'ul');
define('_BBCODE_LISTOPEN_HINT', 'open list');
define('_BBCODE_MAIL', 'Email');
define('_BBCODE_MAIL_HINT', 'insert an email address');
define('_BBCODE_NO', 'No');
define('_BBCODE_NOAUTH', 'No permission');
define('_BBCODE_NOSCRIPTWARNING', 'Your browser does not support javascript or you turned it off. The bbcode interface has been disabled.');
define('_BBCODE_NOSPECIALCODE', 'no special code');
define('_BBCODE_NOTALLOWEDTOSEEEMAILS', '*Not allowed to see emails*');
define('_BBCODE_NOTALLOWEDTOSEEEXTERNALLINKS', '*Not allowed to see the external links*');
define('_BBCODE_ORIGINALSENDER', 'From');
define('_BBCODE_PNADMINISTRATION', 'Administration');
define('_BBCODE_PREVIEW','Preview');
define('_BBCODE_QUOTE', 'Quote');
define('_BBCODE_QUOTEHINT', '%u = username, %t=quoted text');
define('_BBCODE_QUOTE_HINT', 'insert quote');
define('_BBCODE_SELECTCODE', 'select code type');
define('_BBCODE_SIZE_ALLOWUSERSIZE', 'Allow userdefined text size');
define('_BBCODE_SIZE_DEFINE', 'self defined size');
define('_BBCODE_SIZE_ENABLE', 'Enable flexible text size');
define('_BBCODE_SIZE_HINT', 'select font size');
define('_BBCODE_SIZE_HUGE', 'Huge');
define('_BBCODE_SIZE_LARGE', 'Large');
define('_BBCODE_SIZE_NORMAL', 'Normal');
define('_BBCODE_SIZE_SMALL', 'Small');
define('_BBCODE_SIZE_TEXTSIZE', 'enter text size');
define('_BBCODE_SIZE_TINY', 'Tiny');
define('_BBCODE_UNDERLINE', 'u');
define('_BBCODE_UNDERLINE_HINT', 'underlined text');
define('_BBCODE_URL', 'URL');
define('_BBCODE_URL_HINT', 'insert a link');
define('_BBCODE_YES', 'Yes');
