<?php

class ContentStruct {

    private $_data;

    function __construct(){
        $this->load();
    }

    function load(){
        foreach($this->loadXml()->children() as $k => $e)
            $this->_data[(string)$e['id']] = $e;
    }

    function loadXml(){
        return simplexml_load_file(ENGINE_URL.FOLDER_INC.INFOS_XML_CONTENT_STRUCT, NULL, true);    
    }

    function get(){
        return $this->_data;
    }

    function save($data){
        $Xml = $this->loadXml();
        $xmlArray = $this->get();

        $i = 0;
        foreach($xmlArray as $k => $d){
            if((string)$d[@id] == $data['id']){
                $uid = (string)$d[@id];
                unset($Xml->element->$i);
                break;
            }
            $i++;
        }


        $newNode = $Xml->addChild('element');
        $newNode->addAttribute('id', $uid);
        $newNode->addChild('name', $data['name']);
        $newNode->addChild('description', $data['description']);
        $newNodeTypes = $newNode->addChild('types');

        foreach($data['data'] as $i => $d){
            $newNodeTypesType[$i] = $newNodeTypes->addChild('type');
            foreach($d as $key => $value){
                if($key != 'type')
                    $newNodeTypesType[$i]->addChild($key, $value);
                else
                    $newNodeTypesType[$i]->addAttribute('refType', $value);
            }
        }

        $Xml->saveXML(ENGINE_URL.FOLDER_INC.INFOS_XML_CONTENT_STRUCT);
    }

}

?>