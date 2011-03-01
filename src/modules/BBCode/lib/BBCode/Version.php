<?php

/**
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 * @license http://www.gnu.org/copyleft/gpl.html
*/

class BBCode_Version extends Zikula_Version
{
	public function getMetaData()
	{
		$meta = array();
		$meta['oldnames']         = array('pn_bbcode','bbcode');
		$meta['version']          = '3.0.0';
		$meta['id']               = '164';
		$meta['description']      = __('BBCode is a transform hook that converts usual BBCode tags into html.');
		$meta['displayname']      = __('BBCode Hook');
		//! module url (lower case without spaces and different to displayname)
		$meta['url']              = 'bbcode';
		$meta['securityschema']   = array('BBCode:Modulename:Links'  => '::', 'BBCode:Modulename:Emails' => '::');
		return $meta;
	}
}
