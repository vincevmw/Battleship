	
class GameState {
	
	constructor() {
		//Create all of our necessary fields.
		this.ready = false;
		this.won = false;
		this.score = 0;
		this.turnCount = 0;
		this.turnThisPlayer = false;
		this.ships = {
			Carrier: {
				size: 5,
				hits: 0,
				placed: null,
				sunk: false
				
			},
			Battleship: {
				size: 4,
				hits: 0,
				placed: null,
				sunk: false
			},
			Destroyer: {
				size: 3,
				hits: 0,
				placed: null,
				sunk: false
			},
			Submarine: {
				size: 3,
				hits: 0,
				placed: null,
				sunk: false
			},
			Patrolboat: {
				size: 2,
				hits: 0,
				placed: null,
				sunk: false
			}
		};
		//States of each coordinate. Has a torpedo hit here? Is there a ship here?
		this.PBO = {}; //Player Board Object
		this.EBO = {}; // Enemy Board Object
	}
}
		