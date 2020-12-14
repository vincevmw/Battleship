<?php
	//Make sure the form has been filled.
	$formFilled = (isset($_POST["reg"]) && 
					!empty($_POST['DU']) && 
					!empty($_POST['DP']) && 
					!empty($_POST['CP']) &&
					($_POST['DP'] === $_POST['CP'])
				);
	
	if($formFilled) {
		//Registration info.
		$un = $_POST['DU'];
		$pwd = $_POST['DP'];
		
		//Connection to database.
		$serverName = "localhost";
		$userName  = "root";
		$passWord = "";
		$dbName = "battleshipvw";
		
		//Create the connection.
		$conn = new mysqli($serverName, $userName, $passWord, $dbName);
		
		//Validate connection.
		if ($conn->connect_error) {
			die("Connection Failed: " . $conn->connect_error . "<br>");
		}
		//Check and make sure username is not already taken.
		$sql = "SELECT username FROM registered WHERE username='" . $un . "'";
		
		if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
		else {
			$result = $conn->query($sql);
			$n = $conn->query($sql)->num_rows;
			//If query returns more than 0 rows, username is taken.
			if($n > 0) {
				$regMsg = "ERROR - USERNAME ALREADY TAKEN";
			}
			//Else register the user with the given information.
			else {
				$sql = "INSERT INTO registered (username, password) VALUES ('" . $un . "','" . $pwd . "')";
		
				if ($conn->query($sql) === FALSE) die($sql . " GIVES THE ERROR: " . $conn->error . "<br>");
		
				$regMsg = "Registration Successful. Please log in...";
				$isReg = true;
			}
		}
	}
	else {
		if(!($_POST['DP'] === $_POST['CP'])) {
			$regMsg = "ERROR - PASSWORDS DO NOT MATCH";
		}
		else if(isset($_POST["reg"]) && (empty($_POST['DU']) || empty($_POST['DP']) || empty($_POST['CP']))) {
						$regMsg = "PLEASE FILL ALL FIELDS";
					}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Main Menu</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<a href="index.php"><img id="home" src="images/home.png"></a>
		<div id="menu">
			
			<img id="logo" src="images/battleshiplogo.png">
			<h1>Register An Account</h1>
			<form class="loginfo" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
				<input id="DU" name="DU" type="text" placeholder="DESIRED USERNAME" value = "" required autofocus >
				<br><br>
				<input id="DP" name="DP" type="password" placeholder="DESIRED PASSWORD" value = "" required >
				<br><br>
				<input id="CP" name="CP" type="password" placeholder="CONFIRM PASSWORD" value = "" required >
				<br><br>
				<input type="submit" name="reg" value="Submit">
			</form>
			<div id="registerResponse"><br><br>
				<?php 
					if(isset($regMsg)) echo $regMsg;
					if(isset($isReg)) header('Refresh: 3; URL = login.php');
				?>
			</div>
			

		</div>
		<p id="copyright">&copy; VINCENT WEINBERGER - FRESNO STATE FALL SEMESTER 2020</p>
	</body>
</html>