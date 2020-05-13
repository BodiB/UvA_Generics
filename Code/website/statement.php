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
	</tr>
  <?php
    $query = "Select * from generics";
    $result = $link->prepare($query);
    $result->execute();
    $count = 1;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id = trim($row['Id']);
        $question = trim($row['Question']);
        $title_left = trim($row['Title_left']);
        $title_right = trim($row['Title_right']);
        $img1 = trim($row['img1']);
        $img2 = trim($row['img2']); ?>
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

<script type="text/javascript" src="statement.js"></script>
