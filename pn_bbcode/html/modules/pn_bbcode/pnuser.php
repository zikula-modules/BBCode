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
 * @license http://www.gnu.org/copyleft/gpl.html
*/

/**
 * main funcion
 * The main function is not used in the pn_bbcode module, we just rediret to index.php
 *
 */
function pn_bbcode_user_main()
{
    pnRedirect('index.php');
    return true;
}

/**
 * whatisbbcode
 * The only relevant funtion here displays some help for bbcode tags
 * no parameters needed
 *
 */
function pn_bbcode_user_whatisbbcode()
{
    $pnr =& new pnRender('pn_bbcode');
    return $pnr->fetch('pn_bbcode_user_whatisbbcode.html');
}

/**
 * codes
 * returns a html snippet with buttons for inserting bbocdes into a text
 *
 *@params $args['extrainfo'] extrainfo
 */
function pn_bbcode_user_codes($args)
{
    extract($args);
    unset($args);

    // we do not need the objectid - we just want to display the smilies now

    $displayhook = pnModGetVar('pn_bbcode', 'displayhook');
    if($displayhook == 'yes') {
        if(!isset($extrainfo) || !is_array($extrainfo) || empty($extrainfo) ) {
            return _MODARGSERROR . ' (extrainfo)';
        }
        return pn_bbcode_user_bbcodes($extrainfo);
    }
    return '';
}

/**
 * bbcode
 * returns a html snippet with buttons for inserting bbocdes into a text
 *
 *@params $args['images'] use image buttons if set
 *@params $args['textfieldid'] id of the textfield for inserting smilies
 */
function pn_bbcode_user_bbcodes($args)
{
    extract($args);
    unset($args);

    if(!isset($textfieldid) || empty($textfieldid)) {
        return _MODARGSERROR . ' (textfieldid)';
    }

    // load language file
    if(!pnModAPILoad('pn_bbcode', 'user')) {
        $smarty->trigger_error("loading pn_bbcode api failed", e_error);
        return;
    }

    $pnr =& new pnRender('pn_bbcode');
    $pnr->caching = false;
    $pnr->assign('allow_usersize', pnModGetVar('pn_bbcode', 'allow_usersize'));
    $pnr->assign('size_enabled', pnModGetVar('pn_bbcode', 'size_enabled'));
    $pnr->assign('allow_usercolor', pnModGetVar('pn_bbcode', 'allow_usercolor'));
    $pnr->assign('color_enabled', pnModGetVar('pn_bbcode', 'color_enabled'));
    $pnr->assign('images', $images);

    // find the correct javascript file depending on the users language

    $userlang = pnUserGetLang();
    $file_1 = "modules/pn_bbcode/pnjavascript/$userlang/bbcode.js";
//    $file_2 = "modules/pn_bbcode/pnjavascript/$userlang/bbcode_nopopup.js";
    $default_1 = "modules/pn_bbcode/pnjavascript/eng/bbcode.js";
//    $default_2 = "modules/pn_bbcode/pnjavascript/eng/bbcode_nopopup.js";
    if(file_exists($file_1) && is_readable($file_1)) {
        $pnr->assign('jsheader1', "<script type=\"text/javascript\" src=\"$file_1\"></script>");
    } else {
        $pnr->assign('jsheader1', "<script type=\"text/javascript\" src=\"$default_1\"></script>");
    }

    $pnr->assign('jsheadercommon', "<script type=\"text/javascript\" src=\"modules/pn_bbcode/pnjavascript/bbcode_common.js\"></script>");
/*
    if(file_exists($file_2) && is_readable($file_2)) {
        $pnr->assign('jsheader2', "<script type=\"text/javascript\" src=\"$file_2\"></script>");
    } else {
        $pnr->assign('jsheader2', "<script type=\"text/javascript\" src=\"$default_2\"></script>");
    }
*/
    // get the languages for highlighting
    $langs = pnModAPIFunc('pn_bbcode', 'user', 'get_geshi_languages');
    $pnr->assign('geshi_languages', $langs);
    $pnr->assign('textfieldid', $textfieldid);

    return $pnr->fetch('pn_bbcode_user_bbcodes.html');
}

?>