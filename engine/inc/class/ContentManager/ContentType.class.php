<?php

class ContentType {
    private $_data;

    function __construct(){
        $this->load();
    }

    function load(){
        foreach($this->loadXml()->children() as $k => $e)
            $this->_data[(string)$e['id']] = utf8_decode($e);
    }

    function loadXml(){
        return simplexml_load_file(ENGINE_URL.FOLDER_INC.FOLDER_CONTENT_MANAGER.INFOS_XML_CONTENT_TYPE, NULL, true);
    }

    function get(){
        return $this->_data;
    }
}

?>