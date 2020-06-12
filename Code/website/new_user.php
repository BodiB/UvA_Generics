<?php
	session_destroy();
    session_start();
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 15; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $_SESSION['ID'] = $randomString;
	
	include('db.php');
	
	$link = new PDO($dsn, $user, $passwd);
    $selectStatement = "SELECT max_questions
                       FROM settings
                       LIMIT 1";
	$stm = $link->prepare($selectStatement);
    $stm->execute(['id' => $_SESSION['ID']]);
	$row = $stm->fetch(PDO::FETCH_ASSOC);
	
	//Set the maximum ammount of questions a user may get.
	$max_questions = $row['max_questions'];
	//Preset the random order of the features.
	$_SESSION["random_order"] = range(1,$max_questions);
	shuffle($_SESSION["random_order"]);
	
	//Preset the random order of the statements
	$_SESSION["random_order_statement"] = range(1,$max_questions);
	shuffle($_SESSION["random_order_statement"]);
	array_unshift($_SESSION["random_order_statement"],0);

    $link = new PDO($dsn, $user, $passwd);
    $selectStatement = "SELECT *
                       FROM user
                       WHERE prolific_id = :id";
	$stm = $link->prepare($selectStatement);
    $stm->execute(['id' => $_SESSION['ID']]);
	$row = $stm->fetch(PDO::FETCH_ASSOC);
	if($row['rewarded'] == True){
	?>
		<!DOCTYPE html>

		<head>
			<meta http-equiv="refresh" content="0;URL=thanks.php">
		</head>
		<html>

		<body>
		</body>

		</html>
<?php
	}
    else{
    $statement = $link->prepare('INSERT INTO user (prolific_id, starting_time, rewarded, prolific)
								 VALUES (:id, NOW(), False, False)');
    
    $statement->execute([
       'id' => $_SESSION['ID'],
    ]);
	$_SESSION['question_count'] = 0;
	include('var.php');
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=index.php">
</head>
<html>

<body>
</body>

</html>
	<?php } ?>
