
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="All.css"/>
</head>
<body>
<div id="prob"><form id="belep" action="Regist.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <fieldset id="regist" style="height: 500px">
            <legend>Regisztráció</legend>
            <label>Felhasználónév: <input type="text" name="fnev"  placeholder="Felhasználónév..." maxlength="10" class="registinput"/></label><br/>
            <label>Jelszó: <input type="password" name="pass" maxlength="10" placeholder="**********" class="registinput" /></label><br/>
            <label>Jelszó ismétlés: <input type="password" name="pass2" maxlength="10" placeholder="**********" class="registinput" /></label><br/>
            <label>Lakcím: <input type="text" name="lakcim"  class="registinput" required/></label><br/>
            <label>Születésnap: <input type="date" name="szuldatum"  class="registinput" required/></label><br/>
            <label>E-mail cím: <input type="email" name="email" placeholder="valami@gmail.com"  class="registinput"/></label><br/>
            <label>Bankkártya: <input type="text" name="email"class="registinput"/></label><br/>
            <input type="submit" name="regist" value="Regisztráció" id="registgomb">
        </fieldset>
    </form></div>
<div>
    <p id="belepszoveg">Van már fiókod?<a href="Login.php">Bejelentkezés</a><br/>
    <a href="Fooldal.php" id="vissza">Vissza</a></p>
</div>


</body>
</html>
