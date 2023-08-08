<?php
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "";
	$dbName = "phpproject";
	$db = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	if($db){
		//echo "connected";
	}
	else{
		die("Connection Failed.".mysqli_error($db));
	}
?>