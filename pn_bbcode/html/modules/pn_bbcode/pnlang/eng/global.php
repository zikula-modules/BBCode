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
define('_PNBBCODE_GOTOHOMEPAGE', 'visit the pn_bbcode project site on NOC');
define('_PNBBCODE_ADMIN_START', 'Start');
define('_PNBBCODE_ISHOOKEDWITH', 'Actually pn_bbcode is used with the following modules');
define('_PNBBCODE_NOTHOOKED', '** pn_bbcode is not used with any module **');
define('_PNBBCODE_ADDHOOK', 'Activate pn_bbcode for more modules');
define('_PNBBCODE_ILLEGALVALUE', 'illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%');
define('_PNBBCODE_CODE_ENABLE', 'Enable code highlighting');
define('_PNBBCODE_QUOTE_ENABLE', 'Enable quote highlighting');
define('_PNBBCODE_ADMINMISCCONFIG', 'misc config');
define('_PNBBCODE_IMGTAGCONFIG', 'IMG-Tag configuration');
define('_PNBBCODE_LIGHTBOX_ENABLE', 'Use Lightbox in img-tag'); 
define('_PNBBCODE_LIGHTBOX_PREVIEWWIDTH', 'Width of preview image');
define('_PNBBCODE_LIGHTBOX_PREVIEWWIDTHINFO', '(50-1000px)');
define('_PNBBCODE_LIGHTBOX_PREVIEWHEIGHTINFO', 'Height will be calculated by the browser automatically.');
define('_PNBBCODE_ADMINCONFIG', 'Configuration');
define('_PNBBCODE_LINK_SHRINKSIZE', 'Shrink links to');
define('_PNBBCODE_LINK_SHRINKSIZEINFO', 'Shrinks the urls shown to the specified length, 0=no action');
define('_PNBBCODE_CHARS', 'chars');

define('_PNBBCODE_HELPURL', 'http://en.wikipedia.org/wiki/BBCode');
define('_PNBBCODE_HELPURL_HINT', 'Was ist BBCode?');
define('_PNBBCODE_ADMINCODECONFIG', 'Configuration [code][/code]');
define('_PNBBCODE_ADMINCOLORCONFIG', 'Configuration [color][/color]');
define('_PNBBCODE_ADMINISTRATION', 'pn_bbcode Administration');
define('_PNBBCODE_ADMINQUOTECONFIG', 'Configuration [quote][/quote]');
define('_PNBBCODE_ADMINSIZECONFIG', 'Configuration [size][/size]');
define('_PNBBCODE_ARGSERROR',                 '[pn_bbcode] Internal error! Arguments missing!');
define('_PNBBCODE_BOLD', 'b');
define('_PNBBCODE_BOLD_HINT', 'bold text');
define('_PNBBCODE_CODE', 'Code');
define('_PNBBCODE_CODEHINT', '%h = Header (_PNBBCODE_CODE), %c=lines of code, %j=lines of code, escaped for javascript');
define('_PNBBCODE_CODE_HINT', 'insert code');
define('_PNBBCODE_CODE_SYNTAXHIGHLIGHTING', 'Select code highlight mode');
define('_PNBBCODE_CODE_NOSYNTAXHIGHLIGHTING', 'no highlighting');
define('_PNBBCODE_CODE_GESHIWITHLINENUMBERS', 'GeSHi with line numbers');
define('_PNBBCODE_CODE_GESHIWITHOUTLINENUMBERS', 'GeSHi without line numbers');
define('_PNBBCODE_CODE_GOOGLEPRETTIFIER', 'Google Code Prettifier');
define('_PNBBCODE_COLOR_ALLOWUSERCOLOR', 'Allow userdefined text color');
define('_PNBBCODE_COLOR_BLACK', 'Black');
define('_PNBBCODE_COLOR_BLUE', 'Blue');
define('_PNBBCODE_COLOR_BROWN', 'Brown');
define('_PNBBCODE_COLOR_CYAN', 'Cyan');
define('_PNBBCODE_COLOR_DARKBLUE', 'Dark Blue');
define('_PNBBCODE_COLOR_DARKRED', 'Dark Red');
define('_PNBBCODE_COLOR_DEFAULT', 'Standard');
define('_PNBBCODE_COLOR_DEFINE', 'self defined color');
define('_PNBBCODE_COLOR_ENABLE', 'Enable flexible text colors');
define('_PNBBCODE_COLOR_GREEN', 'Green');
define('_PNBBCODE_COLOR_HINT', 'select font color');
define('_PNBBCODE_COLOR_INDIGO', 'Indigo');
define('_PNBBCODE_COLOR_OLIVE', 'Olive');
define('_PNBBCODE_COLOR_ORANGE', 'Orange');
define('_PNBBCODE_COLOR_RED', 'Red');
define('_PNBBCODE_COLOR_TEXTCOLORCODE', 'enter color code');
define('_PNBBCODE_COLOR_VIOLET', 'Violet');
define('_PNBBCODE_COLOR_WHITE', 'White');
define('_PNBBCODE_COLOR_YELLOW', 'Yellow');
define('_PNBBCODE_CONFIGCHANGED', 'Configuration has been changed');
define('_PNBBCODE_ENTER_EMAIL_ADDRESS','Enter the email address you want to add');
define('_PNBBCODE_ENTER_LIST_ITEM','Enter the new list item. Note that each list group must be preceeded by a List Open and must be ended with List Close');
define('_PNBBCODE_ENTER_PAGE_TITLE','Page title');
define('_PNBBCODE_ENTER_SITE_TITLE','Enter the web site title');
define('_PNBBCODE_ENTER_TEXT_BOLD','Enter the text that you want to make bold');
define('_PNBBCODE_ENTER_TEXT_ITALIC','Enter the text that you want to make italic');
define('_PNBBCODE_ENTER_TEXT_UNDERLINE','enter the underlined text');
define('_PNBBCODE_ENTER_URL','Enter the URL for the link you want to add');
define('_PNBBCODE_ENTER_WEBIMAGE_URL','Enter the URL for the image you want to display');
define('_PNBBCODE_FONTCOLOR', 'Font color');
define('_PNBBCODE_FONTSIZE', 'Font size');
define('_PNBBCODE_IMAGE', 'Image');
define('_PNBBCODE_IMAGE_HINT', 'insert an image');
define('_PNBBCODE_ITALIC', 'i');
define('_PNBBCODE_ITALIC_HINT', 'italic text');
define('_PNBBCODE_LIST_HINT', 'insert list');
define('_PNBBCODE_LISTCLOSE', '/ul');
define('_PNBBCODE_LISTCLOSE_HINT', 'close list');
define('_PNBBCODE_LISTITEM', 'li');
define('_PNBBCODE_LISTITEM_HINT', 'add list entry');
define('_PNBBCODE_LISTOPEN', 'ul');
define('_PNBBCODE_LISTOPEN_HINT', 'open list');
define('_PNBBCODE_MAIL', 'Email');
define('_PNBBCODE_MAIL_HINT', 'insert an email address');
define('_PNBBCODE_NO', 'No');
define('_PNBBCODE_NOAUTH', 'No permission');
define('_PNBBCODE_NOSCRIPTWARNING', 'Your browser does not support javascript or you turned it off. The pn_bbcode interface has been disabled.');
define('_PNBBCODE_NOSPECIALCODE', 'no special code');
define('_PNBBCODE_NOTALLOWEDTOSEEEMAILS', '*Not allowed to see emails*');
define('_PNBBCODE_NOTALLOWEDTOSEEEXTERNALLINKS', '*Not allowed to see the external links*');
define('_PNBBCODE_ORIGINALSENDER', 'From');
define('_PNBBCODE_PNADMINISTRATION', 'Administration');
define('_PNBBCODE_PREVIEW','Preview');
define('_PNBBCODE_QUOTE', 'Quote');
define('_PNBBCODE_QUOTEHINT', '%u = username, %t=quoted text');
define('_PNBBCODE_QUOTE_HINT', 'insert quote');
define('_PNBBCODE_SELECTCODE', 'select code type');
define('_PNBBCODE_SIZE_ALLOWUSERSIZE', 'Allow userdefined text size');
define('_PNBBCODE_SIZE_DEFINE', 'self defined size');
define('_PNBBCODE_SIZE_ENABLE', 'Enable flexible text size');
define('_PNBBCODE_SIZE_HINT', 'select font size');
define('_PNBBCODE_SIZE_HUGE', 'Huge');
define('_PNBBCODE_SIZE_LARGE', 'Large');
define('_PNBBCODE_SIZE_NORMAL', 'Normal');
define('_PNBBCODE_SIZE_SMALL', 'Small');
define('_PNBBCODE_SIZE_TEXTSIZE', 'enter text size');
define('_PNBBCODE_SIZE_TINY', 'Tiny');
define('_PNBBCODE_UNDERLINE', 'u');
define('_PNBBCODE_UNDERLINE_HINT', 'underlined text');
define('_PNBBCODE_URL', 'URL');
define('_PNBBCODE_URL_HINT', 'insert a link');
define('_PNBBCODE_YES', 'Yes');
