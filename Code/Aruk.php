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
    <div class="col-sm-4">

   <?php
      include "databaseconn.php";
      $conn = DBconnection::getInstance();

       $stid2 = oci_parse($conn->getConnection(), 'SELECT * FROM TERMEK WHERE db_szam>0');

   if(!$stid2) {
   	$e = oci_error($conn->getConnection(), $query);
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid2);
   if(!$r){
   	$e = oci_error($stid2);
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
    echo "asd";

    while($row = oci_fetch_array($stid2, OCI_BOTH)) {


           echo "<table border='1'>\n";
           echo "<tr><td>Termék Neve: </td><th>" . $row['nev'] . "</th></tr>" ;
           echo "<tr><td>Termék Ára: </td><th>" . $row['ar'] . " FORINT" . "</th></tr>" ;
           echo "<tr><td>Rendelkezésre álló mennyiség: </td><th>" . $row['db_szam'] . " Db" . "</th></tr>" ;




   }


   oci_free_statement($stid2);
   ?>

</div>
</div>


</body>
</html>
