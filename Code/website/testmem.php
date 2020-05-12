<?php
    session_start();
    include("var.php");
    $_SESSION['data'] = $data;
    setcookie('question_count', $_SESSION['question_count'], time() + (86400 * 30), "/"); // 86400 = 1 day
    if ($_SESSION["recaptcha"] == 1 && $_SESSION['question_count'] < $max_questions) {
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
    During the turning you might expect some pop-ups to check your attention. </br>
    After opening all tiles you will be able to grade the statement. </br>
    <div id="memory_board">
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
    <div class="slider_container" id="slider">
        Not at all
        <input type="range" min=<?php echo 0; ?> max=<?php echo 3; ?> value=<?php echo 1; ?> step="1" list="tickmarks" id="rangeInput" name="rangeInput" oninput="output.value = rangeInput.value">
        Certainly
        <output id="output" for="rangeInput"><?php echo 1; ?></output> <!-- Just to display selected value -->
    </div>
        <div id="complete_grid">Please finish the grid first.</div>
        <button type="submit" id="next">Ready to participate!</button>
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
<?php if ($_SESSION['question_count'] >= $max_questions) {
            ?>
You already finished this questionnaire.
<?php
        } else {?>
You need to fill in the consent form first.
<?php
} ?>
</body>
</html>
<?php
    }
?>
