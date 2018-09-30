<?php

class Controller {
	
	public $model;
	public $view;
	
	function __construct(){
		$this->view = new View();
	}
	
	// Default action
	function action_index(){
		// todo	
	}
}
