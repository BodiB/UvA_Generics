<?php
session_start();
include('db.php');

function sql_to_html_table($sqlresult, $delim="\n") {
  // starting table
  $htmltable =  "<table>" . $delim ;   
  $counter   = 0 ;
  // putting in lines
  while( $row = $sqlresult->fetch(PDO::FETCH_ASSOC)  ){
    if ( $counter===0 ) {
      // table header
      $htmltable .=   "<tr>"  . $delim;
      foreach ($row as $key => $value ) {
          $htmltable .=   "<th>" . $key . "</th>"  . $delim ;
      }
      $htmltable .=   "</tr>"  . $delim ; 
      $counter = 22;
    } 
      // table body
      $htmltable .=   "<tr>"  . $delim ;
      foreach ($row as $key => $value ) {
          $htmltable .=   "<td contentEditable='true'>" . $value . "</td>"  . $delim ;
      }
      $htmltable .=   "</tr>"   . $delim ;
  }
  // closing table
  $htmltable .=   "</table>"   . $delim ; 
  // return
  return( $htmltable ) ; 
}

?>
<!DOCTYPE html>

<head>
    <link rel='stylesheet' href='css.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <script src="https://www.google.com/recaptcha/api.js?render=6LcpSOsUAAAAAKk5EE2MoABHbM75mpNUHz_dlQ3r"></script>
    <script src="captcha.js"></script>
</head>
<html>

<body>
    <h1>Admin Menu</h1> 
	
	<?php 
	$DB = new PDO($dsn, $user, $passwd);
	$sqlresult = $DB->query( "SELECT * FROM generics;" ) ; 

	echo sql_to_html_table( $sqlresult, $delim="\n" ) ; 
	?>
	
	
	<div class="TEXT">
	
	</div>
    <div class="quiz-container">
        <div id="quiz">
        </div>
    </div>
    <div id="results"></div>
</body>

</html>
