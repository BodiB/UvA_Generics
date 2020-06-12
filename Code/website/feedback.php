<?php
include('dropdown.php');
?>
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
