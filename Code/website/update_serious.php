<?php
session_start();
if ($_SESSION['admin'] == 1) {
    include('db.php');

    $value = $_POST['value'];
    $editid = $_POST['id'];

    $query = "UPDATE user SET serious ='".trim($value)."' WHERE prolific_id=".$editid;
    $link = new PDO($dsn, $user, $passwd);
    $stm = $link->prepare($query);
    $stm->execute();

    echo 1;
}
?>