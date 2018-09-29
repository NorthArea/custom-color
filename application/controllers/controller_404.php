<?php
class Controller_404{
  
  function __construct(){
		$this->view = new View();
	}
	
	function action_index(){
		$this->view->generate('view_404.php', 'view_template.php');
	}

}