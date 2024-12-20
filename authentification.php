<!DOCTYPE html>
<html lang="en">
<head>
  <title>Formulaire</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div>
  <h2>Se connecter:</h2>
  <form action="/action_page.php">
    <div class="mb-3 mt-3">
      <label for="email">Identifiant:</label>
      <input type="email" class="form-control" id="email" placeholder="Entrer votre mail" name="email">
    </div>
    <div class="mb-3">
      <label for="pwd">Mot de passe:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Entrer le mot de passe" name="pswd">
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
  </form>
</div>

</body>
</html>
