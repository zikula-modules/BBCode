<?php
// ----------------------------------------------------------------------
// POST-NUKE Content Management System
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
// but WIthOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Frank Schummertz
// ----------------------------------------------------------------------

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

    pnModSetVar('pn_bbcode', 'quoteheader_start', '<div style="width: 95%; font-weight: bold; text-align: left;">' );
    pnModSetVar('pn_bbcode', 'quoteheader_end', '</div>' );
    pnModSetVar('pn_bbcode', 'quotebody_start', '<div style="width: 95%; background-color: '.$GLOBALS['bgcolor2'].'; text-align: left;">' );
    pnModSetVar('pn_bbcode', 'quotebody_end', '</blockquote></div>' );

    // Initialisation successful
    return true;
}

function pn_bbcode_upgrade($oldversion) 
{
	switch($oldversion) {
	    case '1.10':
	        pnModSetVar('pn_bbcode', 'quoteheader_start', '<div style="width: 95%; font-weight: bold; text-align: left;">' );
	        pnModSetVar('pn_bbcode', 'quoteheader_end', '</div>' );
	        pnModSetVar('pn_bbcode', 'quotebody_start', '<div style="width: 95%; background-color: '.$GLOBALS['bgcolor2'].'; text-align: left;">' );
	        pnModSetVar('pn_bbcode', 'quotebody_end', '</blockquote></div>' );
        default: break;			
    }

    return true;
}

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

    // Deletion successful
    return true;
}

?>
