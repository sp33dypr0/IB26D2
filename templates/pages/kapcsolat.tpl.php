<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./styles/kapcsolat.css">
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
    <h3>Kapcsolat</h3>
    <form name="kapcsolat" action="./templates/php/kapcsolat.php" method="post">
        <div id="kapcs">
            <label><input type="text" id="nev" name="nev" size="20" placeholder="Név (min. 5 karakter)" maxlength="40"></label>
            <br/>
            <label><input type="text" id="email" name="email" size="30" placeholder="E-mail (kötelező)" maxlength="40"></label>
            <br/>
            <label> <textarea id="szoveg" name="szoveg" cols="40" rows="10" placeholder="Ide írja be az üzenetét (kötelező)"></textarea></label>
            <br/>
            <input id="kuld" type="submit" value="Küld">
            <button onclick="ellenoriz();" type="button">Ellenőriz</button>
        </div>
    </form>
</body>
</html>
