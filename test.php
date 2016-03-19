<?php
	include("phrame.php");
	
	$p = new phrame();
	$p->autoload();

	print_r($p->get_modules());
?>