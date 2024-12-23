<?php
include("entete.html");
?> 

<div class= 'row p-5' >
    <div class = "col-sm-9">
        <?php
            if (array_key_exists("nolivre", $_GET) && ctype_digit($_GET["nolivre"])) {
                require_once("connexion-mysql.php");
                $livre = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON auteur.noauteur = livre.noauteur WHERE nolivre = :recherche");
                $livre->setFetchMode(PDO::FETCH_OBJ);
                $livre->bindValue(":recherche", $_GET["nolivre"]);
                $livre->execute();

                if ($livre->rowCount() > 0) {
                    $resultat = $livre->fetch();
                } 
                else {
                    echo "Aucun livre trouvé";
                }
            }

            else {
                echo "Aucun livre sélectionné";
            }
        ?>

        <?php if ($resultat):?>
            <div class= 'row'> 
                <div class = "col-sm-9">
                    <p>Auteur : <?=$resultat->nom?> <?=$resultat->prenom?> </p>
                    <p>ISBN 13 : <?=$resultat->isbn13?></p>
                    <p>Résumé du livre:</p>
                    <p><?=$resultat->detail?></p>
                </div>
                <img src="./image/covers/<?=$resultat->photo?>" alt="<?=$resultat->titre?>" class="col-sm-3">                    
            </div>  
        <?php endif ?>

    </div> 

    <div class = "col-sm-3">
        <?php include("authentification.php"); ?>
    </div>
</div>