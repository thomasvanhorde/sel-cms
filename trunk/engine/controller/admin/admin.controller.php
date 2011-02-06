<?php

Class admin_controller {

    var $_contentManager;

	function admin_controller(){ 
        $this->_view = Base::Load('Component')->_view;
        $this->_contentManager = Base::Load(CLASS_CONTENT_MANAGER);
	}
	
	function defaut(){
        $this->editStruct(1);
	}

    function editStruct($structID){
        $data = array();
        $struct = $this->_contentManager->getStruct($structID);

        if(isset($struct->name))
            $data['name'] = (string)$struct->name;
        if(isset($struct->description))
        $data['description'] = (string)$struct->description;
        
        foreach($struct->types->type as $id => $d){
            foreach($d as $id2 => $d2)
                $tmp[$id][$id2] = (string)$d2;
            $tmp['structId'] = (string)$d[@refType];
            $data['data'][] = $tmp;
        }


        $this->_view->assign('struct',(array)$data);
        $this->_view->addBlock('content', 'admin_ContentManager_structEdit.tpl');

    }

}

?>