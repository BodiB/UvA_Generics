<?php
    session_start();
    $_SESSION['ID'] = $_GET['PROLIFIC_PID'];

	include('db.php');

	$link = new PDO($dsn, $user, $passwd);
    $selectStatement = "SELECT max_questions
                       FROM settings
                       LIMIT 1";
	$stm = $link->prepare($selectStatement);
    $stm->execute(['id' => $_SESSION['ID']]);
	$row = $stm->fetch(PDO::FETCH_ASSOC);

	$max_questions = $row['max_questions'];
	$_SESSION["random_order"] = range(0,$max_questions);
	shuffle($_SESSION["random_order"]);

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
    $statement = $link->prepare('INSERT INTO user (prolific_id, starting_time, rewarded)
								 VALUES (:id, NOW(), False)');

    $statement->execute([
       'id' => $_SESSION['ID'],
    ]);
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=index.php">
</head>
<html>

<body>
	<?php echo $row['rewarded']; ?>
</body>

</html>
	<?php } ?>
