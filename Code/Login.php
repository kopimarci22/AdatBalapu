<!DOCTYPE HTML>
<html lang="hu">
<head>
    <title>SPARta bejelentkezés</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="All.css">
</head>
<body>
<header></header>
<div class="content">
    <form action="Login.php" method="post">
        <h2>Bejelentkezés</h2>
        <input type="text" name="felnev" placeholder="felnev" required><br>
        <input type="password" name="jelszo" placeholder="jelszo" ><br>
        <input type="submit" name="belep" value="Bejelentkezés">
    </form>
    <a href="Regist.php">Még nincs fiókja?</a>
</div>
</body>
</html>
<?php
session_start();
$conn = oci_connect('DAVID', 'asd123','localhost/XE');
if(!$conn){

    $e=oci_error();
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$query='SELECT * FROM FElHASZNALO';
$stid= oci_parse($conn, $query);
$amdin='SELECT * FROM ADMIN ';
$amdin2=oci_parse($conn, $amdin);

if (!$amdin2){
    $e=oci_error($conn);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

if (!$stid){
    $e=oci_error($conn);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

$r = oci_execute($stid);
$a= oci_execute($amdin2);

if (!$a){
    $e = oci_error($amdin2);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
if (!$r){
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$felhasznalo = "";
$password = "";
$errors[] = "";
$admin = "";
if (isset($_POST["belep"])) {
    $felhasznalo = $_POST["felnev"];
    $password = $_POST["jelszo"];
    $belep= false;


    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
        if ($row["FEL_NEV"] === $felhasznalo && $row["JELSZO"] === $password) {
            $belep=true;

        }
    }
    while (($row = oci_fetch_array($amdin2, OCI_BOTH)) != false) {
        if ($row["ADMIN_NEV"] === $felhasznalo && $row["ADMIN_JELSZO"] === $password) {
            $belep=true;
            $admin=$felhasznalo;
        }
    }


    if ($belep) {

        oci_close($conn);
        header("Location: Fooldal.php");
        $_SESSION["username"] =$felhasznalo;
        $_SESSION["admin"] =$admin;

    } else {
        echo "Hibás felhasználónév vagy jelszó!";

    }

}
?>