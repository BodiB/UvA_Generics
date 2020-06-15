<?php
session_start();
if(isset($_SESSION['ID'])){
	include('db.php');

	$value = $_POST['value'];
	$editid = $_POST['id'];

	$query = "UPDATE user SET serious ='".trim($value)."' WHERE prolific_id='".$editid."'";
	$link = new PDO($dsn, $user, $passwd);
	$stm = $link->prepare($query);
	$stm->execute();

	echo 1;
}
echo 0;
?>