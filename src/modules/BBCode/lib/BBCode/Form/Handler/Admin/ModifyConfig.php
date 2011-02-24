<?php

/**
 * BBCode Module
 *
 * @subpackage   BBCode
 * @license      http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */


class BBCode_Form_Handler_Admin_ModifyConfig extends Zikula_Form_Handler
{

    function initialize(Zikula_Form_View $view)
	{
		$this->view->caching = false;
		$this->view->add_core_data();
		$this->view->assign('mimetex_url', ModUtil::getVar('BBCode','mimetex_url'));
		$this->view->assign('quote_preview', nl2br(ModUtil::apiFunc('BBCode', 'user', 'transform',
								      array('objectid' => 1,
									    'extrainfo' => "[quote=username]test\ntest test\n[/quote]"))));
		$hiliteoptions = array(array('text' => $this->__('No highlighting'), 'value' => 0),
				      array('text' => $this->__('GeSHi with line numbers'), 'value' => 1),
				      array('text' => $this->__('GeSHi without line numbers'), 'value' => 2),
				      array('text' => $this->__('Google Code Prettifier'), 'value' => 3));
		$this->view->assign('hiliteoptions', $hiliteoptions);
		$this->view->assign('code_preview', ModUtil::apiFunc('BBCode', 'user', 'transform',
								array('objectid' => 1,
								      'extrainfo' => "[code=php, start=100]<?php\necho 'test';\n?>[/code]")));

		$this->view->assign('spoiler_preview', ModUtil::apiFunc('BBCode', 'user', 'transform',
								  array('objectid' => 1,
									'extrainfo' => "[spoiler]Zikula + BBCode[/spoiler]")));


		PageUtil::addVar('javascript', 'javascript/ajax/prototype.js');
		$modvars = $this->getVar('BBCode');
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
		PageUtil::addVar('javascript', 'modules/BBCode/javascript/BBCode_admin.js');

		return true;
	}


	function handleCommand(Zikula_Form_View $view)
	{
		// Security check
		if (!SecurityUtil::checkPermission('BBCode::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		} 

		$ok = $this->view->isValid(); 
		$data = $this->view->getValues();

		/*if(!$this->_validate_size_input($data['size_tiny'])) {
			$ifield = & $this->view->getPluginById('size_tiny');
			$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
			$ok = false;
		}
		if(!$this->_validate_size_input($data['size_small'])) {
			$ifield = & $this->view->getPluginById('size_small');
			$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
			$ok = false;
		}
		if(!$this->_validate_size_input($data['size_normal'])) {
			$ifield = & $this->view->getPluginById('size_normal');
			$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
			$ok = false;
		}
		if(!$this->_validate_size_input($data['size_large'])) {
			$ifield = & $this->view->getPluginById('size_large');
			$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
			$ok = false;
		}
		if(!$this->_validate_size_input($data['size_huge'])) {
			$ifield = & $this->view->getPluginById('size_huge');
			$ifield->setError(DataUtil::formatForDisplay($this->__('Illegal value, allowed format: up to four decimal places + dot + two decimal places followed by unit, one out of cm,em,ex,in,mm,pc,pt,px or %. Example: 1.05em or 95%.')));
			$ok = false;
		}
		if(!$ok) {
			return false;
		}*/

		// code 
		$this->setVar('code_enabled',  $data['code_enabled']);
		$this->setVar('code',  $data['code']);
		$this->setVar('syntaxhilite',  $data['syntaxhilite']);

		// color
		$this->setVar('color_enabled',  $data['color_enabled']);
		$this->setVar('allow_usercolor',  $data['allow_usercolor']);

		// quote
		$this->setVar('quote_enabled',  $data['quote_enabled']);
		$this->setVar('quote',  $data['quote']);

		// size
		$this->setVar('size_tiny',  $data['size_tiny']);
		$this->setVar('size_small',  $data['size_small']);
		$this->setVar('size_normal',  $data['size_normal']);
		$this->setVar('size_large',  $data['size_large']);
		$this->setVar('size_huge',  $data['size_huge']);
		$this->setVar('size_enabled',  $data['size_enabled']);
		$this->setVar('allow_usersize',  $data['allow_usersize']);

		// mimetex
		$this->setVar('mimetex_enabled',	$data['mimetex_enabled']);
		$this->setVar('mimetex_url',	$data['mimetex_url']);
		
		// misc
		$this->setVar('lightbox_enabled',  $data['lightbox_enabled']);
		$this->setVar('lightbox_previewwidth',  $data['lightbox_previewwidth']);
		$this->setVar('link_shrinksize',  $data['link_shrinksize']);
		$this->setVar('spoiler_enabled',  $data['spoiler_enabled']);
		$this->setVar('spoiler',  $data['spoiler']);

		LogUtil::registerStatus($this->__('Done! Configuration has been updated'));

		return System::redirect(ModUtil::url('BBCode', 'admin', 'config'));
	}

	function _validate_size_input(&$input)
	{
		$input = strtolower(trim($input));
		return (bool)preg_match('/(^\d{1,4}|(^\d{1,4}\.{0,1}\d{1,2}))(cm|em|ex|in|mm|pc|pt|px|\%)$/', $input);
	}

}

    
