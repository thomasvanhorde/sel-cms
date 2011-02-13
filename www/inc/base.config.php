<?php

define('DEBUG', false);
define('DEV', true);

Define_once('BDD_TYPE', 'mysql');
Define_once('BDD_LOGIN', 'root');
Define_once('BDD_PWD', '');
Define_once('BDD_SERVER', 'localhost');
Define_once('BDD_BASE', 'sql');
Define_once('BDD_DOCTRINE', BDD_TYPE.'://'.BDD_LOGIN.'@'.BDD_SERVER.'/'.BDD_BASE);

/***
 * Using for String encode
 * */
//  En cas de changement, il faut régénérer les password <!>
define('GRAIN_SEL', 'b4d6g6hZrt4treD4hrt68kuyki65hr');
// Methode utilisé
define('ENCODE_METHOD', 'md5'); // sha1 | md5

// Use OoCss, ex Tmargin auto create if use in html code
Define_once('CSS_OBJECT',false);

// Use CSS Compressor
if(DEV)
    Define_once('CSS_COMPRESSOR',false);
else
    Define_once('CSS_COMPRESSOR',true);



// Defaut config
if($_SERVER['SCRIPT_FILENAME'] == 'D:/localhost/sel-cms/trunk/www/index.php'){ //Thomas
	Define_once('SYS_FOLDER','www/');
	Define_once('ENGINE_URL','D:/localhost/sel-cms/trunk/engine/');
}

if($_SERVER['SCRIPT_FILENAME'] == 'C:/wwwroot/CMS/www/index.php'){  // Killian
    Define_once('SYS_FOLDER','/CMS/www/');
    Define_once('ENGINE_URL','C:/wwwroot/CMS/engine/');
}




// mysql://utilisateur:motdepasse@serveur/base_de_donnees


?>