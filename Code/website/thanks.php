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
            <div id="rate_first">
                Finally, please be honest when answering the following question. </br>
                <B>Your answer will not affect your payment or eligibility for future studies.</B></br></br>
                The study you have just participated in is a psychological study aimed at understanding human cognition and behavior. Psychological research depends on participants like you. Your responses to surveys like this one are an incredibly
                valuable source of data for researchers. It is therefore crucial for research that participants pay attention, avoid distractions, and take all study tasks seriously (even when they might seem silly).</br></br>
                <B>Do you feel that you paid attention, avoided distractions, and took this survey seriously?</B></br>
                <input type="radio" class="rate" id="rate" name="rating" value="No, I was distracted." />
                <label for="">No, I was distracted</label>
                </br>
                <input type="radio" class="rate" id="rate" name="rating" value="No, I had trouble paying attention." />
                <label for="">No, I had trouble paying attention.</label>
                </br>
                <input type="radio" class="rate" id="rate" name="rating" value="No, I did not take this survey seriously." />
                <label for="">No, I did not take this survey seriously.</label>
                </br>
                <input type="radio" class="rate" id="rate" name="rating" value="No, something else affected my participation negatively." />
                <label for="">No, something else affected my participation negatively.</label>
                </br>
                <input type="radio" class="rate" id="rate" name="rating" value="Yes." />
                <label for="">Yes.</label>
                </br>
                <script>
                $(document).ready(function(){
				$("p").hide();		
                // Add Class
                 $('.rate').click(function(){
                  var edit_id = "<?php echo $_SESSION['ID']; ?>";
                  var value = $(this).val();

                  $.ajax({
                   url: 'update_serious.php',
                   type: 'post',
                   data: { value:value, id:edit_id },
                   success:function(response){
                    console.log('Saved successfully.');
					$("p").show();
                   }
                  });
                 });
                });
            </script>
            </div>
			<p>Thank you for helping us by being honest on the above question.</p>
            <form method="post" action="thanks1.php" id="form1">
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
        </div>
        </div>
    </body>

</html>
