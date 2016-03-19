<?php
	error_reporting(1);
	include("phrame.php");
	
	$p = new Phrame\phrame(true);
	print "<pre>";
	print_r($p->get_modules());

	// Module namespace\Class namespace::Class function
	TestApp\test::print_user("Ruan", "Lamprecht");
?>