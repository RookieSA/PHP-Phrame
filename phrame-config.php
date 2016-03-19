<?php
	namespace Phrame;
	/*
	* Phrame configuration
	*/
	$APP_NAMESPACE = "Test";
	$LOC_MODULES = ".\modules";
	$LOC_VIEWS = ".\views";
	/*
	* End of Phrame configuration
	*/
	
	/*
	* Phrame Core
	*/
	define(LOC_MODULES, $LOC_MODULES);
	define(LOC_VIEWS, $LOC_VIEWS);
	define(ERR_NO_CONFIG_FILE, "There is no configuration file in module '%s'");
	$phrame_modules = array();
	$phrame_config = array();
	