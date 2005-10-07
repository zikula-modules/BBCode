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
 * init module
*/
function pn_bbcode_init() {

    // Set up module variables
    //

    // Set up module hooks
    // transform hook
    if (!pnModRegisterHook('item',
                           'transform',
                           'API',
                           'pn_bbcode',
                           'user',
                           'transform')) {
        pnSessionSetVar('errormsg', _PNBBCODE_COULDNOTREGISTER . ' (transform hook)');
        return false;
    }

    pnModSetVar('pn_bbcode', 'quote', stripslashes(pnVarPrepForStore('<fieldset style="background-color: '.pnThemeGetVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">%u</legend>%t</fieldset>')));
    pnModSetVar('pn_bbcode', 'code',  stripslashes(pnVarPrepForStore('<fieldset style="background-color: '.pnThemeGetVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">%h</legend><pre>%c</pre></fieldset>')));
    pnModSetVar('pn_bbcode', 'size_tiny',   '0.75em');
    pnModSetVar('pn_bbcode', 'size_small',  '0.85em');
    pnModSetVar('pn_bbcode', 'size_normal', '1.0em');
    pnModSetVar('pn_bbcode', 'size_large',  '1.5em');
    pnModSetVar('pn_bbcode', 'size_huge',   '2.0em');
    pnModSetVar('pn_bbcode', 'allow_usersize', 'no');
    pnModSetVar('pn_bbcode', 'allow_usercolor', 'no');
    pnModSetVar('pn_bbcode', 'color_enabled', 'yes');
    pnModSetVar('pn_bbcode', 'size_enabled', 'yes');
    pnModSetVar('pn_bbcode', 'linenumbers', 'yes');
    pnModSetVar('pn_bbcode', 'syntaxhilite', 'yes');

    // Initialisation successful
    return true;
}

/**
 * upgrade module
*/
function pn_bbcode_upgrade($oldversion)
{
	switch($oldversion) {
	    case '1.10':
            pnModSetVar('pn_bbcode', 'quoteheader_start', stripslashes(pnVarPrepForStore('<fieldset style="background-color: '.pnThemeGetVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">')));
            pnModSetVar('pn_bbcode', 'quoteheader_end',   stripslashes(pnVarPrepForStore('</legend>')));
            pnModSetVar('pn_bbcode', 'quotebody_start',   stripslashes(pnVarPrepForStore('')));
            pnModSetVar('pn_bbcode', 'quotebody_end',     stripslashes(pnVarPrepForStore('</fieldset>')));
            pnModSetVar('pn_bbcode', 'codeheader_start',  stripslashes(pnVarPrepForStore('<fieldset style="background-color: '.pnThemeGetVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">')));
            pnModSetVar('pn_bbcode', 'codeheader_end',    stripslashes(pnVarPrepForStore('</legend>')));
            pnModSetVar('pn_bbcode', 'codebody_start',    stripslashes(pnVarPrepForStore('<pre>')));
            pnModSetVar('pn_bbcode', 'codebody_end',      stripslashes(pnVarPrepForStore('</pre></fieldset>')));
        case '1.12':
            pnModSetVar('pn_bbcode', 'size_tiny',   '0.75em');
            pnModSetVar('pn_bbcode', 'size_small',  '0.85em');
            pnModSetVar('pn_bbcode', 'size_normal', '1.0em');
            pnModSetVar('pn_bbcode', 'size_large',  '1.5em');
            pnModSetVar('pn_bbcode', 'size_huge',   '2.0em');
            pnModSetVar('pn_bbcode', 'allow_usersize', 'no');
            pnModSetVar('pn_bbcode', 'allow_usercolor', 'no');
            pnModSetVar('pn_bbcode', 'color_enabled', 'yes');
            pnModSetVar('pn_bbcode', 'size_enabled', 'yes');
        case '1.14':
            pnModSetVar('pn_bbcode', 'linenumbers', 'yes');
            $quote = pnModGetVar('pn_bbcode', 'quoteheader_start') . '%u' .
                     pnModGetVar('pn_bbcode', 'quoteheader_end') .
                     pnModGetVar('pn_bbcode', 'quotebody_start') . '%t' .
                     pnModGetVar('pn_bbcode', 'quotebody_end');
            pnModSetVar('pn_bbcode', 'quote', stripslashes(pnVarPrepForStore($quote)));
            $code = pnModGetVar('pn_bbcode', 'codeheader_start') . '%h' .
                    pnModGetVar('pn_bbcode', 'codeheader_end') .
                    pnModGetVar('pn_bbcode', 'codebody_start') . '%c' .
                    pnModGetVar('pn_bbcode', 'codebody_end');
            pnModSetVar('pn_bbcode', 'code', stripslashes(pnVarPrepForStore($code)));
            pnModDelVar('pn_bbcode', 'quoteheader_start');
            pnModDelVar('pn_bbcode', 'quoteheader_end');
            pnModDelVar('pn_bbcode', 'quotebody_start');
            pnModDelVar('pn_bbcode', 'quotebody_end');
            pnModDelVar('pn_bbcode', 'codeheader_start');
            pnModDelVar('pn_bbcode', 'codeheader_end');
            pnModDelVar('pn_bbcode', 'codebody_start');
            pnModDelVar('pn_bbcode', 'codebody_end');
        case '1.15':
            pnModSetVar('pn_bbcode', 'syntaxhilite', 'yes');
        case '1.17':
            // display hook
            if (!pnModRegisterHook('item',
                                   'display',
                                   'GUI',
                                   'pn_bbcode',
                                   'user',
                                   'codes')) {
                pnSessionSetVar('errormsg', _PNBBCODE_COULDNOTREGISTER . ' (display hook)');
                return false;
            }
            pnModSetVar('pn_bbcode', 'displayhook', 'yes');
        case '1.18':
            // replace displayhook
            if (!pnModUnregisterHook('item',
                                     'display',
                                     'GUI',
                                     'pn_bbcode',
                                     'user',
                                     'codes')) {
                pnSessionSetVar('errormsg', _PNBBCODE_COULDNOTUNREGISTER . ' (display hook)');
                return false;
            }
            pnModDelVar('pn_bbcode', 'displayhook');
        default:
             break;
    }
    return true;
}

/**
 * delete module
*/
function pn_bbcode_delete() {

    // Remove module hooks
    if (!pnModUnregisterHook('item',
                             'transform',
                             'API',
                             'pn_bbcode',
                             'user',
                             'transform')) {
        pnSessionSetVar('errormsg', _PNBBCODE_COULDNOTUNREGISTER . ' (transform hook)');
        return false;
    }

    pnModDelVar('pn_bbcode', 'quote');
    pnModDelVar('pn_bbcode', 'code');
    pnModDelVar('pn_bbcode', 'size_tiny');
    pnModDelVar('pn_bbcode', 'size_small');
    pnModDelVar('pn_bbcode', 'size_normal');
    pnModDelVar('pn_bbcode', 'size_large');
    pnModDelVar('pn_bbcode', 'size_huge');
    pnModDelVar('pn_bbcode', 'allow_usersize');
    pnModDelVar('pn_bbcode', 'allow_usercolor');
    pnModDelVar('pn_bbcode', 'color_enabled');
    pnModDelVar('pn_bbcode', 'size_enabled');
    pnModDelVar('pn_bbcode', 'linenumbers');
    pnModDelVar('pn_bbcode', 'syntaxhilite');

    // Deletion successful
    return true;
}

?>