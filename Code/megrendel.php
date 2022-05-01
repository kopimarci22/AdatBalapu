<?php
var_dump($_POST);
session_start();
include "dbconn.php";
$connection = DBconnection::getInstance();

if(isset($_POST['finish'])){

    echo"az if j�";

    $price =        $_POST['vegosszeg'];
    $felhasznalo =  $_SESSION['username'];

    $query = "INSERT INTO MEGRENDELES(m_id, fel_nev, datum, k_ar, allapot) VALUES (dbms_random.value(100,999), :felhasznalo, SYSDATE, :price, DEFAULT)";

    $res = oci_parse($connection->getConnection(), $query);

    oci_bind_by_name($res, ':felhasznalo', $felhasznalo);
    oci_bind_by_name($res, ':price', $price);

    if(oci_execute($res)===false){
        var_dump(oci_error($res));
    }else{
        //oci_commit($connection->getConnection());
        echo "Sikeres felvitel";

        header("Location: Kosar.php");
    }
}

?>
