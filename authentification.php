<?php
    if (array_key_exists("email", $_POST) && array_key_exists("pwd", $_POST)) {
    require_once("connexion-mysql.php");
    $user = $connexion->prepare("SELECT mel, motdepasse FROM utilisateur WHERE mel = :email");
    $user->setFetchMode(PDO::FETCH_OBJ);
    $user->bindValue(":email", $_POST["email"]);
    $user->execute();

    if ($user->rowCount() > 0) {
        $resultat = $user->fetch();
        if (password_verify($_POST["pwd"], $resultat->motdepasse)) {
            session_start();
            $_SESSION["email"] = $_POST["email"];
            header("Location: " . htmlspecialchars($_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"]));
        } 
        else {
            echo "Identifiants non valide";
        }
    } 
    else {
        echo "Identifiants non valide";
    }
}
?>

<div>
  
  <?php if (array_key_exists("email", $_SESSION)) : ?>  
    <?php include("utilisateur.php");?>
  <?php else : ?>
    <h2>Se connecter:</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"]);?>" method="POST">
    <div class="mb-3 mt-3">
      <label for="email">Identifiant:</label>
      <input type="email" class="form-control" id="email" placeholder="Entrer votre mail" name="email">
    </div>
    <div class="mb-3">
      <label for="pwd">Mot de passe:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Entrer le mot de passe" name="pwd">
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
  </form>
  <?php endif ?>

</div>