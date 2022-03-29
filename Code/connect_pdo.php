<?php
$tns = "
(DESCRIPTION = 
    (ADDRESS_LIST =
        (ADDRESS = (PROTOCOL = TCP) (HOST = localhost) (PORT = 1521))
    )
    (CONNECT_DATA = 
        (SERVICE_NAME = xe)
    )
 )";
$db_username = "DAVID";
$db_password = "asd123";
$db = "oci:dbname=".$tns;
$conn = new PDO($db,$db_username,$db_password);
$conn->setAttribute(PDO::ATTR_CASE,PDO::CASE_LOWER);
$stmt = $conn->prepare("select * from Admin");
$result= $stmt->execute();

if ($result){
    echo"mama";
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $item) {
        echo "szia";
        echo sprintf('<p>%s:  %s</p>',$item['ADMIN_NEV'],$item['ADMIN_JELSZO']);


    }
}