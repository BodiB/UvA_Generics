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

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function newBoard(board, list, v_t, h_t, t_A, t_B, flip) {
    var h_size = (document.getElementById("memory_board_right").clientWidth - 18) / h_t;
    h_size = h_size - 4
    var size = v_t * h_t;
    setCookie("turned_tiles", 0, 1);
    setCookie("size", size, 1);
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
        var output = '' + list[1] + '</br>';
    } else {
        var output = '' + list[2] + '</br>';
    }

    array.memory_tile_shuffle();
    for (var i = 0; i < array.length; i++) {
        if (flip) {
            output += '<div class="tile", id="tile_' + i + '", onclick="fliptTile(this,\'' + array[i] + '\')" style="width:' + h_size + 'px;height:' + h_size + 'px;background-size: ' + h_size + 'px ' + h_size + 'px;"></div>';
        } else {
            output += '<div class="tile", id="tile_' + i + '", data-value="' + array[i] + '" style="width:' + h_size + 'px;height:' + h_size + 'px;background-size: ' + h_size + 'px ' + h_size + 'px;"></div>';
        }
    }
    document.getElementById(board).style.height = '' + (v_t * h_size + 4 * v_t + 20) + 'px';
    document.getElementById("memory_board").style.height = '' + (v_t * h_size + 4 * v_t + 20) + 'px';
    // document.getElementById(board).innerHTML = output;
    document.getElementById(board).innerHTML = output;
}

function getRandomNode() {
    var nodes = document.getElementsByClassName("tile");
    var randomNode = nodes[Math.floor(Math.random() * (nodes.length - (nodes.length / 2)) + (nodes.length / 2))];
    if (randomNode.innerHTML == "") {
        return randomNode;
    } else {
        return getRandomNode()
    }
}

function gridComplete(turned_tiles, size){
	if (turned_tiles == size) {
		completeGrid.innerHTML = '';
        submitButton.style.display = 'inline';
    }
}

//Global variable to only allow flipping 1 tile at a time.
var running = false;

function fliptTile(tile, val) {
	if (running){
		var x = document.getElementById("snackbar");
		// Add the "show" class to DIV
		x.className = "show";

		// After 3 seconds, remove the show class from DIV
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}
	else{
		running = true;
		var turned_tiles = getCookie("turned_tiles");
		var size = getCookie("size");
		if (tile.innerHTML == "") {
			// Turn the tile pressed by the player.
			turned_tiles++;
			setCookie("turned_tiles", turned_tiles, 1);
			tile.style.background = '#FFF';
			if(val == ''){
				tile.style.backgroundColor = "#FFF";
				tile.innerHTML = " ";
			}
			else{
				tile.innerHTML = '<img src="' + val + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
			}      
			setTimeout(function(){ 
				// Let the "computer" turn a tile.
				var myNode = getRandomNode();
				var myNode_val = myNode.getAttribute("data-value");
				if(myNode_val == ''){
					myNode.style.background = '#FFF';
					myNode.innerHTML = " ";
				}
				else{
					myNode.innerHTML = '<img src="' + myNode_val + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
				}
				if (turned_tiles >= size) {
					gridComplete(turned_tiles, size);
				}	
				running = false;
			}, 1500);
			
		}
		else{
			running = false;
		}

		if(turned_tiles%4==0){
			var intro = "ATTENTION CHECK \n";
			var message = ["Doing great!","Still going strong!","Almost there!","Keep up the good work!","Thank you for taking your time!", "Press cancel to continue.", "Copy the following sentence"];
			var a = Math.floor(Math.random() * message.length);
			var oops = "";
			var oops_count =0;

			if(a==5){
				while(true){
					if(window.confirm(intro + message[a] + oops)){
						oops += "\nOOPS... Keep your focus!"
						oops_count +=1;
						if(oops_count % 4 == 0){
							oops += "\nPLEASE, try the other button..."
						}
					}
					else{
						break;
					}
				}
			}
			else if(a==6){
				var b = Math.floor(Math.random() * message.length);
				var sentence = ":\n" + message[b];
				while(true){
					var promp = window.prompt(intro + message[a]+sentence);
					if(promp == null){
						location.reload();
						break;
					}
					else if(promp != message[b]){
					}
					else{
						break;
					}
				}
			}
			else{
				window.alert(intro + message[a]);
			}
		}
	}
}

function createBoard(list, v_t, h_t, t_A_l, t_B_l, t_A_r, t_B_r) {
    newBoard('memory_board_left', list, v_t, h_t, t_A_l, t_B_l, true);
    newBoard('memory_board_right', list, v_t, h_t, t_A_r, t_B_r, false);
}

function changeFunction(val){
	document.getElementById("rating").value = val;
}
