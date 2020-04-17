<?php
    session_start();
?>
<!DOCTYPE html>

<head>
	<link rel='stylesheet' href='css.css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
</head>
<html>

<body>
    <?php if(isset($_SESSION['ID']) || isset($_COOKIE['ID'])){ ?>
	<h1>Questionnaire Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
	<div class="quiz-container">
		<div id="quiz">
		</div>
	</div>
	<div class="slider_container" id="slider">
		<input type="range" min="0" max="5" value="3" step="1" list="tickmarks" id="rangeInput" oninput="output.value = rangeInput.value">
		<datalist id="tickmarks">
			<option>0</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</datalist>
		<output id="output" for="rangeInput">3</output> <!-- Just to display selected value -->
	</div>
	<button id="previous">Previous Question</button>
	<button id="next">Next Question</button>
	<button id="submit">Start Questionnaire </button>
	<div id="results"></div>
	<script src="js.js"></script>
	<script>
		$('input').on('change', function() {
			alert($(this).val());
		})

	</script>
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
    <form action="/prolific.php" method="get">
        <label for="PROLIFIC_PID">Fill in your PROLIFIC_PID:</label>
        <input type="text" id="PROLIFIC_PID" name="PROLIFIC_PID"><br><br>
        <input type="submit" value="Submit">
    </form>


    <?php } ?>
</body>

</html>
