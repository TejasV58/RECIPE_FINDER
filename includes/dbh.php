<?php

$servername = "localhost";
$DbUsername = "root";
$Dbpassword = "password";
$Dbname = "recipe finder";

$conn = mysqli_connect($servername,$DbUsername,$Dbpassword,$Dbname);


if(!$conn){
    die("Connection failed : ".mysqli_connect_error());
}