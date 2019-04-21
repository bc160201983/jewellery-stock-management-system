<?php

$db_server = "localhost";
$db_name = "j";
$db_user = "root";
$db_pass = "123456";

$connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$connection) {
	die("Connection Failed" . mysqli_error($connection));
}else{
	//echo "connected";
}




?>