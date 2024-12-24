<?php 
    session_start();
    if (array_key_exists("email", $_SESSION) && array_key_exists("nolivre", $_GET)) {
        echo $_SESSION["email"];
        echo $_GET["nolivre"];
        include("connexion-mysql.php");
        $emprunt = $connexion->prepare ("SELECT * FROM emprunter WHERE mel = :email AND nolivre = :nolivre AND dateretour IS NULL" );
        $emprunt->setFetchMode(PDO::FETCH_OBJ); 
        $emprunt->bindValue(":email", $_SESSION["email"]);
        $emprunt->bindValue(":nolivre", $_GET["nolivre"]);
        $emprunt->execute();
        $resultat = $emprunt->fetch();
        print_r($resultat);
        if ($resultat) {
            header("Location: details.php?nolivre=" . $_GET["nolivre"]);
        }
        else {
            $emprunt = $connexion->prepare ("INSERT INTO emprunter (mel, nolivre, dateemprunt) VALUES (:email, :nolivre, NOW())");
            $emprunt->bindValue(":email", $_SESSION["email"]);
            $emprunt->bindValue(":nolivre", $_GET["nolivre"]);
            $emprunt->execute();
            header("Location: details.php?nolivre=" . $_GET["nolivre"]);
        }
    }
    else {
        header("Location: accueil.php");
    }
?>