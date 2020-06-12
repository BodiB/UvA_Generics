<?php
if ($_SESSION['admin'] == 1) {
    //MySQL connection details.
    include("db.php");

    //Connect to MySQL using PDO.
    $link = new PDO($dsn, $user, $passwd);

    //Create our SQL query.
    $query = "SELECT `results`.`prolific_id`, `question_num`, `question`, `grid_v`, `grid_h`, `t_A_l`, `t_B_l`, `t_A_r`, `t_B_r`, `rating`, `serious`, `feedback`
          FROM `results`
		  JOIN `user`
		  ON results.prolific_id = `user`.prolific_id";

    //Prepare our SQL query.
    $result = $link->prepare($query);

    //Executre our SQL query.
    $result->execute();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");

    fputcsv($output, array('user_id', 'question_number', 'statement', 'vertical_tiles', 'horizontal_tiles', 'feature_A_left', 'feature_B_left', 'feature_A_right', 'feature_B_right', 'response', 'seriousness', 'feedback'));
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $myrow = preg_replace("/\r|\n/", "", $row);
        fputcsv($output, $myrow);
    }
    fclose($output);
}
