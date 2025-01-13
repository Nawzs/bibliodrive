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
    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];
    $adresse = $_POST["adresse"];
    $ville = $_POST["ville"];
    $codepostal = $_POST["codepsotal"];

    $stmt = $connexion->prepare("INSERT INTO utilisateur (nom, prenom, mel, motdepasse, adresse, ville, codepostal) VALUES (:nom, :prenom, :email, :motdepasse, :adresse, :ville, :codepostal)");
    $stmt->bindValue(":nom", $nom);
    $stmt->bindValue(":prenom", $prenom);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":motdepasse", $motdepasse);
    $stmt->bindValue(":adresse", $adresse);
    $stmt->bindValue(":ville", $ville);
    $stmt->bindValue(":codepostal", $codepostal);
    $stmt->execute();

    echo "Membre ajouté avec succès.";
}
?>

<h2>Ajouter un membre</h2>
<form action="gestion-membres.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <br>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="motdepasse">Mot de passe :</label>
    <input type="password" id="motdepasse" name="motdepasse" required>
    <br>
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" required>
    <br>
    <label for="ville">Ville :</label>
    <input type="text" id="ville" name="ville" required>
    <br>
    <label for="codepostal">Code postal :</label>
    <input type="text" id="codepostal" name="codepostal" required>
    <br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>