This module facilitates an easy way of performing CRUD (Create, Read, Update, Delete) operations on a MySQL database

Example usage would be:


```php
$db = new MySQL\db($dbserver, $dbname, $dbuser, $dbpass);
$vegetables = $db->dbsql("SELECT * FROM vegetables");
while($vegetable = $db->dbfetch($vegetables)):
	print $vegetables["name"];
endwhile;
<<<<<<< HEAD
```
=======
```
>>>>>>> 8caec1d71312045776e8b441264670d8c77b0e6a
