<?php // Check if not a robot and if agreed:
    session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LcpSOsUAAAAAF-M4vS5xXpsTjbxmFspYoSNBj_h';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    if ($recaptcha->score >= 0.5 || $_SESSION["recaptcha"] == 1) {
        // Verified
        $_SESSION["recaptcha"] = 1;
        ?>
        <!DOCTYPE html>

        <head>
            <meta http-equiv="refresh" content="0;URL=introduction.php">
        </head>
        <html>

        <body>

        </body>

        </html>

        <?php
    } else {
        // Not verified - show form error
        $_SESSION["recaptcha"] = 0;
        echo("The recaptcha failed to verify you. Please go back to the previous page.");
    }

} ?>
