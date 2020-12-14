<?php
	if(isset($_POST["init"])) {
	
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		//Create the connection
		$conn = new mysqli($serverName, $userName, $passWord);
		
		//Validate connection
		if ($conn->connect_error) {
			die("Connection Failed: " . $conn->connect_error . "<br>");
		}
		
		//Initialize database.
		$sql = "CREATE DATABASE IF NOT EXISTS " . $dbName;
		if($conn->query($sql) === FALSE) {
			die("Connection Failed: Could not create DB" . "<br>");
		}
		$conn->close();
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Initialize tables.
		$sql = "CREATE TABLE IF NOT EXISTS registered (
			username VARCHAR(30),
			password VARCHAR(30),
			PRIMARY KEY (username)
		)";
		
		//Test statements to be sure the tables were created.
		if($conn->query($sql) === FALSE) {
			die("Connection Failed: Could not create TABLE" . "<br>");
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS logged_in (
				username VARCHAR(30),
				PRIMARY KEY (username)
			)";
			
		if($conn->query($sql) === FALSE) {
			die("Connection Failed: Could not create TABLE" . "<br>");
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS finding_match (
				username VARCHAR(30),
				PRIMARY KEY (username)
			)";
			
		if($conn->query($sql) === FALSE) {
			die("Connection Failed: Could not create TABLE" . "<br>");
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS game_states (
				username VARCHAR(30),
				hold VARCHAR(30),
				PRIMARY KEY (username)
			)";
			
		if($conn->query($sql) === FALSE) {
			die("Connection Failed: Could not create TABLE" . "<br>");
		}
		
		echo "Database Initialized.";
	}

?>