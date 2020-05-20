<?php
	include('db.php');
	$query = "INSERT INTO `features`(`percentage_A_left`, `percentage_A_right`, `percentage_B_left`, `percentage_B_right`) VALUES (50,50,50,50)";
	$link = new PDO($dsn, $user, $passwd);
	$stm = $link->prepare($query);
    $stm->execute();

	echo 1;
?>
<!DOCTYPE html>

<head>
	<meta http-equiv="refresh" content="0;URL=<?php echo $_SERVER['HTTP_REFERER']; ?>">
</head>
<html>

<body>

</body>

</html>
