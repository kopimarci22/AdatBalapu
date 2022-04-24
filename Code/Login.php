<?php session_start(); ?>
<?php
include "databaseConnection.php";
$con = DBconnection::getInstance();//connection string
if (!$con->getConnection()) {
    $m = oci_error();
    echo $m['message'], "\n";
}
$query = "select fel_nev, jelszo from user where fel_nev = :username and jelszo= :password";
$stid = oci_parse($con->getConnection(), $query);

if (isset($_POST['username']) && isset($_POST['password'])) {
        echo $query;
    $username = $_POST['username'];
    $password = $_POST['password'];
    oci_bind_by_name($stid, ":username", $username);
    oci_bind_by_name($stid, ":password", $password);
    oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC);
    if ($row = 1) {
        $_SESSION['username'] = $username;
        header("Location: Fooldal.php");
    } else {
        echo "Wrong username or password";
    }
    oci_free_statement($stid);
    oci_close($con->getConnection());

}

?>

