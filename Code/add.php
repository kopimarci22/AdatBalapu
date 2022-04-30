<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SparTa</title>
    <link rel="stylesheet" href="All.css"/>

</head>
<style>

</style>
<body>

<?php
session_start();
include "databaseconn.php";
$conn = DBconnection::getInstance();

$stid2 = oci_parse($conn->getConnection(), 'SELECT * FROM KATEGORIA');
if(!$stid2) {
    $e = oci_error($conn->getConnection(), $stid2);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$r = oci_execute($stid2);
if(!$r){
    $e = oci_error($stid2);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>

<div class="container" style="padding-top: 1cm;">
    <h1 class="text-center" ">Termék felvitele</h1>


    <form method="POST" action="feltoltes.php" accept-charset="utf-8">
        <div class="form-group">
            <label for="itemid">Termékkód</label>
            <input type="text" name="itemid" class="form-control" id="itemid" placeholder="Termékkód">
        </div>
        <div class="form-group">
            <label for="price">Ár</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Ár">
        </div>
        <div class="form-group">
            <label for="itemname">Név</label>
            <input type="text" name="itemname" class="form-control" id="itemname" placeholder="Név">
        </div>

        <div class="form-group">
            <label for="amount">Darabszám</label>
            <input type="number" name="amount" class="form-control" id="amount" placeholder="Darabszám">
        </div>
        <div class="form-group">
            <label for="id">Kategória</label><br>
            <?php
            echo "<select name='category'>";
            while($row = oci_fetch_array($stid2))
            {
                echo "'<option name='category' id='category'> $row[KATEGORIA] </option>'";
            }
            echo "</select>";
            oci_free_statement($stid2);
            ?>

        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-outline-dark" value="Mentés"></input>
            <a href="Aruk.php">Aruk</a>
        </div>
    </form>
</div>

</body>
</html>