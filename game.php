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
						
						let hold= ""+i+j;
						game.PBO[hold] = {
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
						
						let hold= ""+i+j;
						game.EBO[hold] = {
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
				
				//Keep track of some board state variables
				var ships = Object.keys(game.ships);
				var currShip = 0;
				var currLength = 5;
				var placingVH = "vertical";
				
				//Check if there is a ship in the path of our placement. If true, there is a ship in the way.
				function checkShip(row, column, length, vh) {
					if(vh == "vertical") {
						for(let i=0; i<length; i++) {
							let hold= ""+(row+i)+column;
							if(game.PBO[hold].ship == true) {/*alert("Should say: true (not a string): "+game.PBO[hold].ship+"... Found at "+hold+" and placement is: "+placingVH);*/ return true;}
						}	
					}
					else {
						for(let i=0; i<length; i++) {
							let hold= ""+row+(column+i);
							
							if(game.PBO[hold].ship == true) {/*alert("Should say: true (not a string): "+game.PBO[hold].ship+"... Found at "+hold+" and placement is: "+placingVH);*/ return true;}
						}
					}
					return false;
				}
				
				//Function to start placing Vertically (sets hover functionality).
				function placingV(length) {
					
					for(let i=1; i<11; i++) {
						for(let j=1; j<11; j++) {
							$("#pCoord"+i+j).unbind("mouseover mouseout");
							$("#pCoord"+i+j).mouseover(function() {
								
								if(i+length > 11) {
									for(let k=i; k<11; k++) {
										if($("#pCoord"+k+j).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+k+j).css("background-color", "red");
									}
								}
								else {
									for(let k=i; k<i+length; k++) {
										if($("#pCoord"+k+j).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+k+j).css("background-color", "lightgreen");
									}
								}
							})
							.mouseout(function() {
								if(i+length > 11) {
									for(let k=i; k<11; k++) {
										//alert($("#pCoord"+k+j).css("background-color"));
										if($("#pCoord"+k+j).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+k+j).css("background-color", "revert");
									}
								}
								else {
									for(let k=i; k<i+length; k++) {
										//alert($("#pCoord"+k+j).css("background-color"));
										if($("#pCoord"+k+j).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+k+j).css("background-color", "revert");
									}
								}
							});
						}
					}
				}
				
				//Function to start placing Horizontally (sets the hover functionality of the board).
				function placingH(length) {
					for(let i=1; i<11; i++) {
						for(let j=1; j<11; j++) {
							$("#pCoord"+i+j).unbind("mouseover mouseout");
							$("#pCoord"+i+j).mouseover(function() {
								//$(this).css("background-color", "lightgreen");
								if(j+length > 11) {
									for(let k=j; k<11; k++) {
										if($("#pCoord"+i+k).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+i+k).css("background-color", "red");
									}
								}
								else {
									for(let k=j; k<j+length; k++) {
										if($("#pCoord"+i+k).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+i+k).css("background-color", "lightgreen");
									}
								}
							})
							.mouseout(function() {
								if(j+length > 11) {
									for(let k=j; k<11; k++) {
										if($("#pCoord"+i+k).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+i+k).css("background-color", "revert");
									}
								}
								else {
									for(let k=j; k<j+length; k++) {
										if($("#pCoord"+i+k).css("background-color") == "rgb(169, 169, 169)") continue;
										else $("#pCoord"+i+k).css("background-color", "revert");
									}
								}
							});
						}
					}
				}
				//Setting default start as Vertical placement.
				placingV(currLength);
				
				$("#dir").html("PLEASE PLACE YOUR SHIPS!");
				$("#subdir").html("Currently placing Carrier(size of 5)...");
				
				
				//Setting action on click during placement.
				function setClick(hv, length) {
					for(let i=1; i<11; i++) {
						for(let j=1; j<11; j++) {
							$("#pCoord"+i+j).unbind("click");
							$("#pCoord"+i+j).click(function() {
								
								if(hv == "vertical") {
									if(i+length < 12 && !checkShip(i, j, length, hv)) {
										for(let k=i; k<i+length; k++) {
											$("#pCoord"+k+j).css("background-color", "darkgrey");
											game.PBO[""+k+j].ship = true; 
										}
										
										if(currShip == 4) readyState();
										else {
											currShip++;
											currLength = parseInt(game.ships[ships[currShip]].size);
											$("#subdir").html("Currently placing "+ships[currShip]+"(size of "+currLength+")...");
											placingVH = "vertical";
											placingV(currLength);
											setClick(placingVH, currLength);
										}
									}
								}
								else {
									if(j+length < 12 && !checkShip(i, j, length, hv)) {
										for(let k=j; k<j+length; k++) {
											$("#pCoord"+i+k).css("background-color", "darkgrey");
											game.PBO[""+i+k].ship = true;
										}
										
										if(currShip == 4) readyState();
										else {
											currShip++;
											currLength = parseInt(game.ships[ships[currShip]].size);
											placingVH = "vertical";
											placingV(currLength);
											setClick(placingVH, currLength);
										}
									}
								}
								
							
							});
						}
					}
				}
				
				//Calling our Vertical and Horizontal switch functions back and forth when clicking the button.
				$("#vhb").click(function(){
					if(placingVH == "vertical") {placingVH = "horizontal"; placingH(currLength); setClick(placingVH, currLength);}
					else {placingVH = "vertical"; placingV(currLength); setClick(placingVH, currLength);}
					
				});
				
				setClick(placingVH, currLength);
				
			});
		</script>
	</head>
	<body id="gameOn">
		<div id="boardLabels"><h2 id="yb">YOUR BOARD</h2><h2 id="eb">ENEMY BOARD</h2></div>
		<div id="boards"></div>
		<div id="dir"></div>
		<div id="subdir"></div>
		<div id="button"><button id="vhb">Switch (Vertical/Horizontal) Placement</button></div>
	</body>
</html>