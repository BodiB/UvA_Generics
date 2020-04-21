<?php
    // $website = "https://mycologic-cement.000webhostapp.com";
    // $selectStatement = "SELECT *
    //                     FROM Generics
    //                     ORDER BY RAND()
    //                     LIMIT 1";
    // $dsn = "mysql:host=localhost;dbname=id10853538_modernedatabases";
    // $user = "id10853538_modernedatabase";
    // $passwd = "F3O=]Iy?M(x~eArn";
    //
    // $pdo = new PDO($dsn, $user, $passwd);
    //
    // $stm = $pdo->prepare($selectStatement);
    // $stm->execute();
    //
    // $row = $stm->fetch(PDO::FETCH_ASSOC);
    $row['Question'] = "Hide Beetles from Genovesa have black wings.";
    $row['Title_left'] = "Marchena Hide Beetles";
    $row['Title_right'] = "Genovesa Hide Beetles";
    $row['img1'] = "img/bettle_A.PNG";
    $row['img2'] = "img/bettle_C.PNG";
    $allQuestions = [$row['Question'], $row['Title_left'], $row['Title_right'], $row['img1'], $row['img2']];
    $v_t = 1; // Vertical number of tiles
    $h_t = 1; // Horizontal number of tiles
    $p_A_l = 40; // Percentage of occurence of A left (floored)
    $p_B_l = 30; // Percentage of occurence of B left (floored)
    $p_A_r = 50; // Percentage of occurence of A right (floored)
    $p_B_r = 45; // Percentage of occurence of B right (floored)
