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

class BBCode_Installer extends Zikula_AbstractInstaller
{

    /**
    * initialise the template module
    * This function is only ever called once during the lifetime of a particular
    * module instance
    */
    public function install()
    {
        // create hook
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        // setup module vars
        $this->setVar('quote', '<div class="bbquoteheader">%u</div><blockquote class="bbquotetext">%t</blockquote>');
        $this->setVar('code',  '<div class="bbcodeheader">%h</div><div class="bbcodetext">%c</div>');
        $this->setVar('size_tiny',   '0.75em');
        $this->setVar('size_small',  '0.85em');
        $this->setVar('size_normal', '1.0em');
        $this->setVar('size_large',  '1.5em');
        $this->setVar('size_huge',   '2.0em');
        $this->setVar('allow_usersize', false);
        $this->setVar('allow_usercolor', false);
        $this->setVar('code_enabled', true);
        $this->setVar('mimetex_enabled', false);
        $this->setVar('mimetex_url', 'http://www.forkosh.dreamhost.com/cgi-bin/mimetex.cgi');
        $this->setVar('quote_enabled', true);
        $this->setVar('color_enabled', true);
        $this->setVar('size_enabled', true);
        $this->setVar('lightbox_enabled', true);
        $this->setVar('lightbox_previewwidth', 200);
        $this->setVar('syntaxhilite', HILITE_GOOGLE); // google code prettifier
        $this->setVar('link_shrinksize',  30);
        $this->setVar('spoiler_enabled',  true);
        $this->setVar('spoiler',  '<div class="bbcodeheader">%h</div><div class="bbspoiler">%s</div>');

        // Initialisation successful
        return true;
    }

    /**
    * upgrade module
    */
    public function upgrade($oldversion)
    {

        switch($oldversion) {
        case '1.10':
            ModUtil::setVar('pn_bbcode', 'quoteheader_start', '<fieldset style="background-color: '.ThemeUtil::getVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">');
            ModUtil::setVar('pn_bbcode', 'quoteheader_end',   '</legend>');
            ModUtil::setVar('pn_bbcode', 'quotebody_start',   '');
            ModUtil::setVar('pn_bbcode', 'quotebody_end',     '</fieldset>');
            ModUtil::setVar('pn_bbcode', 'codeheader_start',  '<fieldset style="background-color: '.ThemeUtil::getVar('bgcolor2').'; text-align: left; border: 1px solid black;"><legend style="font-weight: bold;">');
            ModUtil::setVar('pn_bbcode', 'codeheader_end',    '</legend>');
            ModUtil::setVar('pn_bbcode', 'codebody_start',    '<pre>');
            ModUtil::setVar('pn_bbcode', 'codebody_end',      '</pre></fieldset>');
        case '1.12':
            ModUtil::setVar('pn_bbcode', 'size_tiny',   '0.75em');
            ModUtil::setVar('pn_bbcode', 'size_small',  '0.85em');
            ModUtil::setVar('pn_bbcode', 'size_normal', '1.0em');
            ModUtil::setVar('pn_bbcode', 'size_large',  '1.5em');
            ModUtil::setVar('pn_bbcode', 'size_huge',   '2.0em');
            ModUtil::setVar('pn_bbcode', 'allow_usersize', 'no');
            ModUtil::setVar('pn_bbcode', 'allow_usercolor', 'no');
            ModUtil::setVar('pn_bbcode', 'color_enabled', 'yes');
            ModUtil::setVar('pn_bbcode', 'size_enabled', 'yes');
        case '1.14':
            ModUtil::setVar('pn_bbcode', 'linenumbers', 'yes');
            $quote = ModUtil::getVar('pn_bbcode', 'quoteheader_start') . '%u' .
            ModUtil::getVar('pn_bbcode', 'quoteheader_end') .
            ModUtil::getVar('pn_bbcode', 'quotebody_start') . '%t' .
            ModUtil::getVar('pn_bbcode', 'quotebody_end');
            ModUtil::setVar('pn_bbcode', 'quote', stripslashes(DataUtil::formatForStore($quote)));
            $code = ModUtil::getVar('pn_bbcode', 'codeheader_start') . '%h' .
            ModUtil::getVar('pn_bbcode', 'codeheader_end') .
            ModUtil::getVar('pn_bbcode', 'codebody_start') . '%c' .
            ModUtil::getVar('pn_bbcode', 'codebody_end');
            ModUtil::setVar('pn_bbcode', 'code', stripslashes(DataUtil::formatForStore($code)));
            ModUtil::delVar('pn_bbcode', 'quoteheader_start');
            ModUtil::delVar('pn_bbcode', 'quoteheader_end');
            ModUtil::delVar('pn_bbcode', 'quotebody_start');
            ModUtil::delVar('pn_bbcode', 'quotebody_end');
            ModUtil::delVar('pn_bbcode', 'codeheader_start');
            ModUtil::delVar('pn_bbcode', 'codeheader_end');
            ModUtil::delVar('pn_bbcode', 'codebody_start');
            ModUtil::delVar('pn_bbcode', 'codebody_end');
        case '1.15':
            ModUtil::setVar('pn_bbcode', 'syntaxhilite', 'yes');
        case '1.17':
            // display hook
            if (!ModUtil::registerHook('item',
                      'display',
                      'GUI',
                      'pn_bbcode',
                      'user',
                      'codes')) {
            SessionUtil::setVar('errormsg', $this->__('Error! Could not register BBCode display hook'));
            return '1.17';
            }
            ModUtil::setVar('pn_bbcode', 'displayhook', 'yes');
        case '1.18':
            // replace displayhook
            if (!ModUtil::unregisterHook('item',
                        'display',
                        'GUI',
                        'pn_bbcode',
                        'user',
                        'codes')) {
            LogUtil::registerError($this->__('Error! Could not register BBCode display hook'));
            return '1.18';
            }
            ModUtil::delVar('pn_bbcode', 'displayhook');
            case '1.21':
            case '1.22':
            // syntax highlight: yes/no and linenumber yes/no gets replaced with
            // 0 = no highlighting
            // 1 = geshi with linenumbers
            // 2 = geshi without linenumbers
            // 3 = google code prettifier
            $hilite      = ModUtil::getVar('pn_bbcode', 'syntaxhilite');
            $linenumbers = ModUtil::getVar('pn_bbcode', 'linenumbers');
            if($hilite=='no') {
            ModUtil::setVar('pn_bbcode', 'syntaxhilite', HILITE_NONE);
            } elseif ($hilite='yes') {
            if($linenumbers=='yes') {
                ModUtil::setVar('pn_bbcode', 'syntaxhilite', HILITE_GESHI_WITH_LN);
            } else {
                ModUtil::setVar('pn_bbcode', 'syntaxhilite', HILITE_GESHI_WITHOUT_LN);
            }
            }
            ModUtil::delVar('pn_bbcode', 'linenumbers');
            // remove <pre></pre> from code setting
            $code = ModUtil::getVar('pn_bbcode', 'code');
            $code = str_replace(array('<pre>','</pre>'), '', $code);
            ModUtil::setVar('pn_bbcode', 'code', $code);
        case '1.30': // last version to support .764
            ModUtil::setVar('bbcode', 'code_enabled', true);
            ModUtil::setVar('bbcode', 'quote_enabled', true);
            ModUtil::setVar('bbcode', 'lightbox_enabled', true);
            ModUtil::setVar('bbcode', 'lightbox_previewwidth', 200);
            ModUtil::setVar('bbcode', 'link_shrinksize', 30);
            ModUtil::setVar('bbcode', 'spoiler_enabled', true);
            ModUtil::setVar('bbcode', 'spoiler', '<div><h3 class="bbcodeheader">%h</h3><div class="bbspoiler">%s</div></div>');

            $oldvars = ModUtil::getVar('pn_bbcode');
            foreach ($oldvars as $varname => $oldvar) {
                ModUtil::setVar('bbcode', $varname, $oldvar);
            }
            ModUtil::delVar('pn_bbcode');

            // introduce mimetex module var
            ModUtil::setVar('bbcode', 'mimetex_enabled', false);
            ModUtil::setVar('bbcode', 'mimetex_url', 'http://www.forkosh.dreamhost.com/cgi-bin/mimetex.cgi');

            // get list of hooked modules
            $hookedmods = ModUtil::apiFunc('modules', 'admin', 'gethookedmodules', array('hookmodname' => 'pn_bbcode'));

            // update hooks
            $tables = DBUtil::getTables();
            $hookstable  = $tables['hooks'];
            $hookscolumn = $tables['hooks_column'];
            $sql = 'UPDATE ' . $hookstable . ' SET ' . $hookscolumn['smodule'] . '=\'bbcode\' WHERE ' . $hookscolumn['smodule'] . '=\'pn_bbcode\'';
            $res = DBUtil::executeSQL ($sql);
            if ($res === false) {
            LogUtil::registerError($this->__('Error! Failed to upgrade hook (smodule)'));
            return '1.30';
            }

            $sql = 'UPDATE ' . $hookstable . ' SET ' . $hookscolumn['tmodule'] . '=\'bbcode\' WHERE ' . $hookscolumn['tmodule'] . '=\'pn_bbcode\'';
            $res   = DBUtil::executeSQL ($sql);
            if ($res === false) {
            LogUtil::registerError($this->__('Error! Failed to upgrade hook (tmodule)'));
            return '1.30';
            }

        case '2.0':
        case '2.1':
            $oldvars = ModUtil::getVar('BBCode');
            foreach ($oldvars as $varname => $oldvar) {
                $this->setVar($varname, $oldvar);
            }
            ModUtil::delVar('BBCode');

            // create hook
            HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        default:
            break;
        }
        return true;
    }

    /**
    * delete module
    */
    public function uninstall()
    {
        // remove hook
        HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());

        // remove all module vars
        $this->delVars();

        // Deletion successful
        return true;
    }
}
