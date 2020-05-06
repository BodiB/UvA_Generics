<?php 
include('dropdown.php');
?>
<table width='100%' border='0'>
	<tr>
		<th>Q.no</th>
		<th>Question</th>
		<th>Feature A name</th>
		<th>Feature A image</th>
		<th>Feature B name</th>
		<th>Feature B image</th>
		<th>Percentage feature left</th>	
		<th>Percentage feature right</th>
	</tr>
  <?php 
	$query = "Select * from generics";
	$result = $link->prepare($query);
	$result->execute();
	$count = 1;
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$id = trim($row['Id']);
		$question = trim($row['Question']);
		$title_left = trim($row['Title_left']);
		$title_right = trim($row['Title_right']);
		$img1 = trim($row['img1']);
		$img2 = trim($row['img2']);
		$percentage_A_left = trim($row['percentage_A_left']);
		$percentage_A_right = trim($row['percentage_A_right']);
		$percentage_B_left = trim($row['percentage_B_left']);
		$percentage_B_right = trim($row['percentage_B_right']);
	?>
		<tr>
			<td><?php echo $count; ?></td>
			<td> 
				<div contentEditable='true' class='edit' id='Question-<?php echo $id; ?>'> 
				<?php echo $question; ?>
				</div> 
			</td>
			<td> 
				<div contentEditable='true' class='edit' id='Title_left-<?php echo $id; ?>'>
				<?php echo $title_left; ?> 
				</div> 
			</td>
			<td> 
				<div>
				<?php echo "<img id='img1".$id."' style='display:block;' height='100' src=".$img1.">"; ?> 
				<?php make_dropdown('img1', $id, $img1) ?>
				</div>
			</td>
			<td> 
				<div contentEditable='true' class='edit' id='Title_right-<?php echo $id; ?>'>
				<?php echo $title_right; ?> 
				</div> 
			</td>
			<td> 
				<div>
				<?php echo "<img id='img2".$id."' style='display:block;' height='100' src=".$img2.">"; ?> 
				<?php make_dropdown('img2', $id, $img2) ?>
				</div>
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
		<td colspan="5">
		</td>
		<td>
			<button onclick="window.location.href = 'new_entry.php';">Add new statement</button>	
		</td>
	</tr>
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
	  var value = $(this).text();

	  $.ajax({
	   url: 'update.php',
	   type: 'post',
	   data: { field:field_name, value:value, id:edit_id },
	   success:function(response){
		console.log('Save successfully'); 
	   }
	  });
	 
	 });
	 
	 $(".image_edit").change(function(){
		var id = this.id;
		var split_id = id.split("-");
		var field_name = split_id[0];
		var edit_id = split_id[1];
		var value = $(this).find(":selected").text();

		$.ajax({
		 url: 'update.php',
		 type: 'post',
		 data: { field:field_name, value:'img/'+value+'.PNG', id:edit_id },
		 success:function(response){
			console.log('Save successfully'); 
			location.reload();  
		 }
		}); 
	 });
	 
	 $(".num_edit").focusout(function(){
	  $(this).removeClass("editMode");
	  var id = this.id;
	  var split_id = id.split("-");
	  var field_name = split_id[0];
	  var edit_id = split_id[1];
	  var value = parseInt($(this).val());
	  var other_field = ((id.replace("A", "C")).replace("B", "A")).replace("C", "B");
	  if((parseInt($("#"+other_field).val()) + parseInt(value)) > 100){
		$("#"+id).addClass("error");
		$("#"+other_field).addClass("error");
	    if(id.indexOf("left") >= 0){
		  alert("Sum of left percentage ("+(parseInt($("#"+other_field).val()) + parseInt(value))+"%) features greater than 100%");
		}
		else{
		  alert("Sum of right percentage ("+(parseInt($("#"+other_field).val()) + parseInt(value))+"%) features greater than 100%");
		}
	  }
	  else{
		$("#"+id).removeClass("error");
		$("#"+other_field).removeClass("error");
        $.ajax({
	     url: 'update.php',
	     type: 'post',
	     data: { field:field_name, value:value, id:edit_id },
	     success:function(response){
		  console.log('Save successfully'); 
	     }
	    });
	  }
	 
	 });

	});
</script>