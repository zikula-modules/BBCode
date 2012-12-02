<?php

/**
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 * @license http://www.gnu.org/copyleft/gpl.html
 */
class BBCode_Version extends Zikula_AbstractVersion
{
    const PROVIDER_UIAREANAME = 'provider.bbcode.ui_hooks.bbcode';
    const PROVIDER_FILTERAREANAME = 'provider.bbcode.filter_hooks.bbcode';

    public function getMetaData()
    {
        $meta = array();
        $meta['oldnames'] = array('pn_bbcode', 'bbcode');
        $meta['version'] = '3.0.0';
        $meta['id'] = '164';
        $meta['description'] = __('BBCode is a transform hook that converts usual BBCode tags into html.');
        $meta['displayname'] = __('BBCode Hook');
        //! module url (lower case without spaces and different to displayname)
        $meta['url'] = 'bbcode';
        $meta['securityschema'] = array('BBCode:Modulename:Links' => '::',
            'BBCode:Modulename:Emails' => '::');
        $meta['capabilities'] = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));
        return $meta;
    }

    protected function setupHookBundles()
    {
        $bundle = new Zikula_HookManager_ProviderBundle($this->name, self::PROVIDER_UIAREANAME, 'ui_hooks', __('BBCode Editor'));
        $bundle->addServiceHandler('form_edit', 'BBCode_HookHandlers', 'uiEdit', 'bbcode.interface');
        $this->registerHookProviderBundle($bundle);

        $bundle = new Zikula_HookManager_ProviderBundle($this->name, self::PROVIDER_FILTERAREANAME, 'filter_hooks', __('BBCode Filter Hook'));
        $bundle->addStaticHandler('filter', 'BBCode_HookHandlers', 'filter', 'bbcode.transform');
        $this->registerHookProviderBundle($bundle);
    }

}
