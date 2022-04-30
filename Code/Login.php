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

