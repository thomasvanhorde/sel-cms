<?php

class ContentStruct {

    private $_data;

    function __construct(){
        $this->load();
    }

    function load(){
        foreach(simplexml_load_file(ENGINE_URL.FOLDER_INC.INFOS_XML_CONTENT_STRUCT, NULL, true)->children() as $k => $e)
            $this->_data[(string)$e['id']] = $e;
    }

    function get(){
        return $this->_data;
    }

}

?>