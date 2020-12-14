<?php

	if(isset($_POST["checkSession"])) {
		
		session_start();
		if(isset($_SESSION["login"])) {
			$un = $_SESSION["login"];
			echo $un;
			
		}
		else {
			echo "NO_SESSION";
		}
	}
?>