<?php
    session_start();
    include("var.php");
	$_SESSION['data'] = $data;
    if ($_SESSION["recaptcha"] == 1) {
        $question = ""
        // Store all grid variables here.
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css.css'>
<script src="mem.js"></script>
</head>
<body>
    <h1>Questionnaire Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
    <div class="quiz">
        <?php echo $allQuestions[0]; ?>
    </div>
    <div id="memory_board">
        <div id="memory_board_left">
        </div>
        <div id="memory_board_right">
        </div>
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
    <div class="slider_container" id="slider">
        Not at all
        <input type="range" min="0" max="5" value="3" step="1" list="tickmarks" id="rangeInput" oninput="output.value = rangeInput.value; changeFunction(rangeInput.value)">
        Certainly
        <output id="output" for="rangeInput">3</output> <!-- Just to display selected value -->
    </div>
	<form method="post" action="store.php">
		<input type="hidden" name="v_t" id="v_t" value="">
		<input type="hidden" name="h_t" id="h_t" value="">
		<input type="hidden" name="t_A_l" id="t_A_l" value="">
		<input type="hidden" name="t_B_l" id="t_B_l" value="">
		<input type="hidden" name="t_B_r" id="t_B_r" value="">
		<input type="hidden" name="rating" id="rating" value="3">
    <?php if ($_SESSION["question_count"] < 4) { ?>
            <input type="hidden" name="type" id="type" value="next">
            <button type="submit" id="next" onclick="return checkValue(output.value)">Next Question</button>
        <script>
            const submitButton = document.getElementById('next');
            submitButton.style.display = 'none';
        </script>
    <?php } else {?>
            <input type="hidden" name="type" id="type" value="submit">
            <button type="submit" id="submit" onclick="return checkValue(output.value)">Submit questionnaire</button>
        <script>
            const submitButton = document.getElementById('submit');
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
You need to fill in the consent form first.
</body>
</html>
<?php
    }
?>
