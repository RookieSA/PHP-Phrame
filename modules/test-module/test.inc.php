<?php
	// namespace value must be the same as defined in config.xml
	namespace TestApp;
	
	// Class name must me the same as the file name without .inc.php
	class test {
		public function print_user($name, $surname) {
			print $name." ".$surname;	
		}
	}