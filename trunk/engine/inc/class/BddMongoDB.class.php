<?php

class BddMongoDB{
    var $_connexion;
    function __construct(){
        $connexion = new mongo("mongodb://lpcm:lpcm@flame.mongohq.com:27033/lpcm");
        $this->_connexion = $connexion->selectDB('lpcm');
    }
}

?>