<?php
    session_start();
	include('db.php');
	if(isset($_SESSION["question_count"])){
		include('var.php');
	}
	else{
		header('location:thanks.php');
	}
	$_SESSION['admin'] = 0;
	$num_rows = 0;
	if(isset($_SESSION['ID'])){
	$selectStatement = "Select count(*)
                       FROM results
                       WHERE prolific_id = :id";
	$link = new PDO($dsn, $user, $passwd);
	$stm = $link->prepare($selectStatement);
    $stm->execute(['id' => $_SESSION['ID']]);
	$num_rows = $stm->fetchColumn();
	
	$selectAdmins = "Select admin, prolific
                       FROM user
                       WHERE prolific_id = :id";
	$link = new PDO($dsn, $user, $passwd);
	$stmAdmin = $link->prepare($selectAdmins);
    $stmAdmin->execute(['id' => $_SESSION['ID']]);
	$row = $stmAdmin->fetch(PDO::FETCH_ASSOC);
	$_SESSION['admin'] = 0;
	$_SESSION['prolific'] = $row['prolific'];
	
	if(count($_SESSION["random_order"]) != $max_questions){
		//If for some reason the number of questions changed
		// this will recalculate the random order of the feature values.
		$_SESSION["random_order"] = range(0,$max_questions);
		shuffle($_SESSION["random_order"]);
	}
	
    $_SESSION["question_count"] = $num_rows;
    $_SESSION['start'] = date("M,d,Y H:i:s");
	if($_SESSION["question_count"] >= $max_questions){
		//Already finished the questionnaire once.
		header('location:thanks.php');
	}
?>
<!DOCTYPE html>

<head>
    <link rel='stylesheet' href='css.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <script src="https://www.google.com/recaptcha/api.js?render=6LcpSOsUAAAAAKk5EE2MoABHbM75mpNUHz_dlQ3r"></script>
    <script src="captcha.js"></script>
</head>
<html>

<body>
    <h1>Questionnaire Prolific ID: <?php echo $_SESSION['ID']; ?></h1> 
	<div class="TEXT">
	<?php
		if($_SESSION['admin'] == 1){
	?>
		<button onclick="window.location.href = 'admin.php';">Admin menu</button>	
	<?php
		}
	?>
	</div>
    <div class="quiz-container">
        <div id="quiz">
        </div>
    </div>
    <button id="previous">Previous Question</button>
    <button id="next">Next Question</button>
    <form method="POST">
        <button id="submit" formaction="submit.php">Go to Questionnaire </button>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </form>
    <div id="results"></div>
    <script src="js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#000"
                },
                "button": {
                    "background": "#f1d600"
                }
            },
            "position": "bottom-right",
            "content": {
                "message": "We store cookies to ensure you get paid after completing this questionnaire."
            }
        });
    </script>
    <?php } ?>
</body>

</html>
