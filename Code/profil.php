<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SparTa</title>
    <link rel="stylesheet" href="All.css"/>

</head>

<body>
<div id="helpdiv"><nav><ul id="menu">
<?php if ( empty($_SESSION["username"]) ):?>
    <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
    <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
    <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
    <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
    <li class="lik"><a href="profil.php" class="lika" style="color: blueviolet">Profil</a></li>

<?php elseif(empty($_SESSION["admin"]) ):;?>
    <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
    <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
    <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
    <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
    <li class="lik"><a href="profil.php" class="lika" style="color: blueviolet">Profil</a></li>
    <li class="lik"><a href="logout.php" class="lika" style="color: black">Logout</a></li>


<?php else:?>
    <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
    <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
    <li class="lik"><a href="Kosar.php" class="lika" style="color: blueviolet">Kosár</a></li>
    <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
    <li class="lik"><a href="logout.php" class="lika" style="color: black">Logout</a></li>

<?php endif;
?>
        </ul></nav>
</div>

<div class="container" style="padding-top: 1cm;">
    <h1 class="text-center" style="color: rgb(99, 37, 153); text-align: center;font-family: 'Times New Roman', Times, serif;">Profil</h1>

</div>
<div class="container">
        <div class="card-body">
            <h4 class="card-title">Legkirályabb Felhasználó</h4>


        </div>
    </div>

    <div class="column">
        <form method="POST" action="profil_update.php">
            <?php

            include "databaseconn.php";
            $conn = DBconnection::getInstance();
            $query="SELECT * FROM FELHASZNALO WHERE FEL_NEV=:felh";
            $parsed=oci_parse($conn->getConnection(),$query);
            oci_bind_by_name($parsed, ":felh", $_SESSION['username']);
            if(oci_execute($parsed)){
                while($row=oci_fetch_array($parsed)){
                    $email= $row['EMAIL'];
                    $pwd= $row['JELSZO'];
                    $name= $row['NEV'];
                    $uname= $row['FEL_NEV'];
                    $szdate= $row['SZUL_DATUM'];
                    $cim= $row['LAKCIM'];
                    $bankkartya= $row['BANKKARTYA'];
                    echo "<div class='container'>";
                    echo '<label for="mail">Email: </label>';
                    echo "<input type='text' name='mail'  value='$email'><br>";
                    echo '<label for="fistname">Jelszo: </label>';
                    echo "<input type='text' name='Jelszo' value='$pwd' ><br>";
                    echo '<label for="lastname">Név: </label>';
                    echo "<input type='text' name='name' value='$name'  ><br>";
                    echo  '<label for="bdate">Felhasznalo Név: </label>';
                    echo "<input type='text' name='uname' value='$uname' disabled><br>";
                    echo ' <label for="country">Születési dátum:  </label>';
                    echo "<input type='text' name='szdate' value='$szdate' ><br>";
                    echo '<label for="postcode">Lakcím: </label>';
                    echo  "<input type='text' id='cim' name='cim' value='$cim'><br>";

                    echo "</div>";
                }
            }
            ?>

            <input type='submit' class="btn btn-info" name="changeuser" value="Adatok módosítása">
            <?php
                if (isset($_SESSION['changeuser'])){

                    header("Location: profil_update.php");
                }
            ?>
        </form>
    </div>
<div class="container">
    <div class="col-sm-4">

        <?php



        $stid = oci_parse($conn->getConnection(), 'SELECT m_id,datum , k_ar FROM MEGRENDELES WHERE FEL_NEV=:felhnev');
        oci_bind_by_name($stid, ':felhnev', $_SESSION['username']);
        if(!$stid) {
            $e = oci_error($conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $r = oci_execute($stid);

        if(!$r){
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

        }

        while(($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            print "<table border='1'>\n";


            print "Eddigi rendelés ";
            print "<tr><th>Rendelés azonositó </th><th>Időpont </th><th>Összeg </th></tr>";
            while($row = oci_fetch_array($stid, OCI_BOTH)) {



                print "<tr>\n";
                print "<tr><td>". $row['M_ID']. "</td><td>". $row['DATUM'].  "</td><td>". $row['K_AR']." Ft".  "</td></tr>";

                print "</tr>\n";


            }

        }

        oci_free_statement($stid);
        ?>

    </div>

</div>
</div>
</body>
</html>
