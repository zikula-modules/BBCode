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

function pn_bbcode_admin_main()
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) {
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH);
    }

    $pnr =&new pnRender('pn_bbcode');
    $pnr->caching = false;
    $pnr->add_core_data();
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
        $pnr->assign('code', pnModGetVar('pn_bbcode', 'code'));
        if (pnModGetVar('pn_bbcode', 'linenumbers') == "yes") {
        	$linenumberonchecked = " checked=\"checked\" ";
        	$linenumberoffchecked = " ";
        } else {
        	$linenumberonchecked = " ";
        	$linenumberoffchecked = " checked=\"checked\" ";
        }
        if (pnModGetVar('pn_bbcode', 'syntaxhilite') == "yes") {
        	$syntaxhiliteonchecked = " checked=\"checked\" ";
        	$syntaxhiliteoffchecked = " ";
        } else {
        	$syntaxhiliteonchecked = " ";
        	$syntaxhiliteoffchecked = " checked=\"checked\" ";
        }
        $pnr->assign('linenumberonchecked', $linenumberonchecked);
        $pnr->assign('linenumberoffchecked', $linenumberoffchecked);
        $pnr->assign('syntaxhiliteonchecked', $syntaxhiliteonchecked);
        $pnr->assign('syntaxhiliteoffchecked', $syntaxhiliteoffchecked);
        $pnr->assign('code_preview', nl2br(pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                        array('objectid' => 1,
                                                              'extrainfo' => "[code]<?php\necho 'test';\n?>[/code]"))));
        return $pnr->fetch('pn_bbcode_admin_codeconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'code',  stripslashes(pnVarPrepForStore(pnVarCleanFromInput('code'))));
        pnModSetVar('pn_bbcode', 'linenumbers',  pnVarCleanFromInput('linenumbers'));
        pnModSetVar('pn_bbcode', 'syntaxhilite',  pnVarCleanFromInput('syntaxhilite'));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
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
        global $additional_header;
        $stylesheet = "modules/pn_bbcode/pnstyle/style.css";
        $stylesheetlink = "<link rel=\"stylesheet\" href=\"$stylesheet\" type=\"text/css\" />";
        global $additional_header;
        if(is_array($additional_header)) {
            $values = array_flip($additional_header);
            if(!array_key_exists($stylesheetlink, $values) && file_exists($stylesheet) && is_readable($stylesheet)) {
                $additional_header[] = $stylesheetlink;
            }
        } else {
            if(file_exists($stylesheet) && is_readable($stylesheet)) {
                $additional_header[] = $stylesheetlink;
            }
        }

        $pnr =&new pnRender('pn_bbcode');
        $pnr->caching = false;
        $pnr->assign('quote', pnModGetVar('pn_bbcode', 'quote'));
        $pnr->assign('quote_preview', nl2br(pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                         array('objectid' => 1,
                                                               'extrainfo' => "[quote=username]test\ntest test\n\n[/quote]"))));
        return $pnr->fetch('pn_bbcode_admin_quoteconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'quote', stripslashes(pnVarPrepForStore(pnVarCleanFromInput('quote'))));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
    }
}

/**
 * sizeconfig
 *
 */
function pn_bbcode_admin_sizeconfig()
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) {
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH);
    }

    $submit = pnVarCleanFromInput('submit');

    if(!$submit) {
        $pnr =&new pnRender('pn_bbcode');
        $pnr->caching = false;
        if (pnModGetVar('pn_bbcode', 'allow_usersize') == "yes") {
        	$usersizeonchecked = " checked=\"checked\" ";
        	$usersizeoffchecked = " ";
        } else {
        	$usersizeonchecked = " ";
        	$usersizeoffchecked = " checked=\"checked\" ";
        }
        if (pnModGetVar('pn_bbcode', 'size_enabled') == "yes") {
        	$sizeenabled = " checked=\"checked\" ";
        } else {
        	$sizeenabled = " ";
        }
        $pnr->assign('size_tiny',  pnModGetVar('pn_bbcode', 'size_tiny'));
        $pnr->assign('size_small', pnModGetVar('pn_bbcode', 'size_small'));
        $pnr->assign('size_normal',  pnModGetVar('pn_bbcode', 'size_normal'));
        $pnr->assign('size_large', pnModGetVar('pn_bbcode', 'size_large'));
        $pnr->assign('size_huge',  pnModGetVar('pn_bbcode', 'size_huge'));
        $pnr->assign('usersizeonchecked', $usersizeonchecked);
        $pnr->assign('usersizeoffchecked', $usersizeoffchecked);
        $pnr->assign('sizeenabled', $sizeenabled);
        return $pnr->fetch('pn_bbcode_admin_sizeconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'size_tiny',   stripslashes(pnVarPrepForStore(pnVarCleanFromInput('size_tiny'))));
        pnModSetVar('pn_bbcode', 'size_small',  stripslashes(pnVarPrepForStore(pnVarCleanFromInput('size_small'))));
        pnModSetVar('pn_bbcode', 'size_normal', stripslashes(pnVarPrepForStore(pnVarCleanFromInput('size_normal'))));
        pnModSetVar('pn_bbcode', 'size_large',  stripslashes(pnVarPrepForStore(pnVarCleanFromInput('size_large'))));
        pnModSetVar('pn_bbcode', 'size_huge',   stripslashes(pnVarPrepForStore(pnVarCleanFromInput('size_huge'))));
        pnModSetVar('pn_bbcode', 'allow_usersize', pnVarPrepForStore(pnVarCleanFromInput('allow_usersize')));
        pnModSetVar('pn_bbcode', 'size_enabled',   pnVarPrepForStore(pnVarCleanFromInput('size_enabled')));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
    }
}

/**
 * colorconfig
 *
 */
function pn_bbcode_admin_colorconfig()
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) {
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH);
    }

    $submit = pnVarCleanFromInput('submit');

    if(!$submit) {
        $pnr =&new pnRender('pn_bbcode');
        $pnr->caching = false;
        if (pnModGetVar('pn_bbcode', 'allow_usercolor') == "yes") {
        	$usercoloronchecked = " checked=\"checked\" ";
        	$usercoloroffchecked = " ";
        } else {
        	$usercoloronchecked = " ";
        	$usercoloroffchecked = " checked=\"checked\" ";
        }
        if (pnModGetVar('pn_bbcode', 'color_enabled') == "yes") {
        	$colorenabled = " checked=\"checked\" ";
        } else {
        	$colorenabled = " ";
        }
        $pnr->assign('usercoloronchecked', $usercoloronchecked);
        $pnr->assign('usercoloroffchecked', $usercoloroffchecked);
        $pnr->assign('colorenabled', $colorenabled);
        return $pnr->fetch('pn_bbcode_admin_colorconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'color_enabled', pnVarPrepForStore(pnVarCleanFromInput('color_enabled')));
        pnModSetVar('pn_bbcode', 'allow_usercolor', pnVarPrepForStore(pnVarCleanFromInput('allow_usercolor')));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
    }
}

?>