SqlGenerator
=====

PHP library to generate and execute SQL queries in an OOP fashion using prepared statements via ```PDO```.

## Requirements
The latest version has been tested on **PHP 7.4** and uses type definition. ```PDO``` must be installed and of course you will need a database management system and its PHP driver.

## How to use
See the ```index.php``` file for a list of all methods and advanced examples.

1. Create a ```SqlGenerator``` instance and feed it your ```PDO``` object:

  ```php
$dbh = new PDO('sqlite:db.db');
$sg = new \Yosko\SqlGenerator($dbh);
  ```
2. Use it for a single query:

  ```php
$sg->select('MyTable');
$data = $sg->execute();
  ```

## Licence

This library is a work by Yosko, all wright reserved.

It is licensed under the [GNU LGPL](http://www.gnu.org/licenses/lgpl.html) license.
