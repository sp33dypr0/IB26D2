<?php

    if(isset($_POST['nev']) && isset($_POST['email']) && isset($_POST['szoveg'])) {
        try {
            // Kapcsolódás
            $dbh = new PDO('mysql:host=localhost;dbname=labor7', 'root', '',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
			
			if(!isset($_POST['nev']) || strlen($_POST['nev']) < 5)
				{
			exit("Hibás név: ".$_POST['nev']);
			}

			$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
			if(!isset($_POST['email']) || !preg_match($re,$_POST['email']))
				{
			exit("Hibás email: ".$_POST['email']);
			}

			if(!isset($_POST['szoveg']) || empty($_POST['szoveg']))
			{
			exit("Hibás szöveg: ".$_POST['szoveg']);
			}

                $sqlInsert = "insert into kapcsolat(id, nev, email, szoveg)
                              values(0, :nev, :email, :szoveg)";
                $stmt = $dbh->prepare($sqlInsert); 
                $stmt->execute(array(':nev' => $_POST['nev'], ':email' => $_POST['email'],
                                     ':szoveg' => $_POST['szoveg'])); 
                if($count = $stmt->rowCount()) {
                    $newid = $dbh->lastInsertId();
                    //$uzenet = "Sikeres üzenetküldés, azonosítója: {$newid} ";
                    //$newid = file_get_contents('./../../index.php?oldal=uzenet');                   
                    //$ujra = false;
                    //$_POST['nev'] = file_get_contents('./../../index.php?oldal=uzenet');

            }
        }
        catch (PDOException $e) {
            echo "Hiba: ".$e->getMessage();
        }
        //$_POST['nev'] = file_get_contents('./../../index.php?oldal=uzenet&newid='.$newid');
        header("Location: ./../../index.php?oldal=uzenet&newid=".$newid);   
    }