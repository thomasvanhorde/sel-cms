<?php

//var_dump($_SERVER);
//exit();
/*
 * Système MVC by Thomas VH.
 *
 * Param in inc/base.config.php
 *
 * PHP 5.3+ required
 */

// Start Session
session_start();

header('Content-type: text/html; charset=UTF-8');

// Include base functions
include 'inc/functions.php';

// Load website config
include 'inc/base.config.php';

// Load engine config
if(!include ENGINE_URL.'inc/base.config.php')
    header('location: error_config.php');

// load class config
if(!include FOLDER_INC.'class.config.php')
    header('location: error_config.php');

if(DEBUG){
	include ENGINE_URL.FOLDER_CLASS.'Debug.class.php';
	Debug::log('Init');
	Debug::logSpeed();
}

// ClassLoader Init
if(!include ENGINE_URL.FOLDER_CLASS.'Base.class.php')
    header('location: error_config.php');




// Load MVC from Url rewriting
$SiteObj = Base::Load(CLASS_BASE);
$SiteObj->Start($_SERVER['REQUEST_URI']);
$SiteObj->Display();

?>