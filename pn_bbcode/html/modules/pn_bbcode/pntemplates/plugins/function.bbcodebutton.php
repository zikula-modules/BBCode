<?php
// $Id$
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
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

/**
 * bbcodebutton
 * creates buttons for bbcodes
 *
 *$params['name'] string name
 *$params['nameml'] int if set then treat name as a define
 *$params['title'] string title
 *$params['titleml'] int if set then treat name as a define
 *$params['key'] char accesskey
 *$params['image'] string image
 *
 */
function smarty_function_bbcodebutton($params, &$smarty) 
{
    extract($params); 
	unset($params);

    // load language file
    if(!pnModAPILoad('pn_bbcode', 'user')) {
        $smarty->trigger_error("loading pn_bbcode api failed", e_error);
        return;
    } 
    
    $lang = pnUserGetLang();

    if(file_exists("modules/pn_bbcode/pnimages/$lang/$image")) {
        $imgfile = "modules/pn_bbcode/pnimages/$lang/$image";   
    } else if(file_exists("modules/pn_bbcode/pnimages/$image")) {
        $imgfile = "modules/pn_bbcode/pnimages/$image";
    }
    $attr = getimagesize($imgfile);
    
    $name  = (isset($nameml)) ? constant($name) : $name;
    $title = (isset($titleml)) ? constant($title) : $title;
            
    $out = "<button name=\"".pnVarPrepForDisplay($name)."\" type=\"button\" value=\"".pnVarPrepForDisplay($name)."\"
            style=\"border:none; background: transparent;\"
            title=\"$title\"
            accesskey=\"$key\" onclick=\"DoPrompt('".pnVarPrepForDisplay($name)."')\">
            <img src=\"$imgfile\" ".$attr[3]." alt=\"".pnVarPrepForDisplay($title)."\" />
            </button>";
    return $out;

}

?>
