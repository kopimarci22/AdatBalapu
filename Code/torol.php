<?php
session_start();
var_dump($_POST['id']);



include "databaseconn.php";
$connection = DBconnection::getInstance();

if(isset($_POST['delete'])){

    echo"az if j�";

    $itemid =$_POST['k_id'];

    $query = "DELETE FROM KOSAR WHERE K_ID=:itemid";

    $res = oci_parse($connection->getConnection(), $query);

    oci_bind_by_name($res, ':itemid', $itemid);


    if(oci_execute($res)===false){
        var_dump(oci_error($res));
    }else{
        //oci_commit($connection->getConnection());
        echo "Sikeres törlés";
        header("Location: Kosar.php");
    }
}

?>


