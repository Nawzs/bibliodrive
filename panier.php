<?php include("entete.html"); ?>

<?php
session_start();

if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nolivre"]) && isset($_POST["titre"])) {
    $livre = [
        "nolivre" => $_POST["nolivre"],
        "titre" => $_POST["titre"]
    ];

    // Ajouter le livre au panier
    $_SESSION["panier"][] = $livre;

    header("Location: panier.php");
    exit();
}

if (isset($_GET["action"]) && $_GET["action"] === "supprimer" && isset($_GET["index"])) {
    $index = $_GET["index"];
    if (isset($_SESSION["panier"][$index])) {
        unset($_SESSION["panier"][$index]);
        $_SESSION["panier"] = array_values($_SESSION["panier"]); 
    }

    header("Location: panier.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mon Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Mon Panier</h1>
        <?php if (empty($_SESSION["panier"])): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Titre</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION["panier"] as $index => $livre): ?>
                        <tr>
                            <td><?= $livre["nolivre"] ?></td>
                            <td><?= htmlspecialchars($livre["titre"]) ?></td>
                            <td>
                                <a href="panier.php?action=supprimer&index=<?= $index ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
        <a href="accueil.php" class="btn btn-primary">Continuer les achats</a>
    </div>
</body>
</html>


