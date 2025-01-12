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
    $profil = $_POST["profil"];

    $stmt = $connexion->prepare("INSERT INTO utilisateur (nom, prenom, mel, motdepasse, profil) VALUES (:nom, :prenom, :email, :motdepasse, :profil)");
    $stmt->bindValue(":nom", $nom);
    $stmt->bindValue(":prenom", $prenom);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":motdepasse", $motdepasse);
    $stmt->bindValue(":profil", $profil);
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
    <label for="profil">Profil (user/admin) :</label>
    <select id="profil" name="profil">
        <option value="user">Utilisateur</option>
        <option value="admin">Administrateur</option>
    </select>
    <br><br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
