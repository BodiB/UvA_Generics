<?php 
include('dropdown.php');
?>
<button onclick="location.href='get_data.php'" target="_blank">Download result data</button>
(The table below can be copied and pasted to excel)
<?php 
$query = "SELECT `result_id`, `results`.`prolific_id`, `question_num`, `question`, `grid_v`, `grid_h`, `t_A_l`, `t_B_l`, `t_A_r`, `t_B_r`, `rating`, `serious`, `feedback` 
          FROM `results` 
		  JOIN `user` 
		  ON results.prolific_id = `user`.prolific_id";
$result = $link->prepare($query);
$result->execute();
echo "<table>";
echo "<tr>";
	echo "<th>id</th>";
	echo "<th>User</th>";
	echo "<th>Nth question for user</th>";
	echo "<th>Statement</th>";
	echo "<th>Vertical tiles</th>";
	echo "<th>Horizontal tiles</th>";
	echo "<th>Tiles with Feature A left side</th>";
	echo "<th>Tiles with Feature B left side</th>";
	echo "<th>Tiles with Feature A right side</th>";
	echo "<th>Tiles with Feature B right side</th>";
	echo "<th>Rating given</th>";
	echo "<th>Reply to seriousness question</th>";
	echo "<th>Feedback</th>";
	echo "</tr>";
while($row = $result->fetch(PDO::FETCH_ASSOC)){
	echo "<tr>";
	echo "<td>".$row['result_id']."</td>";
	echo "<td>".$row['prolific_id']."</td>";
	echo "<td>".$row['question_num']."</td>";
	echo "<td>".$row['question']."</td>";
	echo "<td>".$row['grid_v']."</td>";
	echo "<td>".$row['grid_h']."</td>";
	echo "<td>".$row['t_A_l']."</td>";
	echo "<td>".$row['t_B_l']."</td>";
	echo "<td>".$row['t_A_r']."</td>";
	echo "<td>".$row['t_B_r']."</td>";
	echo "<td>".$row['rating']."</td>";
	echo "<td>".$row['serious']."</td>";
	echo "<td>".$row['feedback']."</td>";
	echo "</tr>";
}
echo "</table>";
?>
</br>