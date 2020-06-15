<?php
    session_start();
    include('db.php');
    $data = $_SESSION['data'];
    include('count_answers.php');
    if (isset($_SESSION["question_count"])) {
        include('var.php');
    } else {
        header('location:thanks.php');
    }
    $_SESSION['data'] = $data;
    if (isset($_SESSION["recaptcha"]) && $_SESSION["recaptcha"] == 1 && $_SESSION['question_count'] <= $max_questions) {
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
        <h1 style="margin-bottom:0px">Questionnaire </br> Prolific ID:
            <?php echo $_SESSION['ID']; ?>
        </h1>
        <div id="myProgress">
            <?php $progress = (($_SESSION["question_count"]-1)/$max_questions)*100; ?>
            <div id="myBar" style="width: <?php echo $progress; ?>%">
                <?php echo $progress; ?>%</div>
        </div>
        </br>
        <div id="snackbar">Please, wait for your turn</div>
        Here is a new type of animal from the Genovesa and Marchena islands we would like you to learn about:
        <div id="memory_board">
            <div id="turn" width="100%"><B>It's your turn to play.</B></div>
            </br>
            <div id="memory_board_left">
            </div>
            <div id="memory_board_right">
            </div>
        </div>
        <div id="complete_grid">Please finish playing the game</div>
        <div class="quiz" id="statement">
            <?php echo "<B>".$allQuestions[0]."</B>"; //Print the statement?>
        </div>
        <script>
            const statement = document.getElementById('statement');
	statement.style.display = 'none';
	</script>
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
            <?php if ($_SESSION["question_count"] <= $max_questions-1) { ?>
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
        <?php if ($_SESSION['question_count'] > $max_questions) {
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
