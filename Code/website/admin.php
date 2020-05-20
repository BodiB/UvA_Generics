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
<?php if($_SESSION['admin'] == 1){ ?>
<h1>Admin Menu</h1> 	
	<div class='container'>
		<select id="dynamic_select">
			<option selected>Please select a page</option>
			<option value="statement.php">Statements</option>
			<option value="settings.php">Settings</option>
			<option value="results.php">Results</option>
			<option value="features.php">Features</option>
			<option value="feedback.php">Feedback</option>
		</select>​
			<?php 
			if (isset($_POST['page']) || isset($_SESSION['page'])){
				if(!isset($_POST['page']) && isset($_SESSION['page'])){
					$_POST['page'] = $_SESSION['page'];
				}
				$pages = array("statement.php", "settings.php", "results.php","features.php","feedback.php");
				if (in_array($_POST['page'], $pages)){
					include($_POST['page']);
				}
			}
			?>
			
		<script src="select.js"></script>
	</div>
<?php } else{?>

<?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == 'Mirabile' && 
                  $_POST['password'] == 'Patricia') {
                  $_SESSION['admin'] = 1;
                  echo 'You have entered valid username and password';
				  echo '<script type="text/javascript">location.reload(true);</script>';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
<h1>No authorization</h1>
<div>
<form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" name = "username" placeholder = "username" required autofocus></br>
            <input type = "password" class = "form-control" name = "password" placeholder = "password" required></br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Login</button>
         </form> 
</div>
<?php }?>
</body>

</html>
