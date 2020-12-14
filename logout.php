<?php

	session_start();
	echo "You have been logged out, <b>" . $_SESSION["login"] . "</b>. <br>Redirecting...";
	unset($_SESSION["login"]);
	header('Refresh: 3; URL = index.php');

?>