<?php
    session_start();
    $_SESSION['ID']= $_GET['PROLIFIC_PID'];    
    session_destroy();
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="refresh" content="0;URL=index.php">
</head>
<html>

<body>

</body>

</html>
