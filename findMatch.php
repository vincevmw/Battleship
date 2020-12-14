<?php

	session_start();
	
	$un = $_SESSION["login"];
	
	$serverName = "localhost";
	$userName  = "root";
	$passWord = "";
	$dbName = "battleshipvw";
	
	$conn = new mysqli($serverName, $userName, $passWord, $dbName);
	
	//Validate connection.
	if ($conn->connect_error) die("Connection Failed: " . $conn->connect_error . "<br>");
	
	$sql = "SELECT * FROM finding_match";
	
	if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
	else {
		$n = $conn->query($sql)->num_rows;
		if($n > 1) {$full="PLAYER QUEUE IS FULL. TRY AGAIN LATER."; header('Refresh: 3; URL = index.php');}
	}
	
	
	$sql = "INSERT INTO finding_match (username) VALUES ('" . $un . "')";
	
	if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Finding A Match</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
					
					$("#homeButton").hide();
					
					$("#cancelButton").click(function() {
						$.ajax({
							type: "POST",
							url: "findMatchHelper.php",
							data: {cancelFind: true}
						}).done(function(msg) {
							if(msg == "success") {
								window.location.href="index.php";
							}
						});
					});
					
					setInterval(function() {
						var load = $("#loadingContainer").html();
						if(load == "LOOKING FOR A MATCH...") $("#loadingContainer").html("LOOKING FOR A MATCH.");
						if(load == "LOOKING FOR A MATCH.") $("#loadingContainer").html("LOOKING FOR A MATCH..");
						if(load == "LOOKING FOR A MATCH..") $("#loadingContainer").html("LOOKING FOR A MATCH...");
					}, 1000);
					
					setInterval(function() {
						$.ajax({
						type: "POST",
						url: "findMatchHelper.php",
						data: {findGame: true}
					}).done(function(msg) {
						if(msg == "found") {
							window.location.href="game.php";
						}
					});
					
					
					}, 3000);
					
					
					
			});
		</script>
	</head>
	<body>
		<a href="index.php" id="homeButton"><img id="home" src="images/home.png"></a>
		<div id="menu">
			
			<img id="logo" src="images/battleshiplogo.png">
			<div id="loadingContainer">LOOKING FOR A MATCH...</div>
			<div id="cancelContainer"><button id="cancelButton">CANCEL</button></div>
			<div id="full"><?php if(isset($full)) echo $full; ?></div>
			
		</div>
		<p id="copyright">&copy; VINCENT WEINBERGER - FRESNO STATE FALL SEMESTER 2020</p>
	</body>
</html>