<?php

/**
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 * @license http://www.gnu.org/copyleft/gpl.html
*/

class BBCode_HookHandler_Code extends Zikula_Hook_AbstractHandler
{
    /*
     * filter hook
     *
     */
    public static function filter(Zikula_FilterHook $hook)
    {
        PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('BBCode'));
        if(ModUtil::getVar('BBCode', 'lightbox_enabled')==true) {
            PageUtil::addVar('javascript', 'javascript/ajax/prototype.js');
            PageUtil::addVar('javascript', 'javascript/ajax/scriptaculous.js');
        }

        $data = ModUtil::apiFunc('BBCode', 'user', 'transform', array('message' => $hook->getData()));
        $hook->setData($data);
    }

}