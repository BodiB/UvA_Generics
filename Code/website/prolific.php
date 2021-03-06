<?php
    session_destroy();
    session_start();
    if (isset($_GET['PROLIFIC_PID'])) {
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
        $_SESSION["random_order"] = range(1, $max_questions);
        shuffle($_SESSION["random_order"]);

        //Preset the random order of the statements
        $_SESSION["random_order_statement"] = range(1, $max_questions);
        shuffle($_SESSION["random_order_statement"]);
        array_unshift($_SESSION["random_order_statement"], 0);

        $link = new PDO($dsn, $user, $passwd);
        $selectStatement = "SELECT *
                       FROM user
                       WHERE prolific_id = :id";
        $stm = $link->prepare($selectStatement);
        $stm->execute(['id' => $_SESSION['ID']]);
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        if ($row['rewarded'] == true) {
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
        } else {
            $statement = $link->prepare('INSERT INTO user (prolific_id, starting_time, rewarded, prolific)
								 VALUES (:id, NOW(), False, True)');

            $statement->execute([
       'id' => $_SESSION['ID'],
    ]);
            $_SESSION['question_count'] = 0;
            include('var.php'); ?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=index.php">
</head>
<html>

    <body>
    </body>

</html>
<?php
        }
    } else {?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=thanks.php">
</head>
<html>

    <body>
    </body>

</html>
<?php    }?>
