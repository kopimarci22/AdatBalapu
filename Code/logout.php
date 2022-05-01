<?php
session_start();

if (isset($_SESSION['username']) || $_SESSION['admin']) {
    session_destroy();
    session_unset();
    echo "<br> Sikeres kijelentkezés!";
    header("Location:Fooldal.php");
}
?>
