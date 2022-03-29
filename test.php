<?php

$conn = oci_connect('DAVID', 'asd123','localhost/XE');
if(!$conn){

    $e=oci_error();
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$query='SELECT * FROM admin';
$stid= oci_parse($conn, $query);
if (!$stid){
    $e=oci_error($conn);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

$r = oci_execute($stid);
if (!$r){
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
echo"hell2o";
while($record = oci_fetch_array($stid,OCI_RETURN_NULLS+OCI_ASSOC)){
    echo "hello";
    echo sprintf('<p>%s: %s</p>',$record['admin_nev'],$record['admin_jelszo']);
}
echo'psa';
oci_free_statement($stid);
oci_close($conn);