<?php
	// namespace value must be the same as defined in config.xml
	namespace MySQL;
	
	// Class name must me the same as the file name without .inc.php
	class db {
		
		private $conid;
		public $db_server;
		public $db_name;
		public $db_user;
		public $db_pass;
		
		public function __construct($db_server, $db_name, $db_user, $db_pass) {
			$this->db_server = $db_server;
			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->conid = $this->dbconnect();
  			$this->dbsql("USE $db_name;");	
		}
		
		public function  dbpar($data) {
			return "'".$data."'";
		}
		public function dbconnect () {
			$mysql=mysql_pconnect($this->db_server,$this->db_user,$this->db_pass) or die (print mysql_error());
			return $mysql;
		}
		public function dbsql ($sql) {
			global $conid;
			$result= mysql_query($sql,$this->conid);
			return $result;
		}
		public function dbfetch ($result) {
			if ($row=mysql_fetch_array($result)) return $row;
			else return false;
		}
		public function dbrows ($result) {
			$num=mysql_num_rows($result);
			return $num;
		}
		public function dbfree ($result) {
		  	mysql_free_result($result);
		}
		public function dbclose() {
			mysql_close($this->$conid);
		}
  


	}