<!DOCTYPE html>
<html>
	<head>
		<title>Battleship! - Match in Progress...</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<script type="text/javascript" src="js/gameState.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
				
				var game = new GameState();
				
				//Create tables for each of the two boards.
				var pTable = $("<table></table>").attr("id", "pTable").attr("class", "board");
				var eTable = $("<table></table>").attr("id", "eTable").attr("class", "board");
				
				//Loop through entire 11 x 11 board and create the table rows and data.
				//Also populate our board objects.
				//Player
				for(let i=0; i<11; i++) {
					var tr = $("<tr></tr>").attr("class", "coordRow");
					for(let j=0; j<11; j++) {
						var td = $("<td></td>").attr("id", "pCoord"+i+j).attr("class", "coord");
						
						game.playerBoardObj["pCoord"+i+j] = {
							ship: false,
							torpedo: false
						};
						
						tr.append(td);
					}
					pTable.append(tr);
				}
				//Loop through entire 11 x 11 board and create the table rows and data.
				//Also populate our board objects.
				//Enemy
				for(let i=0; i<11; i++) {
					var tr = $("<tr></tr>").attr("class", "coordRow");
					for(let j=0; j<11; j++) {
						var td = $("<td></td>").attr("id", "eCoord"+i+j).attr("class", "coord");
						
						game.enemyBoardObj["eCoord"+i+j] = {
							ship: false,
							torpedo: false
						};
						
						tr.append(td);
					}
					eTable.append(tr);
				}
				$("#boards").append(pTable);
				$("#boards").append(eTable);
				
				//Initialize letter labels for boards
				$("#pCoord01").html("A"); $("#eCoord01").html("A");
				$("#pCoord02").html("B"); $("#eCoord02").html("B");
				$("#pCoord03").html("C"); $("#eCoord03").html("C");
				$("#pCoord04").html("D"); $("#eCoord04").html("D");
				$("#pCoord05").html("E"); $("#eCoord05").html("E");
				$("#pCoord06").html("F"); $("#eCoord06").html("F");
				$("#pCoord07").html("G"); $("#eCoord07").html("G");
				$("#pCoord08").html("H"); $("#eCoord08").html("H");
				$("#pCoord09").html("I"); $("#eCoord09").html("I");
				$("#pCoord010").html("J"); $("#eCoord010").html("J");
				
				//Initialize numbering labels for boards
				for(let i=1; i<11; i++) {
					$("#pCoord"+i+"0").html(i);
					$("#eCoord"+i+"0").html(i);
					
				}
				
				
				for(let i=1; i<11; i++) {
					for(let j=1; j<11; j++) {
						$("#pCoord"+i+j).hover(function() {
							
						});
					}
				}
				
				$("#dir").html("PLEASE PLACE YOUR SHIPS!");
				$("#subdir").html("Currently placing Carrier(size of 5)...");
				
				$("#vhb").click(function(){
					
					
				});
				
			});
		</script>
	</head>
	<body id="gameOn">
		<div id="boardLabels"><h2 id="yb">YOUR BOARD</h2><h2 id="eb">ENEMY BOARD</h2></div>
		<div id="boards"></div>
		<div id="dir"></div>
		<div id="subdir"></div>
		<div id="vhswitch"><button id="vhb">Switch (Vertical/Horizontal) Placement</button></div>
	</body>
</html>