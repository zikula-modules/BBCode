<?php

/**
 * BBCode
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class BBCode_Controller_User extends Zikula_Controller
{

	/**
	* main funcion
	* The main function is not used in the BBCode module, we just redirect to index.php
	*
	*/
	public function main()
	{
	    return System::redirect(System::getVar('entrypoint', 'index.php'));
	}

	/**
	* whatisBBCode
	* The only relevant funtion here displays some help for BBCode tags
	* no parameters needed
	*
	*/
	public function whatisbbcode()
	{

	    return $this->view->fetch('bbcode_user_whatisbbcode.tpl');
	}

	/**
	* BBCode
	* returns a html snippet with buttons for inserting bbocdes into a text
	*
	*@params $args['images'] use image buttons if set
	*@params $args['textfieldid'] id of the textfield for inserting smilies
	*/
	public function bbcodes($args)
	{
	    $images      = isset($args['images']) ? $args['images'] : null;
	    $textfieldid = $args['textfieldid'];

	    if(empty($textfieldid)) {
		return LogUtil::registerArgsError();
	    }

	    // if we have more than one textarea we need to distinguish them, so we simply use
	    // a counter stored in a session var until we find a better solution
	    $counter = (int)SessionUtil::getVar('BBCode_counter');
	    $counter++;
	    SessionUtil::setVar('BBCode_counter', $counter);

	    $this->view->assign('counter', $counter);
	    $this->view->assign('images', $images);

	    PageUtil::addVar('javascript', 'javascript/ajax/prototype.js');
	    PageUtil::addVar('javascript', 'modules/BBCode/javascript/bbcode.js');
	    //PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('BBCode'));

	    // get the languages for highlighting
	    $langs = ModUtil::apiFunc('BBCode', 'user', 'get_geshi_languages');
	    $this->view->assign('geshi_languages', $langs);
	    $this->view->assign('textfieldid', $textfieldid);

	    $this->view->add_core_data();
	    return $this->view->fetch('bbcode_user_bbcodes.tpl');
	}
}

