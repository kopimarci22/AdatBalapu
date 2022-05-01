<?php

$conn = oci_connect('DAVID', 'asd123','localhost/XE');
if(!$conn){

    $e=oci_error();
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$query='SELECT * FROM FElHASZNALO';
$stid= oci_parse($conn, $query);



if (!$stid){
    $e=oci_error($conn);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}

$r = oci_execute($stid);
if(!$r){
    $e=oci_error($stid);
    trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}


?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="All.css"/>
</head>
<body>
<div class="prob"><form id="belep" action="Regist.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <fieldset id="regist" style="height: 500px">
            <legend>Regisztráció</legend>
            <label>Felhasználónév: <input type="text" name="fnev"  placeholder="Felhasználónév..." maxlength="10" class="registinput"/></label><br/>
            <label>Jelszó: <input type="password" name="pass" maxlength="10" placeholder="**********" class="registinput" /></label><br/>
            <label>Jelszó ismétlés: <input type="password" name="pass2" maxlength="10" placeholder="**********" class="registinput" /></label><br/>
            <label>Név: <input type="text" name="name"  class="registinput" /></label><br/>
            <label>Lakcím: <input type="text" name="lakcim"  class="registinput" required/></label><br/>
            <label>Születésnap: <input type="date" name="szuldatum"  class="registinput" required/></label><br/>
            <label>E-mail cím: <input type="email" name="email" placeholder="valami@gmail.com"  class="registinput"/></label><br/>
            <label>Bankkártya: <input type="text" name="bank" class="registinput"/></label><br/>
            <input type="submit" name="regist" value="Regisztráció" id="registgomb">

        </fieldset>
    </form></div>
<div class="prob">
    <p id="belepszoveg">Van már fiókod?<a href="Login.php">Bejelentkezés</a><br/>
        <a href="Fooldal.php" id="vissza">Vissza</a></p>
</div><?php
$felhasznalo = "";
$password = "";
$pass2 = "";
$nev = "";
$lakcim = "";
$age = "";
$email = "";
$bankkartya = "";

$errors=[];

if (isset($_POST["regist"])) {

    $felhasznalo = $_POST["fnev"];
    $password = $_POST["pass"];
    $pass2=$_POST["pass2"];
    $nev = $_POST["name"];
    $lakcim = $_POST["lakcim"];
    $age = $_POST["szuldatum"];
    $email = $_POST["email"];
    $bankkartya = $_POST["bank"];
    while(($row = oci_fetch_array($stid, OCI_BOTH)) != false){
        if ($row["FEL_NEV"] === $felhasznalo){
            $errors[]="A felhasználónév már foglalt";
        }
    }
    if (strlen($password)<6){
        $errors[]="A jelszó túl rövid";
    }
    if (!preg_match('/[A-Za-z]/',$password) || !preg_match('/[0-9]/',$password)){
        $errors[]="A jelszónak tartalmaznia kell betűt és számjegyet egyaránt!";
    }
    $age2 = date_diff(date_create($age), date_create('now'))->y;
    if ($age2<18){
        $errors[]="Az életkor nem megfelelő";
    }
    while(($row = oci_fetch_array($stid, OCI_BOTH)) != false){
        if ($row["EMAIL"] === $email){
            $errors[]="Az email-cím már foglalt";
        }
    }
    if ($password !== $pass2) {
        $errors[] = "A jelszó és az ellenőrző jelszó nem egyezik!";
    }
    if (empty($felhasznalo)){
        $errors[]="Felhasználónév kötelező";
    }
    if (empty($password)){
        $errors[]="Jelszó kötelező";
    }
    if (empty($pass2)){
        $errors[]="Megerősítő jelszó kötelező";
    }
    if (empty($email)){
        $errors[]="Email cím kötelező";
    }

    //adatai beírása az adatbázisba
    if (empty($errors)){

        $sql = "INSERT INTO FELHASZNALO (fel_nev, jelszo, nev , lakcim, szul_datum, email, bankkartya) VALUES (:felhasznalo, :password , :nev , :lakcim, :age, :email, :bankkartya)";
        $stid3 = oci_parse($conn, $sql);
        oci_bind_by_name( $stid3 , ":felhasznalo", $felhasznalo);
        oci_bind_by_name( $stid3 , ":password", $password);
        oci_bind_by_name( $stid3 , ":nev", $nev);
        oci_bind_by_name( $stid3 , ":lakcim", $lakcim);
        oci_bind_by_name( $stid3 , ":age", $age);
        oci_bind_by_name( $stid3 , ":email", $email);
        oci_bind_by_name( $stid3 , ":bankkartya", $bankkartya);
        if (!$stid3){
            $e=oci_error($conn);
            trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
        }
        $k=oci_execute($stid3);
        if(!$k){
            $e=oci_error($stid3);
            trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
        }
        oci_free_statement($stid);
        oci_free_statement($stid3);
        oci_close($conn);
        header("Location: Login.php");
    }   else{
        foreach ($errors as $error){
            echo $error ."<br>";
        }
    }

    ?>

    <div class="kiiras" style="margin: 0 auto; color: red;font-size: 40px;text-align: center"><?php
    ?></div><?php
}
?>


</body>
</html>