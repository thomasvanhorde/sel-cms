<?php

Class access_control_controller {

    private $_view;
    
	function access_control_controller(){
        $this->_view = Base::Load(CLASS_VUE);
    }

	function defaut(){}

    function POST_connect($data){
        if(isset($data['user_name']) && isset($data['user_password'])){
            // To redirect 
            $redirect = selDecode($_SESSION['redirect'], 'base64');

            // Load redirect data
            $dataC = Base::LoadDataPath($redirect);
            $Controller = $dataC['controller'];
            $INFOS_ACCES_CONTROL = INFOS_ACCESS_CONTROL;
            $ControllerAccessControl = $Controller->$INFOS_ACCES_CONTROL;
            $ControllerAccessControlLogin = INFOS_ACCESS_CONTROL_LOGIN;
            $ControllerAccessControlPassword = INFOS_ACCESS_CONTROL_PASSWORD;
            $INFOS_CONTROLLER = INFOS_CONTROLLER;
            $ControllerName = $Controller->$INFOS_CONTROLLER;

            $ControllerAccessControlLogin = $ControllerAccessControl->$ControllerAccessControlLogin;
            $ControllerAccessControlPassword = $ControllerAccessControl->$ControllerAccessControlPassword;

            // TEST LOGIN & MDP
            if($ControllerAccessControlLogin == $data['user_name'] && selEncode($data['user_password'], ENCODE_METHOD) == $ControllerAccessControlPassword){
                echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL='.SYS_FOLDER.substr($redirect, 1).'">';
                $this->_view->assign('return_access', Base::Load(CLASS_CORE_MESSAGE)->Generic('MESS_ACCESS_CONTROL_ALLOW'));
                unset($_SESSION[SESSION_REDIRECT]);
                $_SESSION[SESSION_ACCESS_CONTROL][(string)$ControllerName] = true;
            }
            else {
                $this->_view->assign('return_access', Base::Load(CLASS_CORE_MESSAGE)->Generic('MESS_ERR_ACCESS_CONTROL_BAD_MDP'));
            }

        }
    }

    function disconnect(){
        unset($_SESSION[SESSION_ACCESS_CONTROL]);    
    }
}

?>