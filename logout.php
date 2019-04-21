<?php

require_once 'inc/core.php';

session_unset();


session_destroy();

header("Location: index.php");


?>