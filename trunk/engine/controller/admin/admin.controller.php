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
            if($_GET['param'][0] == 'ajouter')  // Ajouter
                $this->newStruct();
            elseif($_GET['param'][0] == 'delete')  // Ajouter
                $this->deleteStruct($_GET['param'][1]);
            elseif($_GET['param'][0] == 'clone')  // Cloner
                $this->cloneStruct($_GET['param'][1]);
            else
                $this->editStruct($_GET['param'][0]);   // Edit
        }
        else {      // List
            $data = array();
            $struct = $this->_contentManager->getStructAll();
            
            foreach($struct as $idS => $strData){
                $data[$idS]['locked'] = (string)$strData[@locked];
                $data[$idS]['name'] = utf8_decode((string)$strData->name);
                $data[$idS]['description'] = utf8_decode((string)$strData->description);
            }

            $this->_view->assign('struct',$data);
            $this->_view->addBlock('content', 'admin_ContentManager_structList.tpl');
        }

    }

    function deleteStruct($uid){
        $uid = $this->_contentManager->_struct->delete($uid);
        header('location: '.$_SERVER['REDIRECT_URL'].'../../');
        exit();
    }

    function newStruct(){
        $type = $this->_contentManager->getType();
        $this->_view->assign('typeList',$type);
        $this->_view->addBlock('content', 'admin_ContentManager_structEdit.tpl');        
    }

    function cloneStruct($structID){
        $this->_view->assign('clone',true);
        $this->editStruct($structID);    
    }
    function editStruct($structID){
        $data = array();
        $struct = $this->_contentManager->getStructAll($structID);
        $type = $this->_contentManager->getType();

        if(isset($struct->name))
            $data['name'] = utf8_decode((string)$struct->name);
        if(isset($struct->description))
        $data['description'] = utf8_decode((string)$struct->description);

        if(count($struct->types) > 0){
            foreach($struct->types->type as $id => $d){
                foreach($d as $id2 => $d2)
                    $tmp[$id][$id2] = (string)$d2;
                $tmp['structId'] = (string)$d[@refType];
                $data['data'][] = $tmp;
            }
        }


        $this->_view->assign('locked',$struct[@locked]);
        $this->_view->assign('structID',$structID);
        $this->_view->assign('struct',(array)$data);
        $this->_view->assign('typeList',$type);
        $this->_view->addBlock('content', 'admin_ContentManager_structEdit.tpl');

    }

    function POST_structEdit($data){
        $uid = $this->_contentManager->_struct->save($data);

        if(isset($data['id']) && !empty($data['id']))
            header('location: '.$_SERVER['REDIRECT_URL']);
        else
            header('location: '.$_SERVER['REDIRECT_URL'].'../'.$uid.'/');

        exit();
    }

}
