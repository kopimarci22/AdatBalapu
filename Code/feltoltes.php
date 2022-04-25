<?php
session_start();
include "databaseconn.php";
$connection = DBconnection::getInstance();
var_dump($_POST);
if(isset($_POST['itemid'])){
    var_dump($_POST);

    $itemid = $_POST['itemid'];
    $price = $_POST['price'];
    $itemname = $_POST['itemname'];
    $amount = $_POST['amount'];
    $kategoria = $_POST['category'];

    $query = "INSERT INTO TERMEK(t_kod, ar, nev, db_szam, kategoria) VALUES (:itemid, :price, :itemname, :amount, :category)";

    $res = oci_parse($connection->getConnection(), $query);

    oci_bind_by_name($res, ':itemid', $itemid);
    oci_bind_by_name($res, ':price', $price);
    oci_bind_by_name($res, ':itemname', $itemname);
    oci_bind_by_name($res, ':amount', $amount);
    oci_bind_by_name($res, ':category', $kategoria);

    echo $itemid;
    if(oci_execute($res)===false){
        var_dump(oci_error($res));
    }else{
        //oci_commit($connection->getConnection());
        echo "Sikeres felvitel";

    }
}
?>