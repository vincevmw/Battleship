
<script>
	
	
	// Class to hold all attributes of the board state for either the player's board or 
	// the player's actions on the enemy's board.
	class GameState {
		
		constructor() {
			this.superPower = false;
			this.started = false;
			this.ended = false;
			this.ready = false;
			this.won = false;
			this.score = 0;
			this.turnCount = 0;
			this.turnPlayer
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
				}
				patrolboat: {
					size: 2,
					hits: 0,
					placed: false,
					sunk: false
				}
			};
			
			
		}
	}

</script>
		