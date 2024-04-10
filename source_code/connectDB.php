<?php
// CONNECT TO LOCAL DATABASE
 /*
$host = "localhost";
$database = "DDL360";
$user = "webuser";
$password = "P@ssw0rd";
$connection = mysqli_connect($host, $user, $password, $database);
 */

// CONNECT TO JOLO'S WEBSERVER DATABASE 
// /*
$host = "localhost";
$database = "db_85456473";
$user = "85456473";
$password = "85456473";
$connection = mysqli_connect($host, $user, $password, $database);
// */

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>