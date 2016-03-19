This module facilitates an easy way of performing CRUD (Create, Read, Update, Delete) operations on a MySQL database

Example usage would be:


```php
$db = new MySQL\db($dbserver, $dbname, $dbuser, $dbpass);
$vegetables = $db->dbsql("SELECT * FROM vegetables");
while($vegetable = $db->dbfetch($vegetables)):
	print $vegetables["name"];
endwhile;
```