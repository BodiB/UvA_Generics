<?php
session_start();
if($_SESSION['admin'] == 1){
    include('db.php');
    $link = new PDO($dsn, $user, $passwd);

    $query1 = "SELECT id FROM `features`";
    $stm1 = $link->prepare($query1);
    $stm1->execute();
    $count = $stm1->rowCount();
    $next = $count+1;

    $query = "INSERT INTO `features`(`id`, `percentage_A_left`, `percentage_A_right`, `percentage_B_left`, `percentage_B_right`) VALUES (?, 50,50,50,50)";
    $link = new PDO($dsn, $user, $passwd);
    $stm = $link->prepare($query);
    $stm->execute([$next]);

    echo 1;
}
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=<?php echo $_SERVER['HTTP_REFERER']; ?>">
</head>
<html>

    <body>

    </body>

</html>
