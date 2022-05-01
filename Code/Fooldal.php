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
                  <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
                  <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                  <li class="lik"><a href="Login.php"  class="lika" style="color: black">Login</a></li>
                  <li class="lik"><a href="Regist.php"  class="lika" style="color: black">Registration</a></li>

              <?php elseif(empty($_SESSION["admin"]) ):;?>
                  <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
                  <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                  <li class="lik"><a href="Komment.php" class="lika" style="color: black">Komment</a></li>
                  <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
                  <li class="lik"><a href="profil.php" class="lika" style="color: black">Profil</a></li>
                  <li class="lik"><a href="logout.php" class="lika" style="color: black">Logout</a></li>



              <?php else:?>
                  <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
                  <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                  <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
                  <li class="lik"><a href="Lekerdezesek.php" class="lika" style="color: black">Lekérdezések</a></li>
                  <li class="lik"><a href="logout.php" class="lika" style="color: black">Logout</a></li>
              <?php endif;
              ?>
          </ul></nav>




  </div>
  <footer>
      <div id="attunes">
          <p id="footer">
              Készítették: Kopanecz Márton Botond & Nagyfalusi Dávid Márton & Kocsis Gergő
          </p>
      </div>
  </footer>  </body>
</html>
