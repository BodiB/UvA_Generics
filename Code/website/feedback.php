<?php
include('dropdown.php');
?>
<!-- CSV download not working, but can copy and paste the table below.
<button onclick="location.href='get_data.php'" target="_blank">Download result data</button>-->
(The table below can be copied and pasted to excel)
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
