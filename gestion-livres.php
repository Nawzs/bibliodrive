<?php
include("entete.html");
session_start();

if (!array_key_exists("email", $_SESSION)) {
    header("Location: accueil.php");
    exit;
}

// Vérifier si l'utilisateur est admin
require_once("connexion-mysql.php");
$user = $connexion->prepare("SELECT profil FROM utilisateur WHERE mel = :email");
$user->setFetchMode(PDO::FETCH_OBJ);
$user->bindValue(":email", $_SESSION["email"]);
$user->execute();
$resultat = $user->fetch();

if ($resultat->profil != "admin") {
    echo "Accès interdit.";
    exit;
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $isbn = $_POST["isbn"];
    $auteur = $_POST["auteur"];
    $annee = $_POST["annee"];
    $photo = $_POST["photo"];

    $stmt = $connexion->prepare("INSERT INTO livre (titre, isbn13, noauteur, anneeparution, photo) VALUES (:titre, :isbn, :auteur, :annee, :photo)");
    $stmt->bindValue(":titre", $titre);
    $stmt->bindValue(":isbn", $isbn);
    $stmt->bindValue(":auteur", $auteur);
    $stmt->bindValue(":annee", $annee);
    $stmt->bindValue(":photo", $photo);
    $stmt->execute();

    echo "Livre ajouté avec succès.";
}
?>

<h2>Ajouter un livre</h2>
<form action="gestion-livres.php" method="POST">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required>
    <br>
    <label for="isbn">ISBN 13 :</label>
    <input type="text" id="isbn" name="isbn" required>
    <br>
    <label for="auteur">ID Auteur :</label>
    <input type="number" id="auteur" name="auteur" required>
    <br>
    <label for="annee">Année de parution :</label>
    <input type="number" id="annee" name="annee" required>
    <br>
    <label for="photo">Nom du fichier photo :</label>
    <input type="text" id="photo" name="photo" required>
    <br><br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
