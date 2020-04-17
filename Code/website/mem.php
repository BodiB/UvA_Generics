<!DOCTYPE html>
<html>
<head>
<style>
div#memory_board{
    width:800px;
    height:540px;
    padding:24px;
    margin:0px auto;
}
div#memory_board_left{
    background:#CCC;
    float: left;
    border:#999 1px solid;
    width:380px;
    height:540px;
    padding:9px;
    margin:0px auto;
}
div#memory_board_right{
    background:#CCC;
    border:#999 1px solid;
    float: right;
    width:380px;
    height:540px;
    padding:9px;
    margin:0px auto;
}
div.tile{
    background-color: white;
    border:#000 1px solid;
    float:left;
    font-size:64px;
    cursor:pointer;
    text-align:center;
    margin: 1px;
}

</style>
<script>
Array.prototype.memory_tile_shuffle = function(){
    var i = this.length, j, temp;
    while(--i > 0){
        j = Math.floor(Math.random() * (i+1));
        temp = this[j];
        this[j] = this[i];
        this[i] = temp;
    }
}

function newBoard(board, list, v_t, h_t, p_A, p_B, flip){
    var h_size = (document.getElementById("memory_board_right").clientWidth-18)/h_t;
    h_size = h_size-4
    var size = v_t*h_t;
    var t_A = Math.floor(size*p_A/100);
    var t_B = Math.floor(size*p_B/100);
    var array = [];
    var i=0;
    while(i < t_A){
      array.push(''+list[1]+'');
      i++;
    }
    i=0;
    while(i < t_B){
      array.push(''+list[2]+'');
      i++;
    }
    i=0;
    while(i < size-t_A-t_B){
      array.push('https://mycologic-cement.000webhostapp.com/img/UVA-logo.png');
      i++;
    }
    var output = '';
    array.memory_tile_shuffle();
    for(var i = 0; i < array.length; i++){
        if (flip){
            output += '<div class="tile", id="tile_'+i+'", onclick="memoryFlipTile(this,\''+array[i]+'\')" style="width:'+h_size+'px;height:'+h_size+'px;background-size: '+h_size+'px '+h_size+'px;"></div>';
        }else{
            output += '<div class="tile", id="tile_'+i+'", data-value="'+array[i]+'" style="width:'+h_size+'px;height:'+h_size+'px;background-size: '+h_size+'px '+h_size+'px;"></div>';
        }
    }
    if((v_t*h_size)>540){
        document.getElementById(board).style.height = ''+(v_t*h_size+4*v_t)+'px';
        document.getElementById("memory_board").style.height = ''+(v_t*h_size+4*v_t)+'px';
    }
    // document.getElementById(board).innerHTML = output;
    document.getElementById(board).innerHTML = output;
}

function getRandomNode(){
    var nodes = document.getElementsByClassName("tile");
    var randomNode = nodes[Math.floor(Math.random() * (nodes.length - (nodes.length/2)) + (nodes.length/2))];
    if(randomNode.innerHTML == ""){
        return randomNode;
    }
    else{
        return getRandomNode()
    }
}

function memoryFlipTile(tile,val){
    if(tile.innerHTML == ""){
        tile.style.background = '#FFF';
        tile.innerHTML = '<img src="'+ val +'" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
        var myNode = getRandomNode();
        var myVal = myNode.getAttribute("data-value");
        myNode.style.background = '#FFF';
        myNode.innerHTML = '<img src="'+ myVal +'" width="' + tile.offsetWidth + 'height=' + tile.offsetWidth + '"/>';
    }
}

function createBoard(){
    var v_t = 5; // Vertical number of tiles
    var h_t = 3; // Horizontal number of tiles
    var p_A = 50; // Percentage of occurence of A (floored) 12*30/100 = 3,6
    var p_B = 30; // Percentage of occurence of B (floored)
    var list = [["Beetle Question?", "https://mycologic-cement.000webhostapp.com/img/bettle_A.PNG", "https://mycologic-cement.000webhostapp.com/img/bettle_C.PNG"]]
    newBoard('memory_board_left', list[0], v_t, h_t, p_A, p_B, true);
    newBoard('memory_board_right',  list[0], v_t, h_t, p_A, p_B, false);
}
</script>
</head>
<body>
<div id="memory_board">
    <div id="memory_board_left">
    </div>
    <div id="memory_board_right">
    </div>
</div>
<!-- <div class="tile" style="display:none"> </div> -->
<script>createBoard()</script>
</body>
</html>
