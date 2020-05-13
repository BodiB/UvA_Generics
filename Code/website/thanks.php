<?php
session_start();
include("var.php");
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
    <div id="memory_board">
	    Thank you for filling in this questionnaire.
		Explanation here on research
		Do you have any suggestions? (Length, questions, appearance etc.)
		Please, leave them in the text field below.
		<textarea class="suggestions" id="suggestions" rows="4" cols="50"></textarea>
    </div>
	<?php
    if ($_SESSION['question_count'] >= $max_questions) {
        if ($_SESSION['prolific'] == 1) {
            ?>
		<button id="submit" onclick="window.location.href = '#';">Button for prolific reward</button>
	<?php
        } else {
            echo "Thank you for taking your time on this questionnaire.";
        }
    } else {
        if ($_SESSION['prolific'] == 1) {
            echo "You did not participate in the questionnaire and you will therefor not receive a reward.";
        } else {
            echo "You did not participate in the questionnaire.";
        }
    }
    ?>
<script>
$(document).ready(function(){
	// Add Class
	 $('.suggestions').click(function(){
	  $(this).addClass('editMode');
	 });

	 // Save data
	 $(".suggestions").focusout(function(){
	  $(this).removeClass("editMode");
	  var id = this.id;
	  var edit_id = <?php echo $_SESSION['ID']; ?>;
	  var value = $(this).val();

	  $.ajax({
	   url: 'update_suggestion.php',
	   type: 'post',
	   data: { value:value, id:edit_id },
	   success:function(response){
		console.log('Save successfully');
	   }
	  });

	 });
	});
</script>
</body>
</html>
