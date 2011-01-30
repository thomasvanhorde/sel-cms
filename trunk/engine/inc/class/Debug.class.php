<?php

/**
 *  @author Thomas VAN HORDE
 *  @description Use PqP Debug
 */


include ENGINE_URL.'inc/class/ext/pqp/index.php';

Class Debug {

    /**
     * @param  $data
     * @return void
     */
	function log($data){
		Console::log($data);
	}

    /**
     * @param  $exception
     * @return void
     */
	function logError($exception){
		Console::logError($exception);
	}

    /**
     * @param  $var
     * @param  $name
     * @return void
     */
	function logMemory($var = null, $name = null){
		Console::logMemory($var, $name);
	}

    /**
     * @return void
     */
	function logSpeed(){
		Console::logSpeed();
	}

    /**
     * @param  $sql
     * @param  $start
     * @return void
     */
	function logQuery($sql, $start){
		Console::logQuery($sql, $start);
	}


}


?>