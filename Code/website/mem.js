Array.prototype.memory_tile_shuffle = function() {
	var i = this.length,
		j, temp;
	while (--i > 0) {
		j = Math.floor(Math.random() * (i + 1));
		temp = this[j];
		this[j] = this[i];
		this[i] = temp;
	}
}

// Global variables to store size and #tiles turned
var size = 0;
var turned_tiles = 0;
var pre_statement = "";

function newBoard(board, list, v_t, h_t, t_A, t_B, flip) {
	var h_size = (document.getElementById("memory_board_right").clientWidth - 18) / h_t;
	h_size = h_size - 4
	size = v_t * h_t;
	pre_statement = "Does the following statement describe " + list[1] + "?";
	var array = [];
	var i = 0;
	while (i < t_A) {
		array.push('' + list[3] + '');
		i++;
	}
	i = 0;
	while (i < t_B) {
		array.push('' + list[4] + '');
		i++;
	}
	i = 0;
	while (i < size - t_A - t_B) {
		array.push('');
		i++;
	}
	if (board == 'memory_board_left') {
		var output = '' + list[1] + '<div id="left_score">Score: 0</div>';
	} else {
		var output = '' + list[2] + '<div id="right_score">Score: 0</div>';
	}

	array.memory_tile_shuffle();
	for (var i = 0; i < array.length; i++) {
		if (flip) {
			output += '<div class="tile" id="tile_' + i + '" onclick="fliptTile(this,\'' + array[i] + '\')" style="width:' + h_size + 'px;height:' + h_size + 'px;background-size: ' + h_size + 'px ' + h_size + 'px;"></div>';
		} else {
			output += '<div class="tile" id="tile_' + i + '" data-value="' + array[i] + '" style="width:' + h_size + 'px;height:' + h_size + 'px;background-size: ' + h_size + 'px ' + h_size + 'px;"></div>';
		}
	}
	document.getElementById(board).style.height = '' + (v_t * h_size + 4 * v_t + 45) + 'px';
	document.getElementById("memory_board").style.height = '' + (v_t * h_size + 4 * v_t + 45) + 'px';
	document.getElementById(board).innerHTML = output;
	document.getElementById("memory_board_left").style.background = "#EEE";
	//preload images
	var img = new Image();
	img.src = list[3];
	var img = new Image();
	img.src = list[4];
}

function getRandomNode() {
	var nodes = document.getElementsByClassName("tile");
	var randomNode = nodes[Math.floor(Math.random() * (nodes.length - (nodes.length / 2)) + (nodes.length / 2))];
	if (randomNode.innerHTML == "") {
		return randomNode;
	} else {
		return getRandomNode();
	}
}

function gridComplete(turned_tiles, size) {
	if (turned_tiles >= size) {
		completeGrid.innerHTML = pre_statement;
		submitButton.style.display = 'inline';
		statement.style.display = 'inline';
		return true;
	}
	return false;
}

//Global variable to only allow flipping 1 tile at a time, keep score and compare stuff.
var running = false;
var score = 0;
var comp_score = 0;
var active_node = null;

function computer_turn(tile, val, turned_tiles, size) {
	// Let the "computer" turn a tile.
	var myNode = getRandomNode();
	var myNode_val = myNode.getAttribute("data-value");
	if (myNode.getAttribute("data-value") == '') {
		myNode.style.background = '#FFF';
		myNode.innerHTML = " ";
	} else {
		myNode.innerHTML = '<img src="' + myNode_val + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
	}
	document.getElementById("memory_board_right").style.background = "#CCC";
	if (myNode_val == val) {
		comp_score += 1;
		document.getElementById("turn").innerHTML = "MATCH!";
		document.getElementById("turn").style.background = "#90EE90";
		document.getElementById("right_score").innerHTML = "Score: " + comp_score;
	} else {
		document.getElementById("turn").innerHTML = "No match!";
		document.getElementById("turn").style.background = "#FF4500";
	}
	return [myNode, myNode_val];
}

function fliptTile(tile, val) {
	if (running) {
		var x = document.getElementById("snackbar");
		// Add the "show" class to DIV
		x.className = "show";

		// After 3 seconds, remove the show class from DIV
		setTimeout(function() {
			x.className = x.className.replace("show", "");
		}, 3000);
	} else {
		if (tile.innerHTML == "") {
			running = true;
			document.getElementById("memory_board_left").style.background = "#CCC";
			var nodes = document.getElementsByClassName("tile");
			// Add the turned tile to the counter.
			turned_tiles++;
			if (active_node != null) {
				// Computer has turned and player must match
				attention(turned_tiles);
				tile.style.background = '#FFF';
				if (val == '') {
					tile.style.backgroundColor = "#FFF";
					tile.innerHTML = " ";
				} else {
					tile.innerHTML = '<img src="' + val + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
				}
				if (active_node.innerHTML == tile.innerHTML) {
					score += 1;
					document.getElementById("turn").innerHTML = "MATCH!";
					document.getElementById("turn").style.background = "#90EE90";
					document.getElementById("left_score").innerHTML = "Score: " + score;
				} else {
					document.getElementById("turn").innerHTML = "No match!";
					document.getElementById("turn").style.background = "#FF4500";
				}
				setTimeout(function() {
					//Flip back te previously turned tiles.
					tile.style.fontSize = (tile.clientWidth) + 'px';
					tile.style.lineHeight = (tile.clientWidth) + 'px';
					tile.innerHTML = "X";
					tile.style.backgroundColor = "#E1E1E1";
					active_node.style.fontSize = (tile.clientWidth) + 'px';
					active_node.style.lineHeight = (tile.clientWidth) + 'px';
					active_node.innerHTML = "X";
					active_node.style.backgroundColor = "#E1E1E1";
					active_node = null;
					var completed = gridComplete(turned_tiles, size);
					if (!completed) {
						document.getElementById("turn").innerHTML = "<B>It's your turn to play.</B>";
						document.getElementById("turn").style.background = "transparent";
						document.getElementById("memory_board_left").style.background = "#EEE";
						document.getElementById("memory_board_right").style.background = "#CCC";
					} else {
						if (comp_score > score) {
							document.getElementById("turn").innerHTML = "You lost!";
						} else if (score > comp_score) {
							document.getElementById("turn").innerHTML = "You won!";
						} else {
							document.getElementById("turn").innerHTML = "It's a tie.";
						}
						document.getElementById("turn").style.background = "transparent";
						document.getElementById("memory_board_left").style.background = "#CCC";
						document.getElementById("memory_board_right").style.background = "#CCC";
					}
					running = false;
				}, 1200);
			} else {
				// Player has turned and computer must try to match
				document.getElementById("turn").innerHTML = "It's your opponent’s turn to play.";
				document.getElementById("turn").style.background = "transparent";
				document.getElementById("memory_board_right").style.background = "#EEE";
				document.getElementById("memory_board_left").style.background = "#CCC";
				tile.style.background = '#FFF';
				if (val == '') {
					tile.style.backgroundColor = "#FFF";
					tile.innerHTML = " ";
				} else {
					tile.innerHTML = '<img src="' + val + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
				}

				setTimeout(function() {
					var computers_move = computer_turn(tile, val, turned_tiles, size);
					myNode = computers_move[0];
					myNode_val = computers_move[1];
					setTimeout(function() {
						document.getElementById("turn").innerHTML = "It's your opponent’s turn to play.";
						document.getElementById("turn").style.background = "transparent";
						document.getElementById("memory_board_right").style.background = "#EEE";
						document.getElementById("memory_board_left").style.background = "#CCC";
						tile.style.background = '#FFF';
						//Flip back te previously turned tiles.
						tile.style.fontSize = (tile.clientWidth) + 'px';
						tile.style.lineHeight = (tile.clientWidth) + 'px';
						tile.innerHTML = "X";
						tile.style.backgroundColor = "#E1E1E1";
						myNode.style.fontSize = (tile.clientWidth) + 'px';
						myNode.style.lineHeight = (tile.clientWidth) + 'px';
						myNode.innerHTML = "X";
						myNode.style.backgroundColor = "#E1E1E1";
						document.getElementById("memory_board_right").style.background = "#EEE";
						if (gridComplete(turned_tiles, size)) {
							if (comp_score > score) {
								document.getElementById("turn").innerHTML = "You lost!";
							} else if (score > comp_score) {
								document.getElementById("turn").innerHTML = "You won!";
							} else {
								document.getElementById("turn").innerHTML = "It's a tie.";
							}
							document.getElementById("turn").style.background = "transparent";
							document.getElementById("memory_board_left").style.background = "#CCC";
							document.getElementById("memory_board_right").style.background = "#CCC";
							running = false;
						} else {
							setTimeout(function() {
								active_node = getRandomNode();
								if (active_node.getAttribute("data-value") == '') {
									active_node.style.background = '#FFF';
									active_node.innerHTML = " ";
								} else {
									active_node.innerHTML = '<img src="' + active_node.getAttribute("data-value") + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
								}
								var completed = gridComplete(turned_tiles, size);
								if (!completed) {
									document.getElementById("turn").innerHTML = "<B>It's your turn to play.</B>";
									document.getElementById("turn").style.background = "transparent";
									document.getElementById("memory_board_left").style.background = "#EEE";
									document.getElementById("memory_board_right").style.background = "#CCC";
								} else {
									if (comp_score > score) {
										document.getElementById("turn").innerHTML = "You lost!";
									} else if (score > comp_score) {
										document.getElementById("turn").innerHTML = "You won!";
									} else {
										document.getElementById("turn").innerHTML = "It's a tie.";
									}
									document.getElementById("turn").style.background = "transparent";
									document.getElementById("memory_board_left").style.background = "#CCC";
									document.getElementById("memory_board_right").style.background = "#CCC";
								}
								running = false;
							}, 750);
						}
					}, 1250);
				}, 750);
			}
		} else {
			running = false;
		}
	}
}

function attention(turned_tiles) {
	if (turned_tiles % 17 == 0) {
		var intro = "ATTENTION CHECK \n";
		var message = ["Doing great!", "Still going strong!", "Almost there!", "Keep up the good work!", "Thank you for taking your time!", "Press cancel to continue."];
		var a = Math.floor(Math.random() * message.length);
		var oops = "";
		var oops_count = 0;

		if (a == 5) {
			while (true) {
				if (window.confirm(intro + message[a] + oops)) {
					oops += "\nOOPS... Keep your focus!"
					oops_count += 1;
					if (oops_count % 4 == 0) {
						oops += "\nPLEASE, try the other button..."
					}
				} else {
					break;
				}
			}
		} else {
			window.alert(intro + message[a]);
		}
	}
}

function createBoard(list, v_t, h_t, t_A_l, t_B_l, t_A_r, t_B_r) {
	newBoard('memory_board_left', list, v_t, h_t, t_A_l, t_B_l, true);
	newBoard('memory_board_right', list, v_t, h_t, t_A_r, t_B_r, false);
}
