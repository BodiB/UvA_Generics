<?php
    session_start();
    if(isset($_SESSION["question_count"])){
		include('var.php');
	}
	else{
		header('location:thanks.php');
	}
	$_SESSION['data'] = $data;
    if (isset($_SESSION["recaptcha"]) && $_SESSION["recaptcha"] == 1 && $_SESSION['question_count'] < $max_questions) {
        $question = ""
        // Store all grid variables here.
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css.css'>
<script src="mem.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script> 
	var range = "<?php echo 200/(3-0); ?>";
	$(document).ready(function(){
		$("input[type='range']").css({"background": "-webkit-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent "+ range +"px) no-repeat 50% 50%",
  "background": "-moz-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent "+ range +"px) no-repeat 50% 50%",
  "background": "repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent "+ range +"px) no-repeat 50% 50%"});
	});
</script>
</head>
<body>
    <h1>Questionnaire Introduction Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
	Hi and thank you for taking your time for this questionnaire. </br>
	The questionnaire consists of <?php echo $max_questions; ?> questions. </br>
	We will show you a grid together with a statement.</br>
	You (left side of the grid) will play against a computer opponent (right side of the grid).</br>
	The both of you will be able to open one tile at a time.</br>
	The goal is to match the tile of your opponent. </br> 
	You can encounter 3 types of tiles. 2 of which have a figure and distinct features and the 3rd kind is an empty tile.</br> 
	During the turning you might get some pop-ups to check your attention. </br>
	After you completed the grid buttons will appear to allow you to rate the correctness of the statement.</br>
	You can use the grid below to get to know the lay-out of the questionnaire.</br>
	<div id="snackbar">Please, wait for the computer to finish it's turn.</div>
    <div id="memory_board">
	<div id="turn" width="100%">Your turn!</div>
        <div id="memory_board_left">
        </div>
        <div id="memory_board_right">
        </div>
    </div>
	<div class="quiz">
        Statement to answer
    </div>
    <p id="TEXT"></p>
    <script>
        var list = ["Statement to answer", "Your side", "Computer's side", "img/hedge_A.PNG", "img/hedge_C.PNG", "0", "3"];
        var v_t = 2; // Vertical number of tiles
        var h_t = 2; // Horizontal number of tiles
        var t_A_l = 1; // Tiles with occurence of A left (floored)
        var t_B_l = 1; // Tiles with occurence of B left (floored)
        var t_A_r = 1; // Tiles with occurence of A right (floored)
        var t_B_r = 2; // Tiles with occurence of B right (floored)
        createBoard(list, v_t, h_t, t_A_l, t_B_l, t_A_r, t_B_r);
    </script>
	<form method="post" action="mem.php">
		<div id="complete_grid">Please finish the grid first.</div>
		<div id="next" style="width:100%; margin:0 auto;">
			<?php include("rate_buttons.php");?>
		</div>
        <script>
            const submitButton = document.getElementById('next');
			const completeGrid = document.getElementById('complete_grid');
            submitButton.style.display = 'none';
        </script>
 	</form>
    <script>
        submitButton.style.display = 'none';
    </script>
</body>
</html>
<?php
    } else {
        ?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css.css'>
</head>
<body>
<?php if($_SESSION['question_count'] >= $max_questions){
?>
You already finished this questionnaire.
<?php 
} else {?>
You need to fill in the consent form first.
<?php 
}?>
</body>
</html>
<?php
    }
?>
