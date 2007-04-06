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

include_once 'modules/pn_bbcode/common.php';

function pn_bbcode_admin_main()
{
    if (!pnSecAuthAction(0, 'pn_bbcode::', "::", ACCESS_ADMIN)) {
    	return pnVarPrepForDisplay(_PNBBCODE_NOAUTH);
    }

    $pnr = new pnRender('pn_bbcode');
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
        $pnr = new pnRender('pn_bbcode');
        $pnr->caching = false;
        $pnr->add_core_data();
        $pnr->assign('code_preview', pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                        array('objectid' => 1,
                                                              'extrainfo' => "[code=php, start=100]<?php\necho 'test';\n?>[/code]")));
        return $pnr->fetch('pn_bbcode_admin_codeconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'code',  pnVarCleanFromInput('code'));
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
        $pnr = new pnRender('pn_bbcode');
        $pnr->caching = false;
        $pnr->add_core_data();
        $pnr->assign('quote_preview', nl2br(pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                         array('objectid' => 1,
                                                               'extrainfo' => "[quote=username]test\ntest test\n[/quote]"))));
        return $pnr->fetch('pn_bbcode_admin_quoteconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'quote', pnVarCleanFromInput('quote'));
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
        $pnr = new pnRender('pn_bbcode');
        $pnr->caching = false;
        $pnr->add_core_data();
        if (pnModGetVar('pn_bbcode', 'allow_usersize') == "yes") {
        	$usersizeonchecked = " checked=\"checked\" ";
        	$usersizeoffchecked = " ";
        } else {
        	$usersizeonchecked = " ";
        	$usersizeoffchecked = " checked=\"checked\" ";
        }

        $sizeenabled = (pnModGetVar('pn_bbcode', 'size_enabled') == "yes") ? ' checked="checked" ' : ' ';

        $pnr->assign('usersizeonchecked', $usersizeonchecked);
        $pnr->assign('usersizeoffchecked', $usersizeoffchecked);
        $pnr->assign('sizeenabled', $sizeenabled);
        return $pnr->fetch('pn_bbcode_admin_sizeconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'size_tiny',   pnVarCleanFromInput('size_tiny'));
        pnModSetVar('pn_bbcode', 'size_small',  pnVarCleanFromInput('size_small'));
        pnModSetVar('pn_bbcode', 'size_normal', pnVarCleanFromInput('size_normal'));
        pnModSetVar('pn_bbcode', 'size_large',  pnVarCleanFromInput('size_large'));
        pnModSetVar('pn_bbcode', 'size_huge',   pnVarCleanFromInput('size_huge'));
        pnModSetVar('pn_bbcode', 'allow_usersize', pnVarCleanFromInput('allow_usersize'));
        pnModSetVar('pn_bbcode', 'size_enabled',   pnVarCleanFromInput('size_enabled'));
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
        $pnr = new pnRender('pn_bbcode');
        $pnr->caching = false;
        if (pnModGetVar('pn_bbcode', 'allow_usercolor') == "yes") {
        	$usercoloronchecked = " checked=\"checked\" ";
        	$usercoloroffchecked = " ";
        } else {
        	$usercoloronchecked = " ";
        	$usercoloroffchecked = " checked=\"checked\" ";
        }
        $colorenabled = (pnModGetVar('pn_bbcode', 'color_enabled') == "yes") ? ' checked="checked" ' : ' ';

        $pnr->assign('usercoloronchecked', $usercoloronchecked);
        $pnr->assign('usercoloroffchecked', $usercoloroffchecked);
        $pnr->assign('colorenabled', $colorenabled);
        return $pnr->fetch('pn_bbcode_admin_colorconfig.html');
    } else {
        pnModSetVar('pn_bbcode', 'color_enabled', pnVarCleanFromInput('color_enabled'));
        pnModSetVar('pn_bbcode', 'allow_usercolor', pnVarCleanFromInput('allow_usercolor'));
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBCODE_CONFIGCHANGED));
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'main'));
    }
}

?>