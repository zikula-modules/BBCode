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
    if (!pnModRegisterHook('item',
                           'transform',
                           'API',
                           'pn_bbcode',
                           'user',
                           'transform')) {
        pnSessionSetVar('errormsg', _PNBBCODE_COULDNOTREGISTER);
        return false;
    }

    pnModSetVar('pn_bbcode', 'quoteheader_start', stripslashes(pnVarPrepForStore('<fieldset style="background-color: '.pnThemeGetVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">')));
    pnModSetVar('pn_bbcode', 'quoteheader_end',   stripslashes(pnVarPrepForStore('</legend>')));
    pnModSetVar('pn_bbcode', 'quotebody_start',   stripslashes(pnVarPrepForStore('')));
    pnModSetVar('pn_bbcode', 'quotebody_end',     stripslashes(pnVarPrepForStore('</fieldset>')));
    pnModSetVar('pn_bbcode', 'codeheader_start',  stripslashes(pnVarPrepForStore('<fieldset style="background-color: '.pnThemeGetVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">')));
    pnModSetVar('pn_bbcode', 'codeheader_end',    stripslashes(pnVarPrepForStore('</legend>')));
    pnModSetVar('pn_bbcode', 'codebody_start',    stripslashes(pnVarPrepForStore('<pre>')));
    pnModSetVar('pn_bbcode', 'codebody_end',      stripslashes(pnVarPrepForStore('</pre></fieldset>')));

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
        default: break;			
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
        pnSessionSetVar('errormsg', _PNBBCODE_COULDNOTUNREGISTER);
        return false;
    }

    pnModDelVar('pn_bbcode', 'quoteheader_start');
    pnModDelVar('pn_bbcode', 'quoteheader_end');
    pnModDelVar('pn_bbcode', 'quotebody_start');
    pnModDelVar('pn_bbcode', 'quotebody_end');
    pnModDelVar('pn_bbcode', 'codeheader_start');
    pnModDelVar('pn_bbcode', 'codeheader_end');
    pnModDelVar('pn_bbcode', 'codebody_start');
    pnModDelVar('pn_bbcode', 'codebody_end');

    // Deletion successful
    return true;
}

?>