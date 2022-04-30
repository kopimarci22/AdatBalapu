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
<div id="helpdiv"><nav><ul id="menu">


            <?php if ( empty($_SESSION["username"]) ):?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Komment.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Login.php"  class="lika" style="color: black">Login</a></li>
                <li class="lik"><a href="Regist.php"  class="lika" style="color: black">Registration</a></li>
            <?php elseif(empty($_SESSION["admin"]) ):;?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Komment.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Kosar.php" class="lika" style="color: blueviolet">Kosár</a></li>


            <?php else:?>
                <li class="lik"><a href="Fooldal.php" class="lika" style="color: black">Főoldal</a></li>
                <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                <li class="lik"><a href="Kosar.php" class="lika" style="color: blueviolet">Kosár</a></li>

                <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
            <?php endif;
            ?>

        </ul></nav>
</div>
</html>