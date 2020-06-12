<?php
$selectStatement = "SELECT *
                   FROM generics
                   WHERE id = :id";

$pdo = new PDO($dsn, $user, $passwd);

$stm = $pdo->prepare($selectStatement);
$stm->execute([
       'id' => $_SESSION["random_order_statement"][$_SESSION['question_count']]
    ]);
$row = $stm->fetch(PDO::FETCH_ASSOC);
