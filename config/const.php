<?php

session_start();// session for msg
define('SITEURL','http://localhost/food_prac2/');// Site Url for redirect pages
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');




$conn =mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error());


?>
