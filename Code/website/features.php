<?php 
include('dropdown.php');
if(isset($_SESSION["question_count"])){
	include('var.php');
}
else{
	header('location:thanks.php');
}
?>
</br> The features below will be used in order up to the max number of questions (<?php echo $max_questions;?>) set on the settings page. 
</br> This means you need to define at least <?php echo $max_questions;?> features below.
<table width='100%' border='0'>
<tr>
<th> ID </th>
<th> Left feature </th>
<th> Right feature </th>
</tr>
  <?php 
	$query = "Select * from features";
	$result = $link->prepare($query);
	$result->execute();
	$count = 1;
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$id = trim($row['id']);
		$percentage_A_left = trim($row['percentage_A_left']);
		$percentage_B_left = trim($row['percentage_B_left']);
		$percentage_A_right = trim($row['percentage_A_right']);
		$percentage_B_right = trim($row['percentage_B_right']);
	?>	
	<tr>
		<td> 
		<?php echo $id; ?>
		</td>
		<td> 
			A:
			<input type="number" min="0" max="100" class='num_edit' id='percentage_A_left-<?php echo $id; ?>' value='<?php echo $percentage_A_left; ?>'>
			B:
			<input type="number" min="0" max="100" class='num_edit' id='percentage_B_left-<?php echo $id; ?>' value='<?php echo $percentage_B_left; ?>'>
		</td>
		<td> 
			A:
			<input type="number" min="0" max="100" class='num_edit' id='percentage_A_right-<?php echo $id; ?>' value='<?php echo $percentage_A_right; ?>'> 
			B:
			<input type="number" min="0" max="100" class='num_edit' id='percentage_B_right-<?php echo $id; ?>' value='<?php echo $percentage_B_right; ?>'>
		</td>
	</tr>
	<?php
		$count ++;
	}
	?> 
	<tr>
		<td colspan="2">
		</td>
		<td>
			<button onclick="window.location.href = 'add_feature.php';">Add new feature</button>	
		</td>
	</tr>
</table>
<div id="snackbar">One side's percentage A+B can not be higher than 100%</div>

<script type="text/javascript" src="features.js"></script>