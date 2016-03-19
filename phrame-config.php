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
	define(ERR_MODULE_EXTRACT, "An unknown error occured whilst trying to extract the '%s' module. Confirm that both the URL and ZIP file is valid");
	define(ERR_MODULE_INVALID, "The module '%s' is invalid");
	define(ERR_CONFIG_VERSION_INVALID, "The downloaded module's config file versioning is invalid"); 
	$phrame_modules = array();
	$phrame_config = array();
	