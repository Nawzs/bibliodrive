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
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];

    $stmt = $connexion->prepare("INSERT INTO auteur (nom, prenom) VALUES (:nom, :prenom)");
    $stmt->bindValue(":nom", $nom);
    $stmt->bindValue(":prenom", $prenom);
    $stmt->execute();

    echo "Auteur ajouté avec succès.";
}
?>

<h2>Ajouter un auteur</h2>
<form action="gestion-auteur.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <br>
    <label for="prenom">Prenom :</label>
    <input type="text" id="prenom" name="prenom" required>
    <br><br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>