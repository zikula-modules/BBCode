<?php

/**
 * bbcode module
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage bbcode
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
		if (SecurityUtil::checkPermission('bbcode::', '::', ACCESS_ADMIN)) {
			$links[] = array('url' => ModUtil::url('bbcode', 'admin', 'main'),    'text' => $this->__('Start'));
			$links[] = array('url' => ModUtil::url('bbcode', 'admin', 'config'),  'text' => $this->__('Settings'));
		 }
		 return $links;
	}
}

