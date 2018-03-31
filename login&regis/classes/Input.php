<?php
class Input{
public static function exists($type = 'post'){
		return (!empty($_POST)) ? true :false;
	}
	
	public static function get($item){
		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else {
			return '';
		}
	}
}