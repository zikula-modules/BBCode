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
     * @param Zikula_Hook $hook
     *
     * @return void
     */
    public function uiEdit(Zikula_DisplayHook $hook)
    {
        $images = false;
        // TODO: How can we get $images?
        // CAH: I believe that 'images' is boolean wether to display images or not

        $this->view->assign('images', $images);

        // get the languages for highlighting
        $langs = ModUtil::apiFunc('BBCode', 'user', 'get_geshi_languages');
        $this->view->assign('geshi_languages', $langs);

        $response = new Zikula_Response_DisplayHook(BBCode_Version::PROVIDER_UIAREANAME, $this->view, 'hook/bbcodes.tpl');
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