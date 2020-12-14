<?php

	session_start();
	
	if(isset($_POST["cancelFind"])) {
		$un = $_SESSION["login"];
	
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Validate connection.
		if ($conn->connect_error) die("Connection Failed: " . $conn->connect_error . "<br>");
		
		$sql = "DELETE FROM finding_match WHERE username='" . $un . "'";
		
		if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
		else {
			echo "success";
		}
	}
	
	if(isset($_POST["findGame"])) {
		$un = $_SESSION["login"];
	
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Validate connection.
		if ($conn->connect_error) die("Connection Failed: " . $conn->connect_error . "<br>");
		
		$sql = "SELECT * FROM finding_match WHERE NOT username='" . $un . "'";
		
		if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
		else {
			$result = $conn->query($sql);
			
			if($result->num_rows > 0) {
				$firstFound = $result->fetch_assoc();
				$SESSION_["opponent"] = $firstFound["username"];
				echo "found";
			}
			else echo "keep waiting";
		}
	}

?>