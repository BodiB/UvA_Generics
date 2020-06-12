<?php
session_start();
if(isset($_SESSION["question_count"])){
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
<h1>Questionnaire Introduction </br> Prolific ID: <?php echo $_SESSION['ID']; ?></h1>
<div id="myText">
In this study, you will learn about the animals that live on two Galapagos islands called the Marchena island and the Genovesa island. Because of the geography of the Galapagos, there are small genetic variations between the animals of the same species that live on the two islands. In particular, they often show differences in colouring. Here is the map of the islands:</br>
</br>
<figure style="display: block; margin-left:auto; margin-right:auto; width:50%; text-align:center;">
  <img src="img/map.png" style="display: block; margin-left:auto; margin-right:auto; width:100%;">
</figure>

</br>
We have collected data about these animals which you can explore through a game we would like you to play.</br>
</div>
<form method="post" action="testmem.php" id="form1">
	<button type="submit" form="form1" value="I'm ready to try it out." style="margin-left:auto; margin-right:auto; text-align:center;"> I'm ready to try it out.</button>
</form>
</body>
</html>
