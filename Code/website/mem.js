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


function newBoard(board, list, v_t, h_t, p_A, p_B, flip) {
    var h_size = (document.getElementById("memory_board_right").clientWidth - 18) / h_t;
    h_size = h_size - 4
    var size = v_t * h_t;
    setCookie("turned_tiles", 0, 1);
    setCookie("size", size, 1);
    var t_A = Math.floor(size * p_A / 100);
    var t_B = Math.floor(size * p_B / 100);
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
        array.push('https://mycologic-cement.000webhostapp.com/img/UVA-logo.png');
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
            output += '<div class="tile", id="tile_' + i + '", onclick="memoryFlipTile(this,\'' + array[i] + '\')" style="width:' + h_size + 'px;height:' + h_size + 'px;background-size: ' + h_size + 'px ' + h_size + 'px;"></div>';
        } else {
            output += '<div class="tile", id="tile_' + i + '", data-value="' + array[i] + '" style="width:' + h_size + 'px;height:' + h_size + 'px;background-size: ' + h_size + 'px ' + h_size + 'px;"></div>';
        }
    }
    if ((v_t * h_size) > 540) {
        document.getElementById(board).style.height = '' + (v_t * h_size + 4 * v_t + 20) + 'px';
        document.getElementById("memory_board").style.height = '' + (v_t * h_size + 4 * v_t + 20) + 'px';
    }
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

function memoryFlipTile(tile, val) {
    var turned_tiles = getCookie("turned_tiles");
    var size = getCookie("size");
    if (tile.innerHTML == "") {
        turned_tiles++;
        setCookie("turned_tiles", turned_tiles, 1);
        tile.style.background = '#FFF';
        tile.innerHTML = '<img src="' + val + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
        var myNode = getRandomNode();
        var myVal = myNode.getAttribute("data-value");
        myNode.style.background = '#FFF';
        myNode.innerHTML = '<img src="' + myVal + '" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
    }
    if (turned_tiles == size) {
        alert("Please, rate the statement.");
        submitButton.style.display = 'inline';
        // ONLY NOW ALLOW TO GO TO NEXT QUESTION
    }
}

function createBoard(list, v_t, h_t, p_A_l, p_B_l, p_A_r, p_B_r) {
    newBoard('memory_board_left', list, v_t, h_t, p_A_l, p_B_l, true);
    newBoard('memory_board_right', list, v_t, h_t, p_A_r, p_B_r, false);
}


function checkValue(val) {
    // TODO REMOVE AND USE NORMAL VALUES.
    var list = ["Hide Beetles from Genovesa have black wings.", "Marchena Hide Beetles", "Genovesa Hide Beetles", "https://mycologic-cement.000webhostapp.com/img/bettle_A.PNG", "https://mycologic-cement.000webhostapp.com/img/bettle_C.PNG"];
    var v_t = 5; // Vertical number of tiles
    var h_t = 6; // Horizontal number of tiles
    var p_A_l = 40; // Percentage of occurence of A left (floored)
    var p_B_l = 30; // Percentage of occurence of B left (floored)
    var p_A_r = 50; // Percentage of occurence of A right (floored)
    var p_B_r = 50; // Percentage of occurence of B right (floored)
    if (val == 3) {
        var r = confirm("Are you sure you rated the statement?");
    }
    else{
        // SUBMIT
        createBoard(list, v_t, h_t, p_A_l, p_B_l, p_A_r, p_B_r);
        submitButton.style.display = 'none';
    }
    if (r == true) {
        // SUBMIT
        createBoard(list, v_t, h_t, p_A_l, p_B_l, p_A_r, p_B_r);
        submitButton.style.display = 'none';
    } else {
        return
    }
}
