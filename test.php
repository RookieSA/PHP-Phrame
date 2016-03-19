<?php
	error_reporting(1);
	include("phrame.php");
	
	$p = new Phrame\phrame(true);
	$p->load_module("http://halosystems.co.za/another-module.zip");
	$p->load_module("http://halosystems.co.za/yet-another-module.zip");
	
	print "<pre>";
	print_r($p->get_modules());
	
	$testApp = new AnotherModule\test;
	$testApp->print_user("Ruan", "Lamprecht");
	
	print "<br/>";
	
	YetAnotherModule\woohoo::twerk();
?>