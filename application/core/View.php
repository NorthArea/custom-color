<?php
class View{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	function generate($content_view, $data = null, $template_view = 'template.php'){
	  /*
		if(is_array($data)) {
			extract($data);
		}
		*/
		include 'application/views/'.$template_view;
	}
	private function __clone() {}
  private function __sleep(){}
  private function __wakeup(){}
}