<?php
    $MAPPA = './templates/pages/kepek/';
    $TIPUSOK = array ('.jpg', '.png');
    $MEDIATIPUSOK = array('image/jpeg', 'image/png');
    $DATUMFORMA = "Y.m.d. H:i";
    $MAXMERET = 500*1024;
    $uzenet = array();   

// Űrlap ellenőrzés:
if (isset($_SESSION['login'])) {
if (isset($_POST['kuld'])) {
    //print_r($_FILES);
    foreach($_FILES as $fajl) {
        if ($fajl['error'] == 4);   // Nem töltött fel fájlt
        elseif (!in_array($fajl['type'], $MEDIATIPUSOK))
            $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
        elseif ($fajl['error'] == 1   // A fájl túllépi a php.ini -ben megadott maximális méretet
                    or $fajl['error'] == 2   // A fájl túllépi a HTML űrlapban megadott maximális méretet
                    or $fajl['size'] > $MAXMERET) 
            $uzenet[] = " Túl nagy állomány: " . $fajl['name'];
        else {
            $vegsohely = $MAPPA.strtolower($fajl['name']);
            if (file_exists($vegsohely))
                $uzenet[] = " Már létezik: " . $fajl['name'];
            else {
                move_uploaded_file($fajl['tmp_name'], $vegsohely);
                $uzenet[] = ' Ok: ' . $fajl['name'];
            }
        }
    }        
}
} else {
    $uzenet[] = "Figyelem! Képfeltöltés csak bejelentkezés után lehetséges.";
}

// Megjelenítés logika:
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Galéria</title>
<style type="text/css">
    label { display: block; }
</style>
</head>
<body>
<h3>Fénykép feltöltése:</h3>
<?php
if (!empty($uzenet))
{
    echo '<ul>';
    foreach($uzenet as $u)
        echo "<li>$u</li>";
    echo '</ul>';
}
?>
<form action="?oldal=feltoltes" method="post"
            enctype="multipart/form-data">
    <label>Első:
        <input type="file" name="elso" required>
    </label>
    <label>Második:
        <input type="file" name="masodik">
    </label>
    <label>Harmadik:
        <input type="file" name="harmadik">
    </label>        
    <input type="submit" name="kuld">
  </form>    
</body>
</html>
