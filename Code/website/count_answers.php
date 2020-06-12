<?php
// Needs to be included in another file to work.
if (isset($_SESSION['ID'])) {
    $link = new PDO($dsn, $user, $passwd);
    $selectStatement = "Select count(*)
           FROM results
           WHERE prolific_id = :id";
    $link = new PDO($dsn, $user, $passwd);
    $stm = $link->prepare($selectStatement);
    $stm->execute(['id' => $_SESSION['ID']]);
    $num_rows = $stm->fetchColumn();
    $_SESSION['question_count'] = $num_rows + 1;
}
