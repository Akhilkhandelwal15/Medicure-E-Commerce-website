<?php
//start session
session_start();
//create constant to store non repeating values
define('SITEURL','http://localhost/item-order/');
define('LOCALHOST','localhost:3306');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME', 'item-order');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //selecting database

?>