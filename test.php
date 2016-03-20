<?php
	error_reporting(1);
	include("phrame.php");
	
	$p = new Phrame\phrame(true);
	$p->load_module("http://halosystems.co.za/mysql.zip");
	
	//print "<pre>";
	//print_r($p->get_modules());
	
	
	$db = new MySQL\db("localhost","dbuser","dbpass","");
	$employes = $db->dbsql("SELECT * FROM employees");
	while($employee = $db->dbfetch($employes)):
		print $db->escape($employee["name"]);
	endwhile;

?>