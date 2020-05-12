<?php
session_start();
include("var.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css.css'>
<script src="mem.js"></script>
</head>
<body>
    <h1>Thank you!</h1>
    <div id="memory_board">
        Thank you for filling in this questionnaire.
        Explanation here on research
    </div>
    <?php
    if ($_SESSION['question_count'] >= $max_questions) {
        ?>
        <button onclick="window.location.href = '#';">Button for prolific reward</button>
    <?php
    } else {
        echo "You did not participate in the questionnaire and you will therefor not receive a reward.";
    }
    ?>
</body>
</html>
