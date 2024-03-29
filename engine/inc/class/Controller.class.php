<?php

/**
 *  @author Thomas VAN HORDE
 *  @description Call Controller
 */



class Controller {

    /**
     * @param bool $ControllerName
     * @param bool $method
     * @return void
     */
	function Controller($ControllerName = false, $method = false){
		if($ControllerName) {
            // Gestion des param�tres de la m�thode (facultatif)
            $a = explode('#(#', $method);
            $method = $a[0];
            if(isset($a[1])){
                $b = explode('#)#', $a[1]);
                $array = unserialize($b[0]);
            }

            if(file_exists(FOLDER_APPLICATION.$ControllerName.'/'.$ControllerName.CONTROLLER_EXT))
                include_once FOLDER_APPLICATION.$ControllerName.'/'.$ControllerName.CONTROLLER_EXT;
            elseif(file_exists(ENGINE_URL.FOLDER_APPLICATION.$ControllerName.'/'.$ControllerName.CONTROLLER_EXT))
                include_once ENGINE_URL.FOLDER_APPLICATION.$ControllerName.'/'.$ControllerName.CONTROLLER_EXT;

            $ControllerName = $ControllerName.CONTROLLER_NAME_EXT;

            $ControlerObj = new $ControllerName;

			if(!$method)
				$method = INFOS_METHOD_DEFAUT;

			// On appel la m�thode
            if(isset($array) && is_array($array))
			    $ControlerObj->$method($array);
            else
                $ControlerObj->$method();
		}
	}
	
}

?>