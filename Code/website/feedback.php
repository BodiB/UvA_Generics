<?php
include('dropdown.php');
?>
<button onclick="location.href='get_data.php'" target="_blank">Download result data</button>

(The table below can be copied and pasted to be used in excel)
<?php
$query = "Select feedback from user WHERE feedback NOT LIKE '' ";
$result = $link->prepare($query);
$result->execute();
echo "<table width='100%'>";
echo "<tr>";
    echo "<th>Feedback</th>";
echo "</tr>";
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>".$row['feedback']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
</br>
