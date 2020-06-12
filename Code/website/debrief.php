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
        <h1>Background information on this study</h1>
        <div id="myText">
            Thank you again for taking part in this study! If you are interested, you will find some information about the research we are conducting below. <B>When you are done, please click on the button at the bottom of the page to complete your
                participation.</B> </br>
            </br>
            People often use sentences such as “Birds fly” to describe things they have learned about the world.
            We are investigating the conditions that make these statements true and the way people come to believe them.
            In particular, we are studying the hypothesis that we learn those statements by comparing the group we want to describe with a relevant contrasting group: “Birds fly” is true because more species of birds fly compared to other animals.
            In this study, we gave you information about the species in a sequential fashion in order to mimic how people discover information progressively when exploring the world, and we also varied the strength of the contrast (i.e. the species
            from the Marchena islands). </br>
            </br>
            For more information, see: </br>
            van Rooij, R., & Schulz, K. (2019). Generics and typicality: a bounded rationality approach. <I>Linguistics and Philosophy</I>. </br>
            Kochari, A., Rooij, R., & Schulz, K. (2020). Generics and Alternatives. <I>Frontiers in Psychology</I>.
            </br></br>
            <?php
if ((isset($_SESSION['prolific']) && $_SESSION['prolific'] == 1 && $_SESSION["question_count"] >= $max_questions) ||(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
    ?>
            <button id="submit" class="submit" onclick="window.location.href = 'reward_participant.php';" style="margin:auto; display:block;">Complete survey participation</button>
            <?php
} else {
        echo "Thank you for voluntarily taking your time on this questionnaire.";
    }
?>
    </body>

</html>
