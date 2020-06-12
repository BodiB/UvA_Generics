<?php
session_start();
if ($_SESSION['prolific'] == 1) {
    include('db.php');
    include('init.php');
    include('var.php');
    $link = new PDO($dsn, $user, $passwd);
    $statement = $link->prepare('UPDATE user
                             SET ending_time= NOW(), rewarded = 1
                             WHERE prolific_id = :prolific_id');

    $statement->execute(['prolific_id' => $_SESSION['ID']]); ?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="5;URL=<?php echo $_SESSION['prolific_refer']; ?>">
</head>
<html>

    <body>
        Thank you for participating. </br>
		you will be referred to Prolific.
    </body>

</html>
<?php
}
 ?>
