<?php
    session_start();
    include("var.php");
    if ($_SESSION["recaptcha"] == 1){
        $question = ""
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css.css'>
<script src="mem.js"></script>
<!-- <script src="js.js"></script> -->
</head>
<body>
    <h1>Questionnaire Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
    <div class="quiz">
        <?php echo $allQuestions[0][0]; ?>
	</div>
    <div id="memory_board">
        <div id="memory_board_left">
        </div>
        <div id="memory_board_right">
        </div>
    </div>
    <p id="TEXT"></p>
    <script>
        var list = <?php echo json_encode($allQuestions); ?>;
        var v_t = 5; // Vertical number of tiles
        var h_t = 3; // Horizontal number of tiles
        var p_A_l = 40; // Percentage of occurence of A left (floored)
        var p_B_l = 30; // Percentage of occurence of B left (floored)
        var p_A_r = 50; // Percentage of occurence of A right (floored)
        var p_B_r = 50; // Percentage of occurence of B right (floored)
        createBoard(list[0], v_t, h_t, p_A_l, p_B_l, p_A_r, p_B_r);
    </script>
    <div class="slider_container" id="slider">
        Not at all
        <input type="range" min="0" max="5" value="3" step="1" list="tickmarks" id="rangeInput" oninput="output.value = rangeInput.value">
        Certainly
        <output id="output" for="rangeInput">3</output> <!-- Just to display selected value -->
    </div>
    <?php if ($_SESSION["question_count"] < 4){ ?>
        <button id="next" onclick="checkValue(output.value)">Next Question</button>
        <script>
            const submitButton = document.getElementById('next');
            submitButton.style.display = 'none';
        </script>
    <?php }else{?>
        <button id="submit">Submit questionnaire</button>
        <script>
            const submitButton = document.getElementById('submit');
            submitButton.style.display = 'none';
        </script>
        <?php } ?>
    <script>
        submitButton.style.display = 'none';
    </script>
</body>
</html>
<?php
} else{
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
