<?php

	$server="localhost";
	$user="tutorial";
	$pass="supersecretpassword";
	$db="alyyakan";

	// connect to MySQL
	mysql_connect($server, $user, $pass) or die("Sorry, cannot connect to MySQL.");

	// select the database
	mysql_select_db($db) or die("Sorry, couldn't select the datbase.");
?>