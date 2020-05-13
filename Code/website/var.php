<?php
	include('db.php');
//    $website = "https://mycologic-cement.000webhostapp.com";
    $selectStatement = "SELECT *
                       FROM generics
                       ORDER BY RAND()
                       LIMIT 1";
    
    $pdo = new PDO($dsn, $user, $passwd);
 
    $stm = $pdo->prepare($selectStatement);
    $stm->execute();   
    $row = $stm->fetch(PDO::FETCH_ASSOC);
	
	$selectSettings = "SELECT *
                       FROM settings
                       LIMIT 1";
    
    $link = new PDO($dsn, $user, $passwd);
 
    $linkstm = $link->prepare($selectSettings);
    $linkstm->execute();
	$settings = $linkstm->fetch(PDO::FETCH_ASSOC);
	
	
	$selectFeature = "SELECT *
                      FROM feature
					  WHERE id = :id";
    
    $feat = new PDO($dsn, $user, $passwd);
 
    $featstm = $feat->prepare($selectFeature);
	$featstm->execute([
       'id' => $_SESSION["random_order"][$_SESSION['question_count']],
    ]);
	$feat = $featstm->fetch(PDO::FETCH_ASSOC);
	
	$allQuestions = [$row['Question'], $row['Title_left'], $row['Title_right'], $row['img1'], $row['img2'], $settings['scale_min'], $settings['scale_max']];
	$max_questions = $settings['max_questions'];
    $v_t = rand($settings['min_vertical'], $settings['max_vertical']); // Vertical number of tiles
    $h_t = rand($settings['min_horizontal'], $settings['max_horizontal']); // Horizontal number of tiles
	$size = $v_t*$h_t;
	
	//TODO Check if percentage is not higher than 100%.
	$A_l = $feat['percentage_A_left'];
	$B_l = $feat['percentage_B_left'];
	$A_r = $feat['percentage_A_right'];
	$B_r = $feat['percentage_B_right'];
	if(($A_l + $B_l) > 100){
		$A_l = $A_l/($A_l + $B_l)*100;
		$B_l = $B_l/($A_l + $B_l)*100;
	}
	if(($A_r + $B_r) > 100){
		$A_r = $A_r/($A_r + $B_r)*100;
		$B_r = $B_r/($A_r + $B_r)*100;
	}
    $t_A_l = floor($size * $A_l / 100); // #Tiles with occurence of A left (floored)
    $t_B_l = floor($size * $B_l / 100); // #Tiles with occurence of B left (floored)
    $t_A_r = floor($size * $A_r / 100); // Percentage of occurence of A right (floored)
    $t_B_r = floor($size * $B_r / 100); // Percentage of occurence of B right (floored)
	
	
	$data['allQuestions'] = $allQuestions;
	$data['v_t'] = $v_t;
	$data['h_t'] = $h_t;
	$data['size'] = $size;
	$data['t_A_l'] = $t_A_l;
	$data['t_B_l'] = $t_B_l;
	$data['t_A_r'] = $t_A_r;
	$data['t_B_r'] = $t_B_r;
	$data['scale_min'] = $settings['scale_min'];
	$data['scale_max'] = $settings['scale_max'];
	
