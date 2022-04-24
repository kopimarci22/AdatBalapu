<?php

$conn = oci_connect('GERGOO', 'asd123','localhost/XE');
if(!$conn){

    $e=oci_error();
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$query='SELECT * FROM ADMIN';
$stid= oci_parse($conn, $query);
$felhasznal=oci_parse($conn,'SELECT * FROM FELHASZNALO');

if (!$stid){
    $e=oci_error($conn);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

$r = oci_execute($stid);
$l = oci_execute($felhasznal);

if (!$r){
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
while($record = oci_fetch_array($stid,OCI_RETURN_NULLS+OCI_ASSOC)){
    echo sprintf('<p>%s: %s</p>',$record['ADMIN_NEV'],$record['ADMIN_JELSZO']);
}
while($record2 = oci_fetch_array($felhasznal,OCI_RETURN_NULLS+OCI_BOTH)){
    echo sprintf('<p>%s: : %s :: %s :: %s :: %s :: %s :: %s :</p>',$record2['FEL_NEV'],$record2['JELSZO'],$record2['NEV'],$record2['LAKCIM'],$record2['SZUL_DATUM'],$record2['EMAIL'],$record2['BANKKARTYA'],$record2['FEL_NEV'],$record2['JELSZO']);
}
while($record3 = oci_fetch_array($felhasznal,OCI_RETURN_NULLS+OCI_BOTH)){
    echo sprintf('<p>%s</p>',$record3['FEL_NEV']);
}
oci_free_statement($stid);
oci_close($conn);