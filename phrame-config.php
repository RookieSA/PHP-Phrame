<?php
	namespace Phrame;
	/*
	* Phrame configuration
	* Set your Phrame configurations here
	*/
	$LOC_MODULES = "./modules";
	$LOC_VIEWS = "./views";
	$LANGUAGE = "en-gb";
		
	/*
	* Phrame Core
	*/
	define(LOC_MODULES, $LOC_MODULES);
	define(LOC_VIEWS, $LOC_VIEWS);
	set_lang($LANGUAGE);
	$phrame_modules = array();
	$phrame_config = array();
	
	function set_lang($_lang) {
		if(file_exists("./lang/".$_lang.".php")):
			require_once("./lang/".$_lang.".php");
		else:
			throw new \Exception("The language file '$_lang' does not exist. Please refer to the lang directory", 3);
		endif;
	}
	