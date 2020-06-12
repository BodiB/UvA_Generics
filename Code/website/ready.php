<?php
session_start();
if (isset($_SESSION["question_count"])) {
    include('var.php');
}
?>
<!DOCTYPE html>
<html>

    <head>
        <link rel='stylesheet' href='css.css'>
        <script src="mem.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>

    <body>
        <h1>Questionnaire Introduction </br> Prolific ID:
            <?php echo $_SESSION['ID']; ?>
        </h1>
        <div id="myText">
            Thank you! We are now ready to start playing for real.
            Please maximize this page on your browser so that it is in full screen and make sure that you can, as much as possible, do the rest of the study in a calm environment without distractions or interruptions.

            When you are ready, click on the button below:

            <form method="post" action="mem.php">
                <button id="submit" style="margin:0 auto; display:block;" formaction="mem.php">Start the game.</button>
            </form>
    </body>

</html>
