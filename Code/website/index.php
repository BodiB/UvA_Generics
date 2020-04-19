<?php
    session_start();
    $_SESSION["question_count"] = 0;
    $_SESSION['start'] = date("M,d,Y H:i:s");
    setcookie('question_count', $_SESSION['question_count'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('start', $_SESSION['start'], time() + (86400 * 30), "/"); // 86400 = 1 day
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
    <?php if(isset($_SESSION['ID']) || isset($_COOKIE['ID'])){
        if(!isset($_SESSION['ID'])){$_SESSION['ID'] = $_COOKIE['ID'];}
        ?>
	<h1>Questionnaire Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
	<div class="quiz-container">
		<div id="quiz">
		</div>
	</div>
	<button id="previous">Previous Question</button>
	<button id="next">Next Question</button>
    <form method="POST">
    	<button id="submit" formaction="/submit.php">Start Questionnaire </button>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </form>
	<div id="results"></div>
	<script src="js.js"></script>
	<!-- <script>
		$('input').on('change', function() {
			alert($(this).val());
		})

	</script> -->
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
<?php } else { ?>
    <h1>We dit not receive your Prolific ID</h1>
    <!-- TODO REMOVE AFTER TESTING. -->
    <form action="/prolific.php" method="get">
        <label for="PROLIFIC_PID">Fill in your PROLIFIC_PID:</label>
        <input type="text" id="PROLIFIC_PID" name="PROLIFIC_PID"><br><br>
        <input type="submit" value="Submit">
    </form>


    <?php } ?>
</body>

</html>
