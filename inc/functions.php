<?php

function insert_Categories($cat_title){
	global $connection;

	$query = "INSERT INTO `categories` (cat_title) VALUES('$cat_title')";
	$result = mysqli_query($connection, $query);
	confirm_query($result);

}

function get_all_categories(){
	global $connection;

	$query = "SELECT * FROM categories";
	$results = mysqli_query($connection, $query);
	confirm_query($results);
	return $results;
}


function get_cat_by_id($id){
	global $connection;
	$query = "SELECT * FROM categories WHERE cat_id = $id";
	$results = mysqli_query($connection, $query);
	confirm_query($results);
	return $results;
}

function del_cat_by_id($id){
	global $connection;
	$query = "DELETE FROM categories WHERE cat_id = $id";
	$results = mysqli_query($connection, $query);
	confirm_query($results);
	return $results;
}

function confirm_query($result){
	global $connection;

	if ($result) {

    	return true;
	} else {

    	die("Query Failed" .  mysqli_error($connection));
	}
}


?>