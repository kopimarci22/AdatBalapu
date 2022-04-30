<?php
session_start();
var_dump($_SESSION);
include "dbconn.php";
$connection = DBconnection::getInstance();
var_dump($_POST);
if(isset($_POST['komm_create'])){
    var_dump($_POST);
    echo"az if jó";

    $item = $_POST['item'];
    $what = $_POST['komment'];
    $username = $_SESSION['username'];

    $query = "INSERT INTO KOMMENT(Azon, nev, komment, fel_nev) VALUES (dbms_random.value(100000,999999), :item, :what, :username)";

    $res = oci_parse($connection->getConnection(), $query);

    oci_bind_by_name($res, ':item', $item);
    oci_bind_by_name($res, ':what', $what);
    oci_bind_by_name($res, ':username', $username);


    if(oci_execute($res)===false){
        var_dump(oci_error($res));
    }else{
        //oci_commit($connection->getConnection());
        echo "Sikeres felvitel";

    }
}
?>

