	
class GameState {
	
	constructor() {
		//Create all of our necessary fields.
		this.superPower = false;
		this.started = false;
		this.ended = false;
		this.ready = false;
		this.won = false;
		this.score = 0;
		this.turnCount = 0;
		this.turnThisPlayer = false;
		this.placing = true;
		this.ships = {
			carrier: {
				size: 5,
				hits: 0,
				placed: false,
				sunk: false
				
			},
			battleship: {
				size: 4,
				hits: 0,
				placed: false,
				sunk: false
			},
			destroyer: {
				size: 3,
				hits: 0,
				placed: false,
				sunk: false
			},
			submarine: {
				size: 3,
				hits: 0,
				placed: false,
				sunk: false
			},
			patrolboat: {
				size: 2,
				hits: 0,
				placed: false,
				sunk: false
			}
		};
		//States of each coordinate. Has a torpedo hit here? Is there a ship here?
		this.playerBoardObj = {};
		this.enemyBoardObj = {};
	}
}
		