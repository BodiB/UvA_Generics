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
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id = trim($row['id']);
        $min_vertical = trim($row['min_vertical']);
        $max_vertical = trim($row['max_vertical']);
        $min_horizontal = trim($row['min_horizontal']);
        $max_horizontal = trim($row['max_horizontal']);
        $min_vertical = trim($row['min_vertical']);
        $max_questions = trim($row['max_questions']);
        $scale_max = trim($row['scale_max']);
        $scale_min = trim($row['scale_min']); ?>
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
		<tr>
			<td>Slider scale min value</td>
			<td>
				<input type="number" class='edit_scale' id='scale_min-<?php echo $id; ?>' value='<?php echo $scale_min; ?>'>
			</td>
		</tr>
		<tr>
			<td>Slider scale max value</td>
			<td>
				<input type="number" class='edit_scale' id='scale_max-<?php echo $id; ?>' value='<?php echo $scale_max; ?>'>
			</td>
		</tr>
	<?php
        $count ++;
    }
    ?>
</table>

<script type="text/javascript" src="settings.js"></script>
