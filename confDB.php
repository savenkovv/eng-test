<?php
	$host = "localhost";
	$db = "eng_test";
	$db_user = "root";
	$db_pass = "root";	
	$dsn = "mysql:host=$host;dbname=$db";
	$link_db = mysqli_connect($host, $db_user, $db_pass, $db);
	$pdo = new PDO($dsn, $db_user, $db_pass);

	// $host = "localhost";
	// $db = "host1651446_septspb";
	// $db_user = "host1651446_admin";
	// $db_pass = "8603d3a7";	
	// $dsn = "mysql:host=$host;dbname=$db";
	// $pdo = new PDO($dsn, $db_user, $db_pass);

?>