<?php

/**
 * BBCode module
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class BBCode_Api_Admin extends Zikula_Api
{
	/**
	* get available admin panel links
	*
	* @author Mark West
	* @return array array of admin links
	*/
	public function getlinks()
	{
		$links = array();
		if (SecurityUtil::checkPermission('BBCode::', '::', ACCESS_ADMIN)) {
			$links[] = array(
                'url' => ModUtil::url('BBCode', 'admin', 'main'),
                'text' => $this->__('Start'),
                'class' => 'z-icon-es-view'
            );
			$links[] = array(
                'url' => ModUtil::url('BBCode', 'admin', 'config'),
                'text' => $this->__('Settings'),
                'class' => 'z-icon-es-config'
            );
		 }
		 return $links;
	}

}

