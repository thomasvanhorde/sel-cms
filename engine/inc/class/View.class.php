<?php

/**
 *  @author Thomas VAN HORDE
 *  @description Use Templating
 */



define('SMARTY_FILE','Smarty-2.6.26/libs/Smarty.class.php');

if(file_exists(FOLDER_CLASS_EXT.SMARTY_FILE))
	include FOLDER_CLASS_EXT.SMARTY_FILE;
elseif(file_exists(ENGINE_URL.FOLDER_CLASS_EXT.SMARTY_FILE))
	include ENGINE_URL.FOLDER_CLASS_EXT.SMARTY_FILE;
else
    Base::Load(CLASS_CORE_MESSAGE)->Critic('ERR_LOAD_CLASS_SMARTY');

class View extends Smarty{
	
	var $_folder;

    /**
     * @return void
     */
	function View(){
		$this->template_dir = '';
		$this->compile_dir = FOLDER_CACHE;  
		$this->compile_check = true;
		$this->force_compile = false;
		$this->debugging = false;
       	$this->left_delimiter = '[%';
       	$this->right_delimiter = '%]';			
	}

    /**
     * @param  $Name
     * @param  $value
     * @return void
     */
	 function assign($Name, $value){
		parent::assign($Name, $value);
	//	if(DEBUG)	Debug::logMemory($value, 'Assign '.$Name.' to Smarty ');
	 }

    /**
     * @param  $template
     * @return void
     */
	function display($template){
		if(file_exists($template.TEMPLATE_EXT))
			parent::display($template.TEMPLATE_EXT);
		elseif(file_exists(ENGINE_URL.$template.TEMPLATE_EXT))
			parent::display(ENGINE_URL.$template.TEMPLATE_EXT);
	}

    /**
     * @param  $blockName
     * @param  $template
     * @param bool $folder
     * @return void
     */
	function addBlock($blockName, $template, $folder = false){
		if(!$folder)
			$folder = $this->_folder;
		if(file_exists($folder.$template.TEMPLATE_EXT))
			$html = parent::fetch($folder.$template.TEMPLATE_EXT);
		elseif(file_exists(ENGINE_URL.$folder.$template.TEMPLATE_EXT))
			$html = parent::fetch(ENGINE_URL.$folder.$template.TEMPLATE_EXT);
		$this->assign($blockName,$html);
	}
	
}

?>