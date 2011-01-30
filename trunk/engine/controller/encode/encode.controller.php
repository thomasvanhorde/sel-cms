<?php

Class encode_controller {

	function encode_controller(){}

	function defaut(){
       echo selEncode($_GET['param'][0], ENCODE_METHOD);
	}

}

?>