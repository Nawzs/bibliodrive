<?php
include("entete.html");
session_start();
?> 

<div class= 'row p-5' >
    <div class = "col-sm-9">
        <?php
            if (array_key_exists("nolivre", $_GET) && ctype_digit($_GET["nolivre"])) {
                require_once("connexion-mysql.php");
                $livre = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON auteur.noauteur = livre.noauteur LEFT JOIN emprunter ON emprunter.nolivre = livre.nolivre AND emprunter.dateretour IS NULL WHERE livre.nolivre = :recherche ");
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
                    
                    <?php if (array_key_exists("email", $_SESSION)) : ?>
                <?php if (empty($resultat->dateretour) && empty($resultat->dateemprunt)) : ?>
                    <form action="panier.php" method="POST">
                        <input type="hidden" name="nolivre" value="<?=$resultat->nolivre?>">
                        <input type="hidden" name="titre" value="<?=$resultat->titre?>">
                        <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                    </form>
                    <p>Disponible</p>
                <?php else : ?>
                    <p>Indisponible</p>
                <?php endif ?>
            <?php else : ?>
                <p>Veuillez vous connecter pour ajouter au panier.</p>
            <?php endif ?>
        </div>
        <img src="./image/covers/<?=$resultat->photo?>" alt="<?=$resultat->titre?>" class="col-sm-3">                    
    </div>
<?php endif ?>

    </div> 

    <div class = "col-sm-3">
        <?php include("authentification.php"); ?>
    </div>
</div>