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
<p id="nev" class="card-text"><?php echo "Bejelentkezve: " . $_SESSION["username"]?></p>
<div id="helpdiv"><nav><ul id="menu">
            <?php if ( empty($_SESSION["username"]) ):?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
                <li class="lik"><a href="profil.php" class="lika" style="color: blueviolet">Profil</a></li>
                >
            <?php elseif(empty($_SESSION["admin"]) ):;?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
                <li class="lik"><a href="Kosar.php" class="lika" style="color: blueviolet">Kosár</a></li>
                <li class="lik"><a href="profil.php" class="lika" style="color: black">Profil</a></li>


            <?php else:?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Kosar.php" class="lika" style="color: blueviolet">Kosár</a></li>
                <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
            <?php endif;
            ?>
        </ul></nav>
</div>
<?php
include "databaseconn.php";
$conn = DBconnection::getInstance();
$stid = oci_parse($conn->getConnection(), "SELECT K_ID,FEL_NEV,IDOPONT, NEV,AR,  K_DB_SZAM  FROM KOSAR WHERE FEL_NEV=:felhnev and CHECK_=0");

oci_bind_by_name($stid, ':felhnev', $_SESSION['username']);
$stid2 = oci_parse($conn->getConnection(), "SELECT TorzsvE  FROM TORZSVASARLO WHERE FEL_NEV=:felhnev");
oci_bind_by_name($stid2, ':felhnev', $_SESSION['username']);

if(!$stid || !$stid2) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$r = oci_execute($stid);
$t = oci_execute($stid2);
if(!$r || !$t){
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    $w = oci_error($stid2);
    trigger_error(htmlentities($w['message'], ENT_QUOTES), E_USER_ERROR);
}
print "<table border='1'>\n";

$value = 0;
//táblázat felső sora h mi is látható

print "Ez itt a kosarad és tartalma: ";
print "<tr><th>Termék Neve: </th><th>Darab a kosaradban: </th><th>Ára per db: </th><th>Törlés </th></tr>";
while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $t = oci_execute($stid2);
    print "<tr>\n";
    print "<form method='POST' action='torol.php'>";
    $value += $row['AR'] * $row['K_DB_SZAM'];
    print "<tr><td>". $row['NEV']. "</td><td>". $row['K_DB_SZAM']." Db".  "</td><td>". $row['AR']." Ft".  "</td><td><input type='submit' class='btn btn-info' name='delete' value='X'></td></tr>";
    print "";
    print "<input type='hidden' name='name' value='$_SESSION[username]'/>";
    print "<input type='hidden' name=' k_id' value='$row[K_ID]'/>";
    print "</form>";
    print "</tr>\n";

}
?>
<form method='POST' action='megrendel.php'>
    <?php
    $torzsv = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS);
    if($torzsv['TORZSVE'] == 1){
        $value *= 0.9;
    }
    print "<input type='hidden' name='vegosszeg' value='$value'/>";

    print "</table><br>\n";

    print "Fizetendő összeg: " . $value . " Ft";
    oci_free_statement($stid);
    ?>
    <input type='submit' class="btn btn-info" name="finish" value="Megrendel">
</form>
</div>
</div>
</body>
</html>