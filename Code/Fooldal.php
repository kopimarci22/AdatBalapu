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
<<<<<<< HEAD
          <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
          <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
          <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>
              <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
          <li class="lik"><a href="Login.php"  class="lika" style="color: black">Login</a></li>
          <li class="lik"><a href="Regist.php"  class="lika" style="color: black">Registration</a></li>
      </ul></nav>
=======
              <?php if ( empty($_SESSION["username"]) ):?>
          <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
          <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                  <li class="lik"><a href="Login.php"  class="lika" style="color: black">Login</a></li>
                  <li class="lik"><a href="Regist.php"  class="lika" style="color: black">Registration</a></li>
              <?php elseif(empty($_SESSION["admin"]) ):;?>
                  <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
                  <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                  <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>


                <?php else:?>
                  <li class="lik"><a href="Fooldal.php" class="lika" style="color: blueviolet">Főoldal</a></li>
                  <li class="lik"><a href="Aruk.php" class="lika" style="color: black">Áruk</a></li>
                  <li class="lik"><a href="Kosar.php" class="lika" style="color: black">Kosár</a></li>

                  <li class="lik"><a href="add.php" class="lika" style="color: black">Add</a></li>
              <?php endif;
               ?>

      </ul></nav>
      <?php if ( !empty($_SESSION["username"]) ||  !empty($_SESSION["admin"])):?>
          <form id="logout" action="Fooldal.php" method="post" enctype="multipart/form-data" autocomplete="off">
              <fieldset id="logout" >
                  <input type="submit" name="logout" value="Logout" id="registgomb">
              </fieldset>
          </form>
      <?php endif;
      ?>

      <?php
      if (isset($_POST["logout"])) {
          echo $_SESSION["username"];
          session_unset();
          session_destroy();
          header("Location: Fooldal.php");

      }
      ?>

>>>>>>> David
  </div>
  <footer>
      <div id="attunes">
          <p id="footer">
              Készítették: Kopanecz Márton Botond & Nagyfalusi Dávid Márton & Kocsis Gergő
          </p>
      </div>
  </footer>  </body>
</html>
