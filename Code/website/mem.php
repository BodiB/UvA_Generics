<?php
    session_start();
    include("var.php");
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
        var list = <?php echo json_encode($allQuestions); ?>;
        var v_t = <?php echo $v_t; ?>; // Vertical number of tiles
        var h_t = <?php echo $h_t; ?>; // Horizontal number of tiles
        var p_A_l = <?php echo $p_A_l; ?>; // Percentage of occurence of A left (floored)
        var p_B_l = <?php echo $p_B_l; ?>; // Percentage of occurence of B left (floored)
        var p_A_r = <?php echo $p_A_r; ?>; // Percentage of occurence of A right (floored)
        var p_B_r = <?php echo $p_B_r; ?>; // Percentage of occurence of B right (floored)
        createBoard(list, v_t, h_t, p_A_l, p_B_l, p_A_r, p_B_r);
    </script>
    <div class="slider_container" id="slider">
        Not at all
        <input type="range" min="0" max="5" value="3" step="1" list="tickmarks" id="rangeInput" oninput="output.value = rangeInput.value">
        Certainly
        <output id="output" for="rangeInput">3</output> <!-- Just to display selected value -->
    </div>
    <?php if ($_SESSION["question_count"] < 4) { ?>
        <form method="post" action="store.php">
            <input type="hidden" name="type" id="type" value="next">
            <button type="submit" onclick="checkValue(output.value)" id="next">Next Question</button>
        </form>
        <script>
            const submitButton = document.getElementById('next');
            submitButton.style.display = 'none';
        </script>
    <?php } else {?>
        <form method="post" action="store.php">
            <input type="hidden" name="type" id="type" value="submit">
            <button type="submit" id="submit" onclick="checkValue(output.value)">Submit questionnaire</button>
        </form>
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
