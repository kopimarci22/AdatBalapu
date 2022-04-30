<?php
session_start();
include "databaseconn.php";

$user=$_SESSION['username'];
$darab = $_POST['amount'];
$name = $_POST['name'];
$ar = $_POST['ar'];

$querry = "INSERT INTO KOSAR VALUES (:user, SYSDATE, :ar, :darab, )";
