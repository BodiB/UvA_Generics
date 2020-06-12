<?php
    session_start();
    if (isset($_SESSION["question_count"])) {
        $_SESSION["question_count"] = 0;
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
        <script>
            var range = "<?php echo 200/(3-0); ?>";
            $(document).ready(function() {
                $("input[type='range']").css({
                    "background": "-webkit-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent " + range + "px) no-repeat 50% 50%",
                    "background": "-moz-repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent " + range + "px) no-repeat 50% 50%",
                    "background": "repeating-linear-gradient(90deg, #777, #777 1px, transparent 1px, transparent " + range + "px) no-repeat 50% 50%"
                });
            });
        </script>
    </head>

    <body>
        <h1>Questionnaire Introduction </br> Prolific ID:
            <?php echo $_SESSION['ID']; ?>
        </h1>
        <div id="myText">
            In this game, you will be a representative of the Genovesa island and your opponent will be playing as a representative from the Marchena island.
            Here is how the game works:
            <ul>
                <li>When it is your turn to play, you can uncover a piece of data about an animal on the Genovesa island by clicking on a tile.</li>
                <li>Then, the other player will uncover a piece of data about an animal on the Marchena island. If the two pieces look identical, you will win a point. Otherwise, no one wins a point. </li>
                <li>Then, it is your opponent’s turn to play: they will first uncover a piece of data about the Marchena island, and then you can uncover a piece of data about the Genovesa island. If the two pieces look identical, then your opponent
                    wins a point. Otherwise, no one wins a point. </li>
            </ul>
            The game ends when you have uncovered all the data that is available. </br>
            After each game, we will also ask you about what you learned about the animal.</br>
            </br>
            In this study, we would like you to learn about
            <?php echo $max_questions; ?> different species that live on the Marchena and Genovesa islands, so you will be asked to play the game
            <?php echo $max_questions; ?> times. </br>
            </br>
            Let’s start with a practice round:
        </div>
        <div id="snackbar">Please, wait for your turn.</div>
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
            var v_t = 2; // Vertical number of tiles
            var h_t = 2; // Horizontal number of tiles
            var t_A_l = 2; // Tiles with occurence of A left (floored)
            var t_B_l = 2; // Tiles with occurence of B left (floored)
            var t_A_r = 2; // Tiles with occurence of A right (floored)
            var t_B_r = 2; // Tiles with occurence of B right (floored)
            createBoard(list, v_t, h_t, t_A_l, t_B_l, t_A_r, t_B_r);
        </script>
        <form method="post" action="ready.php">
            <div id="next" style="width:100%; margin:0 auto;">
                <?php include("rate_buttons.php"); ?>
            </div>
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
