<?php
session_start();
//var_dump($row['ID']);
var_dump($_SESSION);

include "databaseconn.php";
$connection = DBconnection::getInstance();

if(isset($_POST['name'])){

    echo"az if j�";

    $itemname =     $_POST['name'];
    $price =        $_POST['ar'];
    $quantity =     $_POST['amount'];
    $felhasznalo =  $_SESSION['username'];


    $query = "INSERT INTO KOSAR(k_id, fel_nev, idopont, nev, ar, k_db_szam, check_) VALUES (dbms_random.value(100,999),:felhasznalo, SYSDATE , :itemname,:price, :quantity, DEFAULT)";

    $res = oci_parse($connection->getConnection(), $query);

    oci_bind_by_name($res, ':itemname', $itemname);
    oci_bind_by_name($res, ':felhasznalo', $felhasznalo);
    oci_bind_by_name($res, ':quantity', $quantity);
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