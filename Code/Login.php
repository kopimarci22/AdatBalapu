<?php

?>
<!DOCTYPE HTML>
<html lang="hu">
<head>
    <title>KiPa bejelentkezés</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
<header><i>KiPa</i> bejelentkezés</header>
<div class="content">
    <form action="../script/php/handleLogin.php" method="post">
        <h2>Bejelentkezés</h2>
        <input type="text" name="userEmail" placeholder="Email"><br>
        <input type="password" name="password" placeholder="jelszó"><br>
        <input type="submit" value="Bejelentkezés">
        <label>Admin</label><input type="checkbox" name="adminSelect" value="admin">
    </form>
    <a href="regisztracio.html">Még nincs fiókja?</a>
</div>
<footer>Kopanecz Márton és Kiss Máté honlapja</footer>
</body>
</html>
