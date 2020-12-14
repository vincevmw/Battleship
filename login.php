<?php
	$formFilled = (isset($_POST["log"]) && 
					!empty($_POST['U']) && 
					!empty($_POST['P']));
	//Make sure form is filled.
	if($formFilled) {
		$un = $_POST['U'];
		$pwd = $_POST['P'];
		
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Validate connection.
		if ($conn->connect_error) {
			die("Connection Failed: " . $conn->connect_error . "<br>");
		}
		
		//Check to see if user information is registered in database.
		$sql = "SELECT username FROM registered WHERE username='" . $un . "' AND password='" . $pwd . "'";
		
		if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
		else {
			$n = $conn->query($sql)->num_rows;
			
			//If query returns a row then the information provided was correct and user will log in.
			if($n === 0) $logMsg = "ERROR - INCORRECT LOGIN INFORMATION";
			else {
				$logMsg = "Login successful... WELCOME TO BATTLESHIP!";
				$isLog = true;
				session_start();
				$_SESSION["login"] = $un;
			}
			
			
		}
	}

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Log In</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<a href="index.html"><img id="home" src="images/home.png"></a>
		<div id="menu">
			<a href="index.php"><img id="home" src="images/home.png"></a>
			<img id="logo" src="images/battleshiplogo.png">
			<h1>Log In</h1>
			<form class="loginfo" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<input id="U" name="U" type="text" placeholder="USERNAME" required autofocus>
				<br><br>
				<input id="P" name="P" type="password" placeholder="PASSWORD" required>
				<br><br>
				<input type="submit" value="Submit" name="log">
			</form>
			<div id="loginResponse"><br><br>
				<?php 
					if(isset($logMsg)) echo $logMsg;
					if(isset($isLog)) header('Refresh: 3; URL = index.php')
				?>
			</div>
		</div>
		<p id="copyright">&copy; VINCENT WEINBERGER - FRESNO STATE FALL SEMESTER 2020</p>
	</body>
</html>