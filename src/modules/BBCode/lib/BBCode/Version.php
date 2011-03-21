<?php

/**
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 * @license http://www.gnu.org/copyleft/gpl.html
*/

class BBCode_Version extends Zikula_AbstractVersion
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
        $meta['securityschema']   = array('BBCode:Modulename:Links'  => '::',
                                          'BBCode:Modulename:Emails' => '::');
        $meta['capabilities']     = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));
        return $meta;
    }

    protected function setupHookBundles()
    {
        $bundle = new Zikula_Version_HookProviderBundle('modulehook_area.bbcode.bbcode', $this->__('BBCode filter hook'));
        $bundle->addHook('hookhandler.bbcode.ui.filter', 'ui.filter', 'BBCode_HookHandlers', 'uifilter', 'bbcode.service1');
        // add other hooks as needed
        $this->registerHookProviderBundle($bundle);

        //... repeat as many times as necessary
    }

}
