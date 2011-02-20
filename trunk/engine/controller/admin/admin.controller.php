<?php

Class admin_controller {

    var $_contentManager;

	function admin_controller(){ 
        $this->_view = Base::Load('Component')->_view;
        $this->_contentManager = Base::Load(CLASS_CONTENT_MANAGER);
        $this->_BBD = Base::Load(CLASS_BDD)->_connexion;
        
        // Left Nav
        $this->_view->addBlock('mainNav', 'admin_mainNav.tpl', 'view/admin/');

	}
	
	function defaut(){}


    /***
     *  CONTENUS
     * */
    function contenus(){
        if(isset($_GET['param'][0])){
            if($_GET['param'][0] == 'ajouter')  // Ajouter
                $this->newContent($_GET['param'][1]);
            elseif($_GET['param'][0] == 'delete')  // Ajouter
                $this->deleteContent($_GET['param'][1]);
            else
                $this->editContent($_GET['param'][0]);   // Edit
        }
        else {      // List
            $data = array();
            $struct = $this->_contentManager->getStructAll();
            foreach($struct as $idS => $strData){
                $data[$idS]['locked'] = (string)$strData[@locked];
                $data[$idS]['name'] = utf8_decode((string)$strData->name);
                $data[$idS]['description'] = utf8_decode((string)$strData->description);


                $collection = $this->_contentManager->getCollectioName($idS);
                $ContentManager = $this->_BBD->selectCollection($collection);

                foreach($ContentManager->find() as $d){
                    $data[$idS]['data'][(string)$d['_id']] = $d;
                    unset($data[$idS]['data'][(string)$d['_id']]['_id']);
                }

                foreach($struct[$idS]->types->type as $chmp){
                    if(isset($chmp->index)){
                        $data[$idS]['index'][] = (string)$chmp->id;
                    }
                }
            }

            $this->_view->assign('typeList',$data);
            $this->_view->addBlock('content', 'admin_ContentManager_contentList.tpl');
        }

    }

    function newContent($type){
        $struct = $this->_contentManager->getStruct($type);
        $type = $this->_contentManager->getType();

        $data = (array)$struct;
        $data['id'] = $data['@attributes']['id'];
        $data['types'] = (array)$data['types'];

        foreach($data['types']['type'] as $i => $u){
            $data['types'][$i] = (array)$data['types']['type'][$i];
            $data['types'][$i]['refType'] = $data['types'][$i]['@attributes']['refType'];
            $data['types'][$i]['valeur'] = (string)$data['types'][$i]['valeur'];
        }
        unset($data['types']['type']);
/*
        var_dump($data);
        exit();
*/
        $this->_view->assign('typeList',$type);
        $this->_view->assign('struct',$data);
        $this->_view->addBlock('content', 'admin_ContentManager_contentEdit.tpl');
    }


    function POST_contentEdit($data){
        $collection = $this->_contentManager->getCollectioName($data['collection']);
        unset($data['collection']);
        $ContentManager = $this->_BBD->selectCollection($collection);
        $ContentManager->insert($data);
        header('location: '.$_SERVER['REDIRECT_URL'].'../../');
    }

    /***
     *  /CONTENUS
     * */




    /***
     *  STRUCTURES
     * */

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
                $tmp = array();
                foreach($d as $id2 => $d2){
                    $tmp[$id][$id2] = (string)$d2;
                }
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
    
    /***
     *  /STRUCTURES
     * */


}
