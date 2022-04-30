<<<<<<< HEAD
<!DOCTYPE HTML>
<html lang="hu">
<head>
    <title>SPARta Bejelentkezés</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="All.css">
</head>
<body>
<header><a href="Fooldal.php">Vissza a főoldalra</a></header>
<div class="content" >
    <form action="" method="post">
        <h2 class="text-center" >Bejelentkezés</h2>
        <input class="input" type="text" name="userEmail" placeholder="Email"><br>
        <input class="input" type="password" name="password" placeholder="jelszó"><br>
        <input class="input" type="submit" value="Bejelentkezés">
    </form>
    <a href="Regist.php">Még nincs fiókja?</a>
</div>
</body>
</html>
=======
<?php session_start(); ?>
<?php
//include "databaseConnection.php";
$con = oci_connect('MARTON', '123456aA', 'localhost/XE', "UTF8") or die("Hibás csatlakozás!");

if (!$con) {
    $m = oci_error();
    trigger_error(htmlentities($m['message'],ENT_QUOTES),E_USER_ERROR);
}
$query = "select fel_nev, jelszo from FELHASZNALO where fel_nev = :username and jelszo= :password";
$stid = oci_parse($con, $query);

if (!$stid){
    $e=oci_error($con);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$r = oci_execute($stid);

if (isset($_POST['username']) || isset($_POST['password'])) {
    echo $query;
    $username = $_POST['username'];
    $password = $_POST['password'];

    oci_bind_by_name($stid, ":username", $username);
    oci_bind_by_name($stid, ":password", $password);

    oci_execute($stid);

    $row = oci_fetch_array($stid, OCI_ASSOC);
}
    if ($row = 1) {
        $_SESSION['username'] = $username;
        echo $username;
//        header("Location: Fooldal.php");
    } else {
        echo "Wrong username or password";
    }
    oci_free_statement($stid);
    oci_close($con);


?>

>>>>>>> origin/Marci
