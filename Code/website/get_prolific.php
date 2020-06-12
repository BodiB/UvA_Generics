<?php
$link = new PDO($dsn, $user, $passwd);
$selectAdmins = "Select prolific
           FROM user
           WHERE prolific_id = :id";
$link = new PDO($dsn, $user, $passwd);
$stmAdmin = $link->prepare($selectAdmins);
$stmAdmin->execute(['id' => $_SESSION['ID']]);
$row = $stmAdmin->fetch(PDO::FETCH_ASSOC);

$_SESSION['prolific'] = $row['prolific'];
?>