# PHP-Phrame

A simple PHP Framework that assists with modular development.

PHP-Phrame implements a unique and organised modular structure that allows developers to contribute to and develop custom modules for other PHP developers to use.

PHP-Phrame automatically handles the inclusion of all available modules and their classes. These classes are recycled and are globally available across your PHP coding.

The beauty of PHP-Phrame is that modules are treated as installable dependancies that are version-controlled. This means that modules can be installed either manualy or by providing a URL to the external zip archive containing the module you wish to install.

Standard versioning conventions ensure that modules are automatically kept up to date at all times, should you require this.

##Usage
Using PHP-Phrame is quite simple. You only ever need to include the `phrame.php` file in your coding, and the rest will follow.

To demonstrate how easy it ease to use PHP-Phrame; observe the following code:
```php
include("phrame.php");

// PHP-Phrame
$db = new MySQL\db("localhost","dbname","dbuser","dbpass");
$rows = $db->dbsql("SELECT * FROM table_name");
while($row = $db->dbfetch($rows)):
    if($db->is_email($row["email"])):
        print $row["name"]."<br>";
    endif;
endwhile;

// Standard PHP & MySQL
$conn = mysqli_connect("localhost", "dbuser", "dbpass") or die (print mysqli_connect_error());
$init = mysqli_select_db($conn, "dbname") or die (print mysqli_error($conn));
$rows = mysqli_query($conn, "SELECT * FROM table_name") or die (print mysqli_error($conn));
while($row = mysqli_fetch_array($rows)):
    if(filter_var($row["email"], FILTER_VALIDATE_EMAIL)):
       print $row["name"]."<br>";
    endif;
endwhile;
```

The block of code above makes use of the MySQL CRUD module, which is availabe in this repository.

## Modules
A typical module structure follows the following pattern:
* config.xml (Required)
* readme.md (Optional)
* Any amount of PHP classes that contain `.inc` within the filename. At least one class is required

Let's start with the `config.xml` file.

```xml
<?xml version="1.0" encoding="utf-8"?>
<config>
	<namespace>MyModule</namespace>
	<name>My Awesome Module</name>
	<description>A short description of my module</description>
	<version>1.0.0</version>
	<auto_update>false</auto_update>
	<author>John Doe</author>
	<email>john@doe.com</email>
	<url>http://www.doe.com</url>
</config>
```

The configuration file above is standard; and so all nodes and their values are required.
