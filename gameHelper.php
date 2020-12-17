<?php 

	if(isset($_POST["gameSet"])) {
		session_start();
		$gameStateStr = $_POST["gameSet"];
		$gameStateObj = json_decode($gameStateStr);
		
		
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		//Create the connection
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Validate connection
		if ($conn->connect_error) {
			die("Connection Failed: " . $conn->connect_error . "<br>");
		}
		
		$gameStateStr = $_POST["gameSet"];
		$gameStateObj = json_decode($gameStateStr);
		
		
		
		
		
		
		$stmt = $conn->prepare("INSERT INTO game_states VALUES (?,?,?,?,?,?,?,?)");
		
		$stmt->bind_param("siiiisss", $username, $ready, $turnCount, $won, $turnThisPlayer, $ships, $PBO, $EBO);
		$username = $_SESSION["login"];
		$ready = 1;
		$turnCount = 0;
		$won = 0;
		$turnThisPlayer = 0;
		$ships = json_encode($gameStateObj->ships);
		$PBO = json_encode($gameStateObj->PBO);
		$EBO = json_encode($gameStateObj->EBO);
		
		$stmt->execute();
		$stmt->close();
		
		
		
		echo "Table values have been set. Match can start.";
	}
	
	
	if(isset($_POST["readyGame"])) {
		session_start();
		
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		//Create the connection
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Validate connection
		if ($conn->connect_error) {
			die("Connection Failed: " . $conn->connect_error . "<br>");
		}
		$opp = $_SESSION["opponent"];
		
		$sql = "SELECT * FROM game_states WHERE username = '" . $opp . "'";
		
		if($conn->query($sql) === FALSE) {
			die("COULD NOT FIND AN OPPONENT!" . "<br>");
		}
		
		$result = $conn->query($sql);
		
		$oppStates = $result->fetch_assoc();
		
		if($oppStates["ready"] == 1) {}
	}


?>