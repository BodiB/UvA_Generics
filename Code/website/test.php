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
</head>
<body>
    <h1>Questionnaire Introduction </br> Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
	<p></p>
	<div id="next" style="width:100%; margin:0 auto;">
		<?php 
		$data['scale_min'] = 0;
		$data['scale_max'] = 8;
		include("rate_buttons.php");?>
	</div>
	
</body>
</html>
	<?php } ?>