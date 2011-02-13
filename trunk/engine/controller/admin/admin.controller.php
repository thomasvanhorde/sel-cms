<?php

Class admin_controller {

    var $_contentManager;

	function admin_controller(){ 
        $this->_view = Base::Load('Component')->_view;
        $this->_contentManager = Base::Load(CLASS_CONTENT_MANAGER);

        // Left Nav
        $this->_view->addBlock('mainNav', 'admin_mainNav.tpl', 'view/admin/');

	}
	
	function defaut(){
        // $this->editStruct(1);
	}

    // Struct list
    function structures(){

        if(isset($_GET['param'][0])){
            $this->editStruct($_GET['param'][0]);
        }
        else {
            $data = array();
            $struct = $this->_contentManager->getStruct();

            foreach($struct as $idS => $strData){
                $data[$idS]['name'] = (string)$strData->name;
                $data[$idS]['description'] = (string)$strData->description;
            }

            $this->_view->assign('struct',$data);
            $this->_view->addBlock('content', 'admin_ContentManager_structList.tpl');
        }

    }

    function editStruct($structID){
        $data = array();
        $struct = $this->_contentManager->getStruct($structID);
        $type = $this->_contentManager->getType();
    
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


        $this->_view->assign('structID',$structID);
        $this->_view->assign('struct',(array)$data);
        $this->_view->assign('typeList',$type);
        $this->_view->addBlock('content', 'admin_ContentManager_structEdit.tpl');

    }

    function POST_structEdit($data){
        $this->_contentManager->_struct->save($data);
        header('location: '.$_SERVER['REDIRECT_URL']);
        exit();
    }

}

?>