<!DOCTYPE html>
<html>
	<head>
		<title>Main Menu</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
			
			$(document).ready(function() {
					$.ajax({
						type: "POST",
						url: "session.php",
						data: {checkSession: true}
					}).done(function(msg) {
						if(msg != "NO_SESSION") {
							//If logged in, remove login button and registration button.
							$("#login").hide();
							$("#register").hide();
							
							//Create "Find a match" button on menu.
							var findMatch = $("<a></a>").attr("id", "findMatch")
														.attr("class", "menulistitem")
														.attr("href", "findMatch.php")
														.append("<li>Find Match</li>");
							$("#menulist").prepend(findMatch);
							//Create "Logout" button on menu.
							var logout = $("<a></a>").attr("id", "logout")
														.attr("class", "menulistitem")
														.attr("href", "logout.php")
														.append("<li>Logout</li>");
							$("#menulist").append(logout);
							
							//Create a greeting for the logged in user.
							var greeting = $("<span></span>").attr("id", "greeting")
																.append("Welcome to Battleship, " + msg + "!")
																.css("font-size", "25px")
																.css("font-family", "Impact, fantasy");
							$("h1").after(greeting);
							
						}
					});
			});
		</script>
	</head>
	<body>
		<div id="menu">
			<img id="logo" src="images/battleshiplogo.png">
			<h1>Main Menu</h1>
			<ul id="menulist">
				<a class="menulistitem" id="login" href="login.php"><li>Login</li></a>
				<a class="menulistitem" id="register" href="register.php"><li>Register</li></a>
				<a class="menulistitem" id="help" href="help.html"><li>Help</li></a>
				<a class="menulistitem" id="about" href="about.html"><li>About</li></a>
			</ul>
		</div>
		
	</body>
	<p id="copyright">&copy; VINCENT WEINBERGER - FRESNO STATE FALL SEMESTER 2020<img id="paw" src="images/paw.png"></p>
</html>