<?php
    session_start();
	$_SERVER["HTTPS"] = "on";
	
    //Initialise settings that have been defined in setting up the experiment.
    include('init.php');

    require_once 'Mobile_Detect.php';
    $detect = new Mobile_Detect;

    // Any mobile device (phones or tablets).
    if ($detect->isMobile() and !$detect->isTablet()) {
        include('mobile_device.php');
    } else {
        if (isset($_SESSION["question_count"])) {
            include('db.php');
            // var.php needs a question count to be able to determine the question to load.
            include('var.php');
        } else {
            header('location:thanks.php');
        }
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = 0;
        }
        $num_rows = 0;
        if (isset($_SESSION['ID'])) {
            //Count the number of answers the current users has already given.
            //(To prevent multiple participations and be able to continue after stopping during the experiment.)
            require_once('count_answers.php');

            // Checks if the current user joined through prolific.
            require_once('get_prolific.php');

            if (count($_SESSION["random_order"]) != $max_questions) {
                //If for some reason the number of questions changed
                // this will recalculate the random order of the feature values.
                $_SESSION["random_order"] = range(1, $max_questions);
                shuffle($_SESSION["random_order"]);
            }
            if (count($_SESSION["random_order_statement"]) < $max_questions) {
                //Preset the random order of the statements
                $_SESSION["random_order_statement"] = range(1, $max_questions);
                shuffle($_SESSION["random_order_statement"]);
                array_unshift($_SESSION["random_order_statement"], 0);
            }

            $_SESSION["question_count"] = $num_rows;
            $_SESSION['start'] = date("M,d,Y H:i:s");
            if ($_SESSION["question_count"] >= $max_questions) {
                //User has already finished the questionnaire.
?>

<head>
	<noscript>
	   This page needs JavaScript activated to work. 
	   <style>div { display:none; }</style>
    </noscript>
    <meta http-equiv="refresh" content="0;URL=thanks.php">
</head>
<?php
            } ?>
<!DOCTYPE html>

<head>
	<noscript>
		This page needs JavaScript activated to work. 
		<style>div { display:none; }</style>
	</noscript>
    <link rel='stylesheet' href='css.css'>
    <?php
    if ($_SESSION["recaptcha"] == 0) {
        // Recaptcha demanded, load recaptcha script source.
        echo '<script src="https://www.google.com/recaptcha/api.js?render=6LcpSOsUAAAAAKk5EE2MoABHbM75mpNUHz_dlQ3r"></script>';
        echo '<script src="captcha.js">var public_key = "'. $public_key .'";</script>';
    } ?>
</head>
<html>

    <body>
        <h1>Questionnaire </br> Prolific ID:
            <?php echo $_SESSION['ID']; ?>
        </h1>
        <div class="TEXT">
            <?php
        if ($_SESSION['admin'] == 1) {
            ?>
            <button onclick="window.location.href = 'admin.php';">Admin menu</button>
            <?php
        } ?>
        </div>
        <div class="quiz-container">
            <div id="slides">
            </div>
        </div>
        <button id="previous">Previous Question</button>
        <button id="next">Next Question</button>
        <form method="POST">
            <button id="submit" formaction="submit.php">Go to Questionnaire </button>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        </form>
        <div id="results"></div>
        <script src="js.js"></script>
        <?php
        } ?>
    </body>

</html>
<?php
    } ?>
