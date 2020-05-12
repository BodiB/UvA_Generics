<?php
include('dropdown.php');
?>
<?php
$query = "Select * from results";
$result = $link->prepare($query);
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
?>
</br>
THIS WILL SOON PRINT THE DATA AS A TABLE.
