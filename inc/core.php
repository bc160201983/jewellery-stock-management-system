<?php

session_start();

require_once 'db.php';
require_once 'functions.php';

// echo $_SESSION['user_id'];

if (!$_SESSION['user_id']) {
	
	header("Location: ./index.php");
}


?>