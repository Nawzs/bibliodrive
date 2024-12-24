<br>
<?php
  include("entete.html"); 
  session_start();
?>

<?php
  require_once("connexion-mysql.php");
  $stmt = $connexion->prepare("SELECT * FROM utilisateur");
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  //  Les résultats retournés par la requête seront traités en 'mode' objet
  $stmt->execute();
  //  Parcours des utilisateur retournés par la requête : premier, deuxième…
    while($utilisateur = $stmt->fetch())
      {
        //  Affichage des champs nom et prenom de la table 'utilisateur'
        // echo '<h1>', $utilisateur->nom, ' ', $utilisateur->prenom,' ', $utilisateur->motdepasse,'</h1>';
      }
?>

</div>
<br>
<br>
<div class = row>
<div class = "col-sm-9">

 
<?php
  // si btnRechercher est set 
  //alors include lister les bouquins.php
  //sinon 
  include("carousel.php"); 
?>

</div>
<br>
<br>
<div class = "col-sm-3">
  <br>
  <br>
<?php include("authentification.php"); ?>
</div>