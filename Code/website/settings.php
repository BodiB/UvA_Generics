<?php 
include('dropdown.php');
?>
<table width='100%' border='0'>
<tr>
<th> Setting </th>
<th> Value </th>
</tr>
  <?php 
	$query = "Select * from settings";
	$result = $link->prepare($query);
	$result->execute();
	$count = 1;
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$id = trim($row['id']);
		$min_vertical = trim($row['min_vertical']);
		$max_vertical = trim($row['max_vertical']);
		$min_horizontal = trim($row['min_horizontal']);
		$max_horizontal = trim($row['max_horizontal']);
		$min_vertical = trim($row['min_vertical']);
		$max_questions = trim($row['max_questions']);
	?>
		<tr>
			<td>Min # vertical tiles</td>
			<td> 
				<input type="number"  class='edit' id='min_vertical-<?php echo $id; ?>' value='<?php echo $min_vertical; ?>'>
			</td>
		</tr>
		<tr>
			<td>Max # vertical tiles</td>
			<td> 
				<input type="number"  class='edit' id='max_vertical-<?php echo $id; ?>' value='<?php echo $max_vertical; ?>'>
			</td>
		</tr>
		<tr>
			<td>Min # horizontal tiles</td>
			<td> 
				<input type="number"  class='edit' id='min_horizontal-<?php echo $id; ?>' value='<?php echo $min_horizontal; ?>'> 
			</td>
		</tr>
		<tr>
			<td>Max # horizontal tiles</td>
			<td> 
				<input type="number"  class='edit' id='max_horizontal-<?php echo $id; ?>' value='<?php echo $max_horizontal; ?>'>
			</td>
		</tr>
		<tr>
			<td>Max # questions</td>
			<td> 
				<input type="number" class='edit' id='max_questions-<?php echo $id; ?>' value='<?php echo $max_questions; ?>'>
			</td>
		</tr>
	<?php
		$count ++;
	}
	?> 
</table>

<script type="text/javascript">
	$(document).ready(function(){
 
	 // Add Class
	 $('.edit').click(function(){
	  $(this).addClass('editMode');
	 });

	 // Save data
	 $(".edit").focusout(function(){
	  $(this).removeClass("editMode");
	  var id = this.id;
	  var split_id = id.split("-");
	  var field_name = split_id[0];
	  var edit_id = split_id[1];
	  var value = parseInt($(this).val());

	  $.ajax({
	   url: 'update_settings.php',
	   type: 'post',
	   data: { field:field_name, value:value, id:edit_id },
	   success:function(response){
		console.log('Save successfully'); 
	   }
	  });
	 
	 });
	});
</script>