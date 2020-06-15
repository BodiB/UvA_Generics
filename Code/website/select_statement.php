<?php
$selectStatement = "SELECT *
                   FROM generics
                   WHERE id = :id";

$pdo = new PDO($dsn, $user, $passwd);

$stm = $pdo->prepare($selectStatement);
if($_SESSION['question_count'] <= sizeof($_SESSION["random_order_statement"])){
$stm->execute([
       'id' => $_SESSION["random_order_statement"][$_SESSION['question_count']]
    ]);
}
else{
	$stm->execute([
       'id' => $_SESSION["random_order_statement"][0]
    ]);
}
$row = $stm->fetch(PDO::FETCH_ASSOC);
?>