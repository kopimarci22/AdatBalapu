
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Főoldal</title>
    <link rel="stylesheet" href="All.css"/>
</head>
<body>
<?php if ( !empty($_SESSION["username"]) ):?>
    <p id="nev" class="card-text"><?php echo "Bejelentkezve: " . $_SESSION["username"]?></p>
<?php endif;?>
<div id="helpdiv"><nav><ul id="menu">
            <?php if ( empty($_SESSION["username"]) ):?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Login.php"  class="lika" style="color: black">Login</a></li>
                <li class="lik"><a href="Regist.php"  class="lika" style="color: black">Registration</a></li>

            <?php elseif(empty($_SESSION["admin"]) ):;?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
                <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
                <li class="lik"><a href="profil.php" class="lika" style="color: black">Profil</a></li>
                <li class="lik"><a href="logout.php" class="lika" style="color: black">Logout</a></li>


            <?php else:?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
                <li class="lik"><a href="Lekerdezesek.php" class="lika" style="color: blueviolet">Lekérdezések</a></li>
                <li class="lik"><a href="logout.php" class="lika" style="color: black">Logout</a></li>
            <?php endif;
            ?>
        </ul></nav>
</div>
<div class="container">
   <?php
   include "dbconn.php";
   $conn = DBconnection::getInstance();
   //var_dump($_POST);
   echo "<h1>Lekérdezések</h1>";
   $query1="SELECT nev FROM felhasznalo INNER JOIN MEGRENDELES ON felhasznalo.fel_nev=megrendeles.fel_nev WHERE MEGRENDELES.k_ar=(SELECT max(k_ar) FROM megrendeles)";
   $query2="select kategoria.kategoria, nev from termek inner join kategoria on termek.kategoria=kategoria.kategoria where termek.ar=(select max(ar) from termek)";
   $query3="select max(sum(termek.db_szam)) from termek inner join kategoria on kategoria.kategoria=termek.kategoria group by termek.kategoria";
   $query4="select termek.kategoria, count(termek.nev) from kategoria inner join termek on kategoria.kategoria=termek.kategoria group by termek.kategoria";
   $query5="select max(count(komment.nev)) from termek inner join komment on komment.nev=termek.nev group by komment.nev";
   $query6="SELECT nev FROM felhasznalo INNER JOIN MEGRENDELES ON felhasznalo.fel_nev=megrendeles.fel_nev WHERE MEGRENDELES.k_ar=(SELECT max(k_ar) FROM megrendeles  inner join torzsvasarlo on torzsvasarlo.fel_nev=megrendeles.fel_nev where torzsvasarlo.torzsve='0')";
   $query7="SELECT LAKCIM FROM FELHASZNALO INNER JOIN MEGRENDELES ON FELHASZNALO.FEL_NEV=MEGRENDELES.FEL_NEV GROUP BY FELHASZNALO.LAKCIM";
   $query8="SELECT FELHASZNALO.NEV FROM FELHASZNALO INNER JOIN KOMMENT ON FELHASZNALO.FEL_NEV=KOMMENT.FEL_NEV GROUP BY FELHASZNALO.NEV";
   $query9="SELECT FELHASZNALO.EMAIL FROM FELHASZNALO INNER JOIN KOMMENT ON FELHASZNALO.FEL_NEV=KOMMENT.FEL_NEV GROUP BY FELHASZNALO.EMAIL";

   $stid = oci_parse($conn->getConnection(),$query1);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "Legnagyobb összegben rendelt: ";
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"Melyik kategóriában van a legdrágább termék:<br>";
   $stid = oci_parse($conn->getConnection(),$query2);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);


   print"Kategóriánként a legtöbb termék darabszám:<br>";
   $stid = oci_parse($conn->getConnection(),$query3);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"Melyik kategóriában hány fajta termék van:<br>";
   $stid = oci_parse($conn->getConnection(),$query4);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"Mennyi a legtöbb komment egy termékhez: <br>";
   $stid = oci_parse($conn->getConnection(),$query5);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"Melyik nem törzsvásárló költötte a legtöbbet:<br>";
   $stid = oci_parse($conn->getConnection(),$query6);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"";
   print"Honnan rendeltek:<br>";
   $stid = oci_parse($conn->getConnection(),$query7);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"";
   print"Kik kommenteltek:<br>";
   $stid = oci_parse($conn->getConnection(),$query8);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"";

   print"Kik kommenteltek email szerint:<br>";
   $stid = oci_parse($conn->getConnection(),$query9);

   //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
   if(!$stid) {
       $e = oci_error($conn);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   $r = oci_execute($stid);
   if(!$r){
       $e = oci_error($stid);
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
   }
   print "<table border='1'>\n";
   while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       print "<tr>\n";
       foreach ($row as $item) {
           print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
       }
       print "</tr>\n";
   }
   print "</table><br>\n";
   oci_free_statement($stid);
   print"";


   ?>
</div>


</body>
</html>

