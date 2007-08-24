<?php
// $Id: mh_admin_edithandler.class.php 161 2007-01-28 17:00:20Z landseer $
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

class pn_bbcode_admin_codeconfighandler
{

    function initialize(&$pnRender)
    {
        $pnRender->caching = false;
        $pnRender->add_core_data();
        $hiliteoptions = array(array('text' => _PNBBCODE_CODE_NOSYNTAXHIGHLIGHTING, 'value' => 0),
                               array('text' => _PNBBCODE_CODE_GESHIWITHLINENUMBERS, 'value' => 1),
                               array('text' => _PNBBCODE_CODE_GESHIWITHOUTLINENUMBERS, 'value' => 2),
                               array('text' => _PNBBCODE_CODE_GOOGLEPRETTIFIER, 'value' => 3));
        $pnRender->assign('hiliteoptions', $hiliteoptions);
        $pnRender->assign('code_preview', pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                        array('objectid' => 1,
                                                              'extrainfo' => "[code=php, start=100]<?php\necho 'test';\n?>[/code]")));
        return true;
    }


    function handleCommand(&$pnRender, &$args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('pn_bbcode::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError('index.php');
        }  
        if ($args['commandName'] == 'submit') {
            $data = $pnRender->pnFormGetValues();

            pnModSetVar('pn_bbcode', 'code',  $data['code']);
            pnModSetVar('pn_bbcode', 'syntaxhilite',  $data['syntaxhilite']);
            LogUtil::registerStatus(_PNBBCODE_CONFIGCHANGED);
        }
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'codeconfig'));
    }

}
