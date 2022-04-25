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

       $stid2 = oci_parse($conn->getConnection(), 'SELECT nev, ar, db_szam FROM TERMEK WHERE db_szam>0 order by id');

   if(!$stid2) {
   	$e = oci_error($conn->getConnection(), $stid2);
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid2);
   if(!$r){
   	$e = oci_error($stid2);
   	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
    echo "asd";

  /* while (($user = oci_fetch_array($stid2, OCI_BOTH)) != false) {
       echo "<tr>";
       echo "<tr><td>".$user['NEV']."</td> </tr> ";
       echo "<tr><td>".$user['AR']."</td></tr>";
       echo "</tr>";
   }*/

   while(($row = oci_fetch_array($stid2, OCI_BOTH)) != false) {


        print "<table border='1'>\n";
        print "<tr><td>Termék Neve: </td><th>" .$row ['NEV'] . "</th></tr>" ;
        print "<tr><td>Termék Ára: </td><th>" . $row['AR'] . " FTS" . "</th></tr>" ;
        print "<tr><td>Rendelkezésre álló mennyiség: </td><th>" . $row['DB_SZAM'] . " Darab" . "</th></tr>" ;

       if(isset($_SESSION['Felhnev'])){
           print "<form method='POST' action='Kosar.php.php' accept-charset='utf-8'>";
           print "</table>\n";
           print "<div class='form-group'>";
           print "<label for='amount'>Darabszám</label>";
           print "<input type='number' name='amount' class='form-control' id='darab' placeholder='Darabszám' required>";
           print "<input type='hidden' name='name' value='$row[NEV]'/>";
           print "<input type='hidden' name='ar' value='$row[AR]'/>";

           print "<input type='submit' class='btnAddAction' value='Kosárba' placeholder='Megrendel' ></input>";
           print "</div>";
           print "</form>";
       }

       print "<br>";


   }


   oci_free_statement($stid2);
   ?>

</div>
</div>


</body>
</html>
