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
	var range = "<?php echo 200/($data['scale_max']-$data['scale_min']); ?>";
	$(document).ready(function(){
		$("input[type='range']").css({"background": "-webkit-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent "+ range +"px) no-repeat 50% 50%",
  "background": "-moz-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent "+ range +"px) no-repeat 50% 50%",
  "background": "repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent "+ range +"px) no-repeat 50% 50%"});
	});
</script>
</head>
<body>
    <h1>Questionnaire Prolific ID: <?php echo $_SESSION['ID'];?></h1>
	<div id="myProgress">
		<?php $progress = ($_SESSION["question_count"]/$max_questions)*100; ?>
		<div id="myBar" style="width: <?php echo $progress;?>%"><?php echo $progress;?>%</div>
	</div>
	<div id="snackbar">Please, wait for the computer to finish it's turn.</div>
    <div id="memory_board">
	<div id="turn" width="100%">Your turn!</div>
        <div id="memory_board_left">
        </div>
        <div id="memory_board_right">
        </div>
    </div>
	<div class="quiz">
        <?php echo $allQuestions[0]; ?>
    </div>
    <p id="TEXT"></p>
    <script>
        var list = <?php echo json_encode($data['allQuestions']); ?>;
        var v_t = <?php echo $data['v_t']; ?>; // Vertical number of tiles
        var h_t = <?php echo $data['h_t']; ?>; // Horizontal number of tiles
        var t_A_l = <?php echo $data['t_A_l']; ?>; // Percentage of occurence of A left (floored)
        var t_B_l = <?php echo $data['t_B_l']; ?>; // Percentage of occurence of B left (floored)
        var t_A_r = <?php echo $data['t_A_r']; ?>; // Percentage of occurence of A right (floored)
        var t_B_r = <?php echo $data['t_B_r']; ?>; // Percentage of occurence of B right (floored)
        createBoard(list, v_t, h_t, t_A_l, t_B_l, t_A_r, t_B_r);
    </script>
	<form method="post" action="store.php">
		<input type="hidden" name="v_t" id="v_t" value="">
		<input type="hidden" name="h_t" id="h_t" value="">
		<input type="hidden" name="t_A_l" id="t_A_l" value="">
		<input type="hidden" name="t_B_l" id="t_B_l" value="">
		<input type="hidden" name="t_B_r" id="t_B_r" value="">
		<div id="complete_grid">Please finish the grid first.</div>
    <?php if ($_SESSION["question_count"] < $max_questions-1) { ?>
            <input type="hidden" name="type" id="type" value="next">
			<div id="next" style="width:100%; margin:0 auto;">
				<?php include("rate_buttons.php");?>
			</div>
        <script>
            const submitButton = document.getElementById('next');
			const completeGrid = document.getElementById('complete_grid');
            submitButton.style.display = 'none';
        </script>
    <?php } else {?>
            <input type="hidden" name="type" id="type" value="submit">
			<div id="submit" style="width:100%; margin:0 auto;">
				<?php include("rate_buttons.php");?>
			</div>
        <script>
            const submitButton = document.getElementById('submit');
			const completeGrid = document.getElementById('complete_grid');
            submitButton.style.display = 'none';
        </script>
        <?php } ?>
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
