<?php
// $Id$
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
// Original Author of file: Hinrich Donner
// changed to pn_bbcode: larsneo
// ----------------------------------------------------------------------

function pn_bbcode_admin_main() 
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) { 
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH); 
    }

    $pnr =&new pnRender('pn_bbcode');
    $pnr->caching = false;
    return $pnr->fetch('pn_bbcode_admin_main.html');
}

/**
 * codeconfig
 *
 */
function pn_bbcode_admin_codeconfig()
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) { 
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH); 
    }

    $submit = pnVarCleanFromInput('submit');
    
    if(!$submit) {
        $pnr =&new pnRender('pn_bbcode');
        $pnr->caching = false;
        $pnr->assign('codeheader_start',  pnModGetVar('pn_bbcode', 'codeheader_start'));
        $pnr->assign('codeheader_end',    pnModGetVar('pn_bbcode', 'codeheader_end'));
        $pnr->assign('codebody_start',    pnModGetVar('pn_bbcode', 'codebody_start'));
        $pnr->assign('codebody_end',      pnModGetVar('pn_bbcode', 'codebody_end'));
        return $pnr->fetch('pn_bbcode_admin_codeconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'codeheader_start',  stripslashes(pnVarPrepForStore(pnVarCleanFromInput('codeheader_start'))));
        pnModSetVar('pn_bbcode', 'codeheader_end',    stripslashes(pnVarPrepForStore(pnVarCleanFromInput('codeheader_end'))));
        pnModSetVar('pn_bbcode', 'codebody_start',    stripslashes(pnVarPrepForStore(pnVarCleanFromInput('codebody_start'))));
        pnModSetVar('pn_bbcode', 'codebody_end',      stripslashes(pnVarPrepForStore(pnVarCleanFromInput('codebody_end'))));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
    }
}

/**
 * quoteconfig
 *
 */
function pn_bbcode_admin_quoteconfig()
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) { 
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH); 
    }

    $submit = pnVarCleanFromInput('submit');
    
    if(!$submit) {
        $pnr =&new pnRender('pn_bbcode');
        $pnr->caching = false;
        $pnr->assign('quoteheader_start', pnModGetVar('pn_bbcode', 'quoteheader_start'));
        $pnr->assign('quoteheader_end',   pnModGetVar('pn_bbcode', 'quoteheader_end'));
        $pnr->assign('quotebody_start',   pnModGetVar('pn_bbcode', 'quotebody_start'));
        $pnr->assign('quotebody_end',     pnModGetVar('pn_bbcode', 'quotebody_end'));
        return $pnr->fetch('pn_bbcode_admin_quoteconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'quoteheader_start', stripslashes(pnVarPrepForStore(pnVarCleanFromInput('quoteheader_start'))));
        pnModSetVar('pn_bbcode', 'quoteheader_end',   stripslashes(pnVarPrepForStore(pnVarCleanFromInput('quoteheader_end'))));
        pnModSetVar('pn_bbcode', 'quotebody_start',   stripslashes(pnVarPrepForStore(pnVarCleanFromInput('quotebody_start'))));
        pnModSetVar('pn_bbcode', 'quotebody_end',     stripslashes(pnVarPrepForStore(pnVarCleanFromInput('quotebody_end'))));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
    }
}

?>