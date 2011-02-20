<?php

include ENGINE_URL.FOLDER_CLASS.'ContentManager/ContentType.class.php';
include ENGINE_URL.FOLDER_CLASS.'ContentManager/ContentStruct.class.php';

class ContentManager {

    var $_type;
    var $_struct;

    function __construct(){
       $this->_type = new ContentType();
       $this->_struct = new ContentStruct();
    }

    function getType(){
        return $this->_type->get();
    }

    function getStruct($structID = false){
        $structures =  $this->_struct->get();
        if($structID)
            $structures = $structures[$structID];
        return $structures;
    }

    function getStructAll($structID = false){
        $structures =  $this->_struct->getAll();
        if($structID)
            $structures = $structures[$structID];
        return $structures;
    }

    function getCollectioName($id){
        return 'ContentManager_'.$id;
    }

}


?>