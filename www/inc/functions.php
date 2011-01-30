<?php

/**
 * @param  $name
 * @param  $value
 * @return void
 */
function Define_once($name, $value){
    if(!defined($name))
        define($name, $value);
}

/**
 * @param  $string
 * @param string $method
 * @return string
 */
function selEncode($string, $method = 'md5'){
    switch($method){
        case 'md5' :
            return md5($string.GRAIN_SEL);
        break;
        case 'sha1' :
            return sha1($string.GRAIN_SEL);
        break;
        case 'base64' :
            return base64_encode($string.GRAIN_SEL);
        break;
    }
}

/**
 * @param  $string
 * @param string $method
 * @return 
 */
function selDecode($string, $method = 'base64'){
    switch($method){
        case 'base64' :
            $tmp = base64_decode($string);
            $tmp2 = explode(GRAIN_SEL, $tmp);
            return $tmp2[0];
        break;
    }
}





?>