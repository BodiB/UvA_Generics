<?php

    include('db.php');

    $field = $_POST['field'];
    $value = $_POST['value'];
    $editid = $_POST['id'];

    $query = "UPDATE features SET ".$field."='".$value."' WHERE id=".$editid;
    $link = new PDO($dsn, $user, $passwd);
    $stm = $link->prepare($query);
    $stm->execute();

    echo 1;
?> 
