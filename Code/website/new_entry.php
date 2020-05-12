<?php
    include('db.php');
    $query = "INSERT INTO `generics`(`Question`, `Title_left`, `Title_right`, `img1`, `img2`) VALUES ('Question','Left','Right','img/bettle_A.PNG','img/bettle_C.PNG')";
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
