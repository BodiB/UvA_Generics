<?php
    session_start();
    $_SESSION['ID'] = $_GET['PROLIFIC_PID'];
    setcookie('ID', $_SESSION['ID'], time() + (86400 * 30), "/"); // 86400 = 1 day
	
	include('db.php');

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
    $statement = $link->prepare('INSERT INTO user (prolific_id, questions_answered, starting_time, rewarded)
								 VALUES (:id, :questions_answered, NOW(), False)');
    
    $statement->execute([
       'id' => $_SESSION['ID'],
       'questions_answered' => 0,
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
