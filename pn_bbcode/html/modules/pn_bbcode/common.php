<?php
// $Id: pnuserapi.php 132 2007-03-25 16:17:34Z landseer $
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

// general defines
// 0 = no highlighting
define('HILITE_NONE', 0);

// 1 = geshi with linenumbers
define('HILITE_GESHI_WITH_LN', 1);

// 2 = geshi without linenumbers
define('HILITE_GESHI_WITHOUT_LN', 2);

// 3 = google code prettifier
define('HILITE_GOOGLE', 3);

// more to come...

/**
 * add_stylesheet_header
 *
 */
function pn_bbcode_add_stylesheet_header()
{
    if(isdot8()) {
        PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('pn_bbcode'));
    } else {
        // load the modulestylesheet plugin to determine the stylesheet path
/*
        $pnr = new pnRender('pn_bbcode');
        require_once $pnr->_get_plugin_filepath('function','modulestylesheet');

        $css = smarty_function_modulestylesheet(array('xhtml' => 1,
                                                      'modname' => 'pn_bbcode'), $pnr);
*/
        $css = '<link rel="stylesheet" href="modules/pn_bbcode/pnstyle/style.css" type="text/css" />';
        global $additional_header;
        if(is_array($additional_header)) {
            if(!in_array($css, $additional_header)) {
                $additional_header[] = $css;
            }
        } else {
            $additional_header[] = $css;
        }
    }
    return;
}

/**
 * add_javascript_header
 *
 */
function pn_bbcode_add_javascript_header($file='')
{
    if(isdot8()) {
        PageUtil::addVar('javascript', $file);
    } else {
    // add the javascript file prettify.js to the additional_header array
        $jslink = "<script type=\"text/javascript\" src=\"$file\"></script>";
        global $additional_header;
        if(is_array($additional_header)) {
            $values = array_flip($additional_header);
            if(!array_key_exists($jslink, $values)) {
                $additional_header[] = $jslink;
            }
        } else {
            $additional_header[] = $jslink;
        }
    }
    return;
}

/**
 * pn version check
 *
 */
function isdot8()
{
    return (version_compare(PN_VERSION_NUM, '0.8', '>=')==1);
}

?>