<?php?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Főoldal</title>
    <link rel="stylesheet" href="All.css"/>
</head>
<body>
<div id="helpdiv"><nav><ul id="menu">
            <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
            <li class="lik"><a href="Aruk.php" class="lika" style="color: blueviolet">Áruk</a></li>
            <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
            <li class="lik"><a href="Login.php"  class="lika" style="color: black">Login</a></li>
            <li class="lik"><a href="Regist.php"  class="lika" style="color: black">Registration</a></li>
        </ul></nav>
</div>
<div class="container">
   <?php
      include "dbconn.php";
      $conn = DBconnection::getInstance();

       $stid2 = oci_parse($conn->getConnection(), 'SELECT nev, ar, db_szam FROM TERMEK WHERE db_szam>0 ORDER BY ID');

   if(!$stid2) {
   	$e = oci_error($conn->getConnection(), $query);
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid2);
   if(!$r){
   	$e = oci_error($stid2);
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
       while($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
           print "<table border='1'>\n";
           print "<tr><td>Termék Neve: </td><th>" . $row['NEV'] . "</th></tr>" ;
           print "<tr><td>Termék Ára: </td><th>" . $row['AR'] . " FORINT" . "</th></tr>" ;
           print "<tr><td>Rendelkezésre álló mennyiség: </td><th>" . $row['DB_SZAM'] . " Db" . "</th></tr>" ;



       print "<br>";
   }

   oci_free_statement($stid2);
   ?>


</div>
</html>
