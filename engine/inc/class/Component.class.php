<?php

/**
 *  @author Thomas VAN HORDE
 *  @description Abstract class for controller
 */



Class Component {
	var $_view;
	var $_bdd;
	function Component(){
		$this->_bdd = Base::Load(CLASS_BDD);
	}
}


?>