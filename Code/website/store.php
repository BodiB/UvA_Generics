<?php
	session_start();
	include("var.php");
	
	if($_SESSION['admin'] == 1){
		?>
		<!DOCTYPE html>

            <head>
                <meta http-equiv="refresh" content="0;URL=thanks.php">
            </head>
            <html>

            <body>
                ADMIN
            </body>

            </html>
	<?php
	}
	else{
		if($_SESSION['question_count'] == $_COOKIE['question_count']){
			if($_SESSION['question_count'] >= $max_questions){?>
				<!DOCTYPE html>

				<head>
					<meta http-equiv="refresh" content="1;URL=thanks.php">
				</head>
				<html>

				<body>
					Submit answer
				</body>

				</html>
	<?php   }
			else{
				include('db.php');
				$_SESSION['question_count'] += 1;
				$data = $_SESSION['data'];
				$link = new PDO($dsn, $user, $passwd);
				
				$statement = $link->prepare('INSERT INTO results (prolific_id, question_num, question, grid_v, grid_h, t_A_l, t_B_l, t_A_r, t_B_r, rating)
											 VALUES (:prolific_id, :q_num, :question, :grid_v, :grid_h, :t_A_l, :t_B_l, :t_A_r, :t_B_r, :rating)');
				
				$statement->execute([
				   'prolific_id' => $_SESSION['ID'],
				   'q_num' => $_SESSION['question_count'],
				   'question' => $data['allQuestions'][0],
				   'grid_v' => $data['v_t'],
				   'grid_h' => $data['h_t'],
				   't_A_l' => $data['t_A_l'],
				   't_B_l' => $data['t_B_l'],
				   't_A_r' => $data['t_A_r'],
				   't_B_r' => $data['t_B_r'],
				   'rating' => $_POST['rating'],
				]);
				//$data['allQuestions'] = $allQuestions;
				if (isset($_POST['type'])) {
					if ($_POST['type'] == "next") {
						?>
						<!DOCTYPE html>

						<head>
							<meta http-equiv="refresh" content="0;URL=mem.php">
						</head>
						<html>

						<body>
						Next Q
						</body>

						</html>
	<?php
					} else {
						$link = new PDO($dsn, $user, $passwd);
				
						$statement = $link->prepare('UPDATE user 
													 SET ending_time= NOW(), rewarded = 1 
													 WHERE prolific_id = :prolific_id');
						
						$statement->execute(['prolific_id' => $_SESSION['ID']]);
						
						
						?>
						<!DOCTYPE html>

						<head>
							<meta http-equiv="refresh" content="1;URL=thanks.php">
						</head>
						<html>

						<body>
							Submit answer
						</body>

						</html>
			<?php   }
				} else {?>
				<!DOCTYPE html>

				<head>
				</head>
				<html>

				<body>
					What are you doing here?
				</body>

				</html>
	<?php 	}
		}
	}
}?>
