<<<<<<< HEAD
<?php session_start(); ?>
<?php
<<<<<<< Updated upstream
//include "databaseConnection.php";
$con = oci_connect('MARTON', '123456aA', 'localhost/XE', "UTF8") or die("Hibás csatlakozás!");

if (!$con) {
    $m = oci_error();
    trigger_error(htmlentities($m['message'],ENT_QUOTES),E_USER_ERROR);
=======
session_start();
$conn = oci_connect('marton', '123456aA','localhost/XE');
if(!$conn){
=======
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

>>>>>>> David
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
<<<<<<< HEAD
>>>>>>> Stashed changes
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

=======
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
>>>>>>> David
