<?php

	$server="localhost";
	$user="alyakan";
	$pass="password";
	$db="eShop";

	// connect to MySQL
	mysql_connect($server, $user, $pass) or die("Sorry, cannot connect to MySQL.");

	// select the database
	mysql_select_db($db) or die("Sorry, couldn't select the datbase.");
?>