<?php
    include("entete.html");
    session_start();
?> 

<div class= 'row'>
    <div class = "col-sm-9">
        <?php
        require_once("connexion-mysql.php");
        if ($_GET["recherche"]) 
            {
                $recherche = $_GET["recherche"];
                $livre = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON auteur.noauteur = livre.noauteur WHERE auteur.nom = :recherche");
                $livre->setFetchMode(PDO::FETCH_OBJ);
                $livre->bindValue(":recherche", $recherche);
                $livre->execute();
                
                while ($affiche = $livre->fetch())  {
                    $nolivre = $affiche->nolivre;
                    echo "<a href='details.php?nolivre=$nolivre'><p>$affiche->titre ($affiche->anneeparution)</p></a>";
                };
            };
        ?>
    </div>
    <div class = "col-sm-3">
        <?php include("authentification.php"); ?>
    </div> 
</div>