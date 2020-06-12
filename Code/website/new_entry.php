<?php
    if ($_SESSION['admin'] == 1) {
        include('db.php');
        $link = new PDO($dsn, $user, $passwd);

        $query1 = "SELECT Id FROM `generics`";
        $stm1 = $link->prepare($query1);
        $stm1->execute();
        $count = $stm1->rowCount();
        $next = $count;

        $query = "INSERT INTO `generics`(`Id`, `Question`, `Title_left`, `Title_right`, `img1`, `img2`) VALUES (?, 'Question','Left','Right','img/beetle_A.PNG','img/beetle_C.PNG')";
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
