<?php

Class install_controller{

    var $_instance;

    function __construct(){
        $this->_instance = Base::Load(CLASS_INSTALL);
    }

    function defaut(){
        echo 'Suppresion des tables : <br />';
        $this->_instance->dropTable();
        echo 'Installation des tables : <br />';
        $this->_instance->InitTable();
    }

}
?>