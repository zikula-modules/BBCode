<?php

/**
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 * @license http://www.gnu.org/copyleft/gpl.html
 */
class BBCode_HookHandlers extends Zikula_Hook_AbstractHandler
{

    /**
     * Zikula_View instance
     *
     * @var Zikula_View
     */
    private $view;

    /**
     * Post constructor hook.
     *
     * @return void
     */
    public function setup()
    {
        $this->view = Zikula_View::getInstance("BBCode");
        $this->name = 'BBCode';
    }

    /**
     * Display a html snippet with buttons for inserting bbcodes into a textarea
     *
     * Subject is the object being viewed that we're attaching to.
     * args[id] is the id of the object.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Hook $hook
     *
     * @return void
     */
    public function uiEdit(Zikula_DisplayHook $hook)
    {
        $textfieldid = $hook->getId();
        $images = null;
        // TODO: How can we get $images?

        if (empty($textfieldid)) {
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
        PageUtil::addVar('javascript', 'modules/BBCode/javascript/BBCode.js');
        PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('BBCode'));

        // get the languages for highlighting
        $langs = ModUtil::apiFunc('BBCode', 'user', 'get_geshi_languages');
        $this->view->assign('geshi_languages', $langs);
        $this->view->assign('textfieldid', $textfieldid);

        $response = new Zikula_Response_DisplayHook('provider_area.ui.bbcode.code', $this->view, 'bbcode_user_bbcodes.tpl');
        $hook->setResponse($response);
    }
    
    /*
     * filter hook
     *
     */
    public static function filter(Zikula_FilterHook $hook)
    {
        PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('BBCode'));
        $data = ModUtil::apiFunc('BBCode', 'user', 'transform', array('message' => $hook->getData()));
        $hook->setData($data);
    }
}