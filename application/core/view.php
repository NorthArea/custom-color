<?php

class View{
  
	function generate($content_view, $data = null, $template_view = TEMPLATE){
		/*
		if(is_array($data)) {
			
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		include 'application/views/'.$template_view;
	}
	
}
