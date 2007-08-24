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

class pn_bbcode_admin_miscconfighandler
{

    function initialize(&$pnRender)
    {
        $pnRender->caching = false;
        $pnRender->add_core_data();
        return true;
    }


    function handleCommand(&$pnRender, &$args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('pn_bbcode::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError('index.php');
        }  
        if ($args['commandName'] == 'submit') {
            $ok = $pnRender->pnFormIsValid(); 
            if(!$ok) {
                return false;
            }

            $data = $pnRender->pnFormGetValues();

            pnModSetVar('pn_bbcode', 'lightbox_enabled',  $data['lightbox_enabled']);
            pnModSetVar('pn_bbcode', 'lightbox_previewwidth',  $data['lightbox_previewwidth']);
            LogUtil::registerStatus(_PNBBCODE_CONFIGCHANGED);
        }
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'miscconfig'));
    }

}
