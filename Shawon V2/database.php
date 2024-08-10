<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "s_portfolio";
 
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if(!$conn){
    die("Something Went Wrong, Please try again....");
}
?>