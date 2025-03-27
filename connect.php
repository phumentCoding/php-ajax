<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$database = "php-ajax";
$database = 3306;

$con = mysqli_connect($hostname,$username, $password,$database,$port);

if(!$con){
    echo "error";
}

