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
	$allQuestions = [$row['Question'], $row['Title_left'], $row['Title_right'], $row['img1'], $row['img2']];
	
	$selectSettings = "SELECT *
                       FROM settings
                       LIMIT 1";
    
    $link = new PDO($dsn, $user, $passwd);
 
    $linkstm = $link->prepare($selectSettings);
    $linkstm->execute();
	$settings = $linkstm->fetch(PDO::FETCH_ASSOC);
	$max_questions = $settings['max_questions'];
    $v_t = rand($settings['min_vertical'], $settings['max_vertical']); // Vertical number of tiles
    $h_t = rand($settings['min_horizontal'], $settings['max_horizontal']); // Horizontal number of tiles
	$size = $v_t*$h_t;
	
	//TODO Check if percentage is not hight than 100% Then scale it.
    $t_A_l = floor($size * 50 / 100); // #tiles with occurence of A left (floored)
    $t_B_l = floor($size * 50 / 100); // #Tiles with occurence of B left (floored)
    $t_A_r = floor($size * 50 / 100); // Percentage of occurence of A right (floored)
    $t_B_r = floor($size * 50 / 100); // Percentage of occurence of B right (floored)
	
	
	$data['allQuestions'] = $allQuestions;
	$data['v_t'] = $v_t;
	$data['h_t'] = $h_t;
	$data['size'] = $size;
	$data['t_A_l'] = $t_A_l;
	$data['t_B_l'] = $t_B_l;
	$data['t_A_r'] = $t_A_r;
	$data['t_B_r'] = $t_B_r;
	
