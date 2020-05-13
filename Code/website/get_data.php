<?php  
//MySQL connection details.
include("db.php");

//Connect to MySQL using PDO.
$link = new PDO($dsn, $user, $passwd);

//Create our SQL query.
$query = "Select * from results";

//Prepare our SQL query.
$result = $link->prepare($query);

//Executre our SQL query.
$result->execute();
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=data.csv');  
$output = fopen("php://output", "w");  
fputcsv($output, array('ID', 'Name', 'Address', 'Gender', 'Designation', 'Age'));  
while($row = $result->fetch(PDO::FETCH_ASSOC))  
{  
	fputcsv($output, $row);  
}  
fclose($output);  
?> 