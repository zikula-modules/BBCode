<?php

/**
 * bbcode Module
 *
 * @subpackage   bbcode
 * @license      http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */


class BBCode_Form_Handler_Admin_ModifyConfig  extends Form_Handler
{

	function initialize(&$render)
	{
		$render->caching = false;
		$render->add_core_data();
		$render->assign('mimetex_url', ModUtil::getVar('bbcode','mimetex_url'));
		$render->assign('quote_preview', nl2br(ModUtil::apiFunc('bbcode', 'user', 'transform',
								      array('objectid' => 1,
									    'extrainfo' => "[quote=username]test\ntest test\n[/quote]"))));
		$hiliteoptions = array(array('text' => $this->__('No highlighting'), 'value' => 0),
				      array('text' => $this->__('GeSHi with line numbers'), 'value' => 1),
				      array('text' => $this->__('GeSHi without line numbers'), 'value' => 2),
				      array('text' => $this->__('Google Code Prettifier'), 'value' => 3));
		$render->assign('hiliteoptions', $hiliteoptions);
		$render->assign('code_preview', ModUtil::apiFunc('bbcode', 'user', 'transform',
								array('objectid' => 1,
								      'extrainfo' => "[code=php, start=100]<?php\necho 'test';\n?>[/code]")));

		$render->assign('spoiler_preview', ModUtil::apiFunc('bbcode', 'user', 'transform',
								  array('objectid' => 1,
									'extrainfo' => "[spoiler]Zikula + bbcode[/spoiler]")));


		PageUtil::addVar('javascript', 'javascript/ajax/prototype.js');
		$modvars = ModUtil::getVar('bbcode');
		$script = '<script type="text/javascript">';
		$script .= ($modvars['code_enabled'] == true) ? 'var codeenabled = true;' : 'var codeenabled = false;';
		$script .= ($modvars['color_enabled'] == true) ? 'var colorenabled = true;' : 'var colorenabled = false;';
		$script .= ($modvars['quote_enabled'] == true) ? 'var quoteenabled = true;' : 'var quoteenabled = false;';
		$script .= ($modvars['size_enabled'] == true) ? 'var sizeenabled = true;' : 'var sizeenabled = false;';
		$script .= ($modvars['lightbox_enabled'] == true) ? 'var lightboxenabled = true;' : 'var lightboxenabled = false;';
		$script .= ($modvars['spoiler_enabled'] == true) ? 'var spoilerenabled = true;' : 'var spoilerenabled = false;';
		$script .= ($modvars['mimetex_enabled'] == true) ? 'var mimetexenabled = true;' : 'var mimetexenabled = false;';
		$script .= '</script>';
		PageUtil::addVar('rawtext', $script);
		PageUtil::addVar('javascript', 'modules/Bbcode/javascript/bbcode_admin.js');

		return true;
	}


	function handleCommand(&$render, &$args)
	{
		// Security check
		if (!SecurityUtil::checkPermission('bbcode::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError('index.php');
		}  
		if ($args['commandName'] == 'submit') {
			$ok = $render->isValid(); 
			$data = $render->getValues();

			if(!$this->_validate_size_input($data['size_tiny'])) {
				$ifield = & $render->getPluginById('size_tiny');
				$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
				$ok = false;
			}
			if(!$this->_validate_size_input($data['size_small'])) {
				$ifield = & $render->getPluginById('size_small');
				$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
				$ok = false;
			}
			if(!$this->_validate_size_input($data['size_normal'])) {
				$ifield = & $render->getPluginById('size_normal');
				$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
				$ok = false;
			}
			if(!$this->_validate_size_input($data['size_large'])) {
				$ifield = & $render->getPluginById('size_large');
				$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
				$ok = false;
			}
			if(!$this->_validate_size_input($data['size_huge'])) {
				$ifield = & $render->getPluginById('size_huge');
				$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
				$ok = false;
			}
			if(!$ok) {
				return false;
			}

			// code 
			ModUtil::setVar('bbcode', 'code_enabled',  $data['code_enabled']);
			ModUtil::setVar('bbcode', 'code',  $data['code']);
			ModUtil::setVar('bbcode', 'syntaxhilite',  $data['syntaxhilite']);

			// color
			ModUtil::setVar('bbcode', 'color_enabled',  $data['color_enabled']);
			ModUtil::setVar('bbcode', 'allow_usercolor',  $data['allow_usercolor']);

			// quote
			ModUtil::setVar('bbcode', 'quote_enabled',  $data['quote_enabled']);
			ModUtil::setVar('bbcode', 'quote',  $data['quote']);

			// size
			ModUtil::setVar('bbcode', 'size_tiny',  $data['size_tiny']);
			ModUtil::setVar('bbcode', 'size_small',  $data['size_small']);
			ModUtil::setVar('bbcode', 'size_normal',  $data['size_normal']);
			ModUtil::setVar('bbcode', 'size_large',  $data['size_large']);
			ModUtil::setVar('bbcode', 'size_huge',  $data['size_huge']);
			ModUtil::setVar('bbcode', 'size_enabled',  $data['size_enabled']);
			ModUtil::setVar('bbcode', 'allow_usersize',  $data['allow_usersize']);

			// mimetex
			ModUtil::setVar('bbcode', 'mimetex_enabled',	$data['mimetex_enabled']);
			ModUtil::setVar('bbcode', 'mimetex_url',	$data['mimetex_url']);
			
			// misc
			ModUtil::setVar('bbcode', 'lightbox_enabled',  $data['lightbox_enabled']);
			ModUtil::setVar('bbcode', 'lightbox_previewwidth',  $data['lightbox_previewwidth']);
			ModUtil::setVar('bbcode', 'link_shrinksize',  $data['link_shrinksize']);
			ModUtil::setVar('bbcode', 'spoiler_enabled',  $data['spoiler_enabled']);
			ModUtil::setVar('bbcode', 'spoiler',  $data['spoiler']);

			LogUtil::registerStatus($this->__('Done! Configuration has been updated'));
		}
		return System::redirect(ModUtil::url('bbcode', 'admin', 'config'));
	}

	function _validate_size_input(&$input)
	{
		$input = strtolower(trim($input));
		return (bool)preg_match('/(^\d{1,4}|(^\d{1,4}\.{0,1}\d{1,2}))(cm|em|ex|in|mm|pc|pt|px|\%)$/', $input);
	}

}

    
