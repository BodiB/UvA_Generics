<?php
session_start();
include('db.php');
$link = new PDO($dsn, $user, $passwd);

?>
<!DOCTYPE html>

<head>
    <link rel='stylesheet' href='css.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="jquery.redirect.js"></script>
</head>
<html>
<body>
<?php if ($_SESSION['admin'] == 1) { ?>
<h1>Admin Menu</h1>

    <div class='container'>
        <select id="dynamic_select">
            <option selected>Please select a page</option>
            <option value="statement.php">Statements</option>
            <option value="settings.php">Settings</option>
            <option value="results.php">Results</option>
        </select>​
            <?php
            if (isset($_POST['page']) || isset($_SESSION['page'])) {
                if (!isset($_POST['page']) && isset($_SESSION['page'])) {
                    $_POST['page'] = $_SESSION['page'];
                }
                $pages = array("statement.php", "settings.php", "results.php");
                if (in_array($_POST['page'], $pages)) {
                    include($_POST['page']);
                }
            }
            ?>

        <script>
            $(function(){
              // bind change event to select
              $('#dynamic_select').change(function () {
                  var url = $(this).val(); // get selected value
                  $.redirect('admin.php',
                    {
                        page: url,
                    });
              });
            });

        </script>
    </div>
<?php } else {?>
<h1>No authorization</h1>
<?php }?>
</body>

</html>
