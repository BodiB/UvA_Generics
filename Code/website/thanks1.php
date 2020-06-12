<?php
session_start();
if (isset($_SESSION["question_count"])) {
    include('var.php');
}
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    $_SESSION["question_count"] = 100;
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
        <h1>Thank you!</h1>
        <div id="memory_board" style="text-align:left;">
            <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            echo "<H1>You are logged in as an admin, therefore you only have to finish 1 question instead of ".$max_questions."</H1>";
        }
        if ((isset($_SESSION['question_count']) && $_SESSION['question_count'] >= $max_questions)||(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
            ?>
            Thank you for filling in this questionnaire.</br>
            Do you have any suggestions? (Length, questions, appearance, correctness, lay-out etc.)</br>
            Please, leave them in the text field below.</br>
            <textarea class="suggestions" id="suggestions" rows="4" cols="50"></textarea>
            </br>
            <button onclick="submittedText()">Submit suggestions.</button>
            <p id="submitted"></p>
            <script>
                function submittedText() {
			  document.getElementById("submitted").innerHTML = "Stored your feedback.";
			}
		</script>

            <form method="post" action="debrief.php" id="form1">
                <button type="submit" form="form1" style="margin:auto; display:block;">>></button>
            </form>
            </br>
            <?php
        } else {
            if (isset($_SESSION['prolific']) && $_SESSION['prolific'] == 1) {
                echo "You did not participate in the questionnaire and you will therefor not receive a reward. </br> This study is a psychological study aimed at understanding human cognition and behavior. Psychological research depends on participants. Their responses to surveys like this one are an incredibly valuable source of data for researchers. It is therefore crucial for research that participants pay attention, avoid distractions, and take all study tasks seriously (even when they might seem silly).</br></br>";
            } else {
                echo "You did not participate in the questionnaire. </br> This study is a psychological study aimed at understanding human cognition and behavior. Psychological research depends on participants. Their responses to surveys like this one are an incredibly valuable source of data for researchers. It is therefore crucial for research that participants pay attention, avoid distractions, and take all study tasks seriously (even when they might seem silly).</br></br>";
            }
        }
            ?>
            <script>
                $(document).ready(function() {
                    // Add Class
                    $('.suggestions').click(function() {
                        $(this).addClass('editMode');
                    });

                    // Save data
                    $(".suggestions").focusout(function() {
                        $(this).removeClass("editMode");
                        var id = this.id;
                        var edit_id = <?php echo $_SESSION['ID']; ?>;
                        var value = $(this).val();

                        $.ajax({
                            url: 'update_suggestion.php',
                            type: 'post',
                            data: {
                                value: value,
                                id: edit_id
                            },
                            success: function(response) {
                                console.log('Save successfully');
                            }
                        });

                    });
                });
            </script>
        </div>
        </div>
    </body>

</html>
