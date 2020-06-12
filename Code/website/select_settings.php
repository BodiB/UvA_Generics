<?php
$selectSettings = "SELECT *
                   FROM settings
                   LIMIT 1";

$link = new PDO($dsn, $user, $passwd);

$linkstm = $link->prepare($selectSettings);
$linkstm->execute();
$settings = $linkstm->fetch(PDO::FETCH_ASSOC);
