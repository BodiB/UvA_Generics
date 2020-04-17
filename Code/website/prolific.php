<?php
    session_start();
    $_SESSION['ID'] = $_GET['PROLIFIC_PID'];
    setcookie('ID', $_SESSION['ID'], time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=index.php">
</head>
<html>

<body>

</body>

</html>
