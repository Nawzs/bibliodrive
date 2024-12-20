<div class= 'col-8'>

<?php
include("entete.html");
?> 

<?php
require_once("connexion-mysql.php");
if ($_GET["recherche"]) {
    $recherche = $_GET["recherche"];

    $livre = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON auteur.noauteur = livre.noauteur WHERE auteur.nom = :recherche");

    $livre->setFetchMode(PDO::FETCH_OBJ);
    $livre->bindValue(":recherche", $recherche);
    $livre->execute();


    while ($affiche = $livre->fetch())  {
        $nolivre = $affiche->nolivre;
        echo "<a href='description.php?nlivre=?nolivre'><p>$affiche->titre ($affiche->anneeparution)</p><a/>";
    };

};
    ?>