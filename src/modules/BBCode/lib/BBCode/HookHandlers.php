<?php

/**
 * @package Zikula_Utility_Modules
 * @subpackage bbcode
 * @license http://www.gnu.org/copyleft/gpl.html
*/

class BBCode_HookHandlers extends Zikula_HookHandler
{
    /*
     * filter hook
     * 
     */
    public function uifilter(Zikula_Event $event)
    {
        // who called us
        $caller = $event['caller'];

        PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('bbcode'));
        if(ModUtil::getVar('BBCode', 'lightbox_enabled')==true) {
            PageUtil::addVar('javascript', 'javascript/ajax/prototype.js');
            PageUtil::addVar('javascript', 'javascript/ajax/scriptaculous.js');
        }

        $data = ModUtil::apiFunc('BBCode', 'user', 'transform', 
                                 array('message' => $event->getData()));
        $event->setData($data);
        return;     
    }

}