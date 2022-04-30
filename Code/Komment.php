<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SparTa</title>
    <link rel="stylesheet" href="All.css"/>
</head>


<body>
<div>

    <p id="nev" class="card-text"><?php echo "Bejelentkezve: " . $_SESSION["username"]?></p>
    <div id="helpdiv"><nav><ul id="menu">
                <?php if ( empty($_SESSION["username"]) ):?>
                    <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                    <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                    <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
                    <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
                    <li class="lik"><a href="profil.php" class="lika" style="color: blueviolet">Profil</a></li>
                    >
                <?php elseif(empty($_SESSION["admin"]) ):;?>
                    <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                    <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                    <li class="lik"><a href="Komment.php" class="lika" style="color: black">Áruk</a></li>
                    <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
                    <li class="lik"><a href="profil.php" class="lika" style="color: blueviolet">Profil</a></li>


                <?php else:?>
                    <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                    <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                    <li class="lik"><a href="Kosar.php" class="lika" style="color: blueviolet">Kosár</a></li>
                    <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
                <?php endif;
                ?>
            </ul></nav>

<?php
include "databaseconn.php";
$conn = DBconnection::getInstance();
$stid2 = oci_parse($conn->getConnection(), 'SELECT * FROM TERMEK');
if(!$stid2) {
    $e = oci_error($conn->getConnection(), $stid2);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$r = oci_execute($stid2);
if(!$r){
    $e = oci_error($stid2);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>



        <h1 class="text-center" style="color: rgb(153,37,37);text-align: center; font-family: 'Times New Roman', Times, serif;">Nekünk számít az Ön véleménye!</h1>
    </div>
</div>
    <form method="POST" action="komm_create.php" accept-charset="utf-8">
        <div class="container">
            <label for="item">Termék kiválsztás:</label><br>
            <?php
            echo "<select name='item'>";
            while($row = oci_fetch_array($stid2))
            {
                echo "'<option name='item' id='item'> $row[NEV] </option>'";

            }
            echo "</select>";
            oci_free_statement($stid2);
            ?>
            <div class="form-group">
                <textarea class="form-control" rows="5" name="komment" id="komment"></textarea>
            </div>

            <div class='text-center'>
                <input type='submit' class='btn btn-outline-dark' name='komm_create' value='Mentés'>
            </div>
                </input>
        </div>
            </form>



    <?php
        $velemeny = oci_parse($conn->getConnection(), "SELECT NEV, KOMMENT, FEL_NEV FROM KOMMENT ORDER BY NEV");

        //oci_bind_by_name($stid, ':felhnev', $_SESSION['Felhnev']);
        if(!$velemeny) {
            $e = oci_error($conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $r = oci_execute($velemeny);
        if(!$r){
            $e = oci_error($velemeny);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        while($row = oci_fetch_array($velemeny, OCI_ASSOC+OCI_RETURN_NULLS)) {
            print "<table border='1'>\n";
            print "<tr>\n";
            print "<tr><th>Termék Neve: </th><th>A Komment: </th><th>Kommentelő Neve: </th></tr>";
            foreach ($row as $item) {
                print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
            }
            print "</tr>\n";
            print "</table><br>\n";
        }

        oci_free_statement($velemeny);
        ?>
</form>
</div>

</body>
</html>