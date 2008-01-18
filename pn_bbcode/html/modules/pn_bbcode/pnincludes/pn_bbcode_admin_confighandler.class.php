<?php
// $Id$
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------

class pn_bbcode_admin_confighandler
{

    function initialize(&$pnRender)
    {
        $pnRender->caching = false;
        $pnRender->add_core_data();
        $pnRender->assign('quote_preview', nl2br(pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                              array('objectid' => 1,
                                                                    'extrainfo' => "[quote=username]test\ntest test\n[/quote]"))));
        $hiliteoptions = array(array('text' => _PNBBCODE_CODE_NOSYNTAXHIGHLIGHTING, 'value' => 0),
                               array('text' => _PNBBCODE_CODE_GESHIWITHLINENUMBERS, 'value' => 1),
                               array('text' => _PNBBCODE_CODE_GESHIWITHOUTLINENUMBERS, 'value' => 2),
                               array('text' => _PNBBCODE_CODE_GOOGLEPRETTIFIER, 'value' => 3));
        $pnRender->assign('hiliteoptions', $hiliteoptions);
        $pnRender->assign('code_preview', pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                        array('objectid' => 1,
                                                              'extrainfo' => "[code=php, start=100]<?php\necho 'test';\n?>[/code]")));

        $pnRender->assign('spoiler_preview', pnModAPIFunc('pn_bbcode', 'user', 'transform',
                                                          array('objectid' => 1,
                                                                'extrainfo' => "[spoiler]PostNuke + pn_bbcode[/spoiler]")));


        PageUtil::addVar('javascript', 'javascript/ajax/prototype.js');
        $modvars = pnModGetVar('pn_bbcode');
        $script = '<script type="text/javascript">';
        $script .= ($modvars['code_enabled'] == true) ? 'var codeenabled = true;' : 'var codeenabled = false;';
        $script .= ($modvars['color_enabled'] == true) ? 'var colorenabled = true;' : 'var colorenabled = false;';
        $script .= ($modvars['quote_enabled'] == true) ? 'var quoteenabled = true;' : 'var quoteenabled = false;';
        $script .= ($modvars['size_enabled'] == true) ? 'var sizeenabled = true;' : 'var sizeenabled = false;';
        $script .= ($modvars['lightbox_enabled'] == true) ? 'var lightboxenabled = true;' : 'var lightboxenabled = false;';
        $script .= ($modvars['spoiler_enabled'] == true) ? 'var spoilerenabled = true;' : 'var spoilerenabled = false;';
        $script .= '</script>';
        PageUtil::addVar('rawtext', $script);
        PageUtil::addVar('javascript', 'modules/pn_bbcode/pnjavascript/pn_bbcode_admin.js');

        return true;
    }


    function handleCommand(&$pnRender, &$args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('pn_bbcode::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError('index.php');
        }  
        if ($args['commandName'] == 'submit') {
            $ok = $pnRender->pnFormIsValid(); 
            $data = $pnRender->pnFormGetValues();

            if(!_validate_size_input($data['size_tiny'])) {
                $ifield = & $pnRender->pnFormGetPluginById('size_tiny');
                $ifield->setError(DataUtil::formatForDisplay(_PNBBCODE_ILLEGALVALUE));
                $ok = false;
            }
            if(!_validate_size_input($data['size_small'])) {
                $ifield = & $pnRender->pnFormGetPluginById('size_small');
                $ifield->setError(DataUtil::formatForDisplay(_PNBBCODE_ILLEGALVALUE));
                $ok = false;
            }
            if(!_validate_size_input($data['size_normal'])) {
                $ifield = & $pnRender->pnFormGetPluginById('size_normal');
                $ifield->setError(DataUtil::formatForDisplay(_PNBBCODE_ILLEGALVALUE));
                $ok = false;
            }
            if(!_validate_size_input($data['size_large'])) {
                $ifield = & $pnRender->pnFormGetPluginById('size_large');
                $ifield->setError(DataUtil::formatForDisplay(_PNBBCODE_ILLEGALVALUE));
                $ok = false;
            }
            if(!_validate_size_input($data['size_huge'])) {
                $ifield = & $pnRender->pnFormGetPluginById('size_huge');
                $ifield->setError(DataUtil::formatForDisplay(_PNBBCODE_ILLEGALVALUE));
                $ok = false;
            }
            if(!$ok) {
                return false;
            }

            // code 
            pnModSetVar('pn_bbcode', 'code_enabled',  $data['code_enabled']);
            pnModSetVar('pn_bbcode', 'code',  $data['code']);
            pnModSetVar('pn_bbcode', 'syntaxhilite',  $data['syntaxhilite']);

            // color
            pnModSetVar('pn_bbcode', 'color_enabled',  $data['color_enabled']);
            pnModSetVar('pn_bbcode', 'allow_usercolor',  $data['allow_usercolor']);

            // quote
            pnModSetVar('pn_bbcode', 'quote_enabled',  $data['quote_enabled']);
            pnModSetVar('pn_bbcode', 'quote',  $data['quote']);

            // size
            pnModSetVar('pn_bbcode', 'size_tiny',  $data['size_tiny']);
            pnModSetVar('pn_bbcode', 'size_small',  $data['size_small']);
            pnModSetVar('pn_bbcode', 'size_normal',  $data['size_normal']);
            pnModSetVar('pn_bbcode', 'size_large',  $data['size_large']);
            pnModSetVar('pn_bbcode', 'size_huge',  $data['size_huge']);
            pnModSetVar('pn_bbcode', 'size_enabled',  $data['size_enabled']);
            pnModSetVar('pn_bbcode', 'allow_usersize',  $data['allow_usersize']);
            
            // misc
            pnModSetVar('pn_bbcode', 'lightbox_enabled',  $data['lightbox_enabled']);
            pnModSetVar('pn_bbcode', 'lightbox_previewwidth',  $data['lightbox_previewwidth']);
            pnModSetVar('pn_bbcode', 'link_shrinksize',  $data['link_shrinksize']);
            pnModSetVar('pn_bbcode', 'spoiler_enabled',  $data['spoiler_enabled']);
            pnModSetVar('pn_bbcode', 'spoiler',  $data['spoiler']);

            LogUtil::registerStatus(_PNBBCODE_CONFIGCHANGED);
        }
        return pnRedirect(pnModURL('pn_bbcode', 'admin', 'config'));
    }

}

function _validate_size_input(&$input)
{
    $input = strtolower(trim($input));
    return (bool)preg_match('/(^\d{1,4}|(^\d{1,4}\.{0,1}\d{1,2}))(cm|em|ex|in|mm|pc|pt|px|\%)$/', $input);
}
