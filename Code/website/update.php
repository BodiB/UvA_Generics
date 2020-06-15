<?php
session_start();
if ($_SESSION['admin'] == 1) {
    include('db.php');

    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];

    $query = "UPDATE generics SET ".$field."='".trim($value)."' WHERE id='".$editid."'";
    $link = new PDO($dsn, $user, $passwd);
    $stm = $link->prepare($query);
    $stm->execute();

    echo 1;
}
?>