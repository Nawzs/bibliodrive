<?php
    if (array_key_exists("email", $_SESSION)) {
        require_once("connexion-mysql.php");
        $user = $connexion->prepare("SELECT mel, nom, prenom, adresse, ville, codepostal, profil FROM utilisateur WHERE mel = :email");
        $user->setFetchMode(PDO::FETCH_OBJ);
        $user->bindValue(":email", $_SESSION["email"]);
        $user->execute();
        $resultat = $user->fetch();
    }
?>

<div>
    <?php if ($resultat->profil == "admin") : ?>
        <h2>Profil administrateur</h2>
    <?php endif?>
    <p>Profil de: <?=$resultat->prenom?> <?=$resultat->nom?></p>
    <p><?=$resultat->mel?></p>
    <?php if ($resultat->profil != "admin") : ?>
        <p><?=$resultat->adresse?>, <?=$resultat->ville?>, <?=$resultat->codepostal?></p>
    <?php endif?>
    <form action="deconnexion.php" method="POST">
      <button type="submit" class="btn btn-primary">Déconnexion</button> 
    </form>
</div>