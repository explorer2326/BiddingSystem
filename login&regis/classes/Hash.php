<?php
class Hash{
	public static function encrypt($string){
		return hash('sha256',$string);
	}
}