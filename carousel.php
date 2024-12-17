<!DOCTYPE html>
<html lang="en">
<head>
  <title>Carousel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:rgb(52, 108, 190);">

  <div class="container-fluid sm-3">
    <h3 class="text-center">Dernières acquisitions:</h3>
  </div>  

<div id="demo" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  <?php
  require_once('connexion-mysql.php');
  $stmt = $connexion -> prepare("SELECT * FROM livre order by dateajout desc limit 3");
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt->execute();
  $enregistrement = $stmt->fetch();
  echo "<div class='carousel-inner'>
  <div class='carousel-item active'>
  <div class='d-flex justify-content-center'>
        <img href='lister-livres.php' src=./image/covers/$enregistrement->photo alt='$enregistrement->titre'class='d-block' style='width:20%'>
    </div> </div>";
  $enregistrement = $stmt->fetch();
  echo "<div class='carousel-item'>
  <div class='d-flex justify-content-center'>
          <img href='lister-livres.php' src=./image/covers/$enregistrement->photo alt='$enregistrement->titre'class='d-block' style='width:20%'>
      </div> </div>";
  $enregistrement = $stmt->fetch();
  echo "<div class='carousel-item'>
  <div class='d-flex justify-content-center'>
            <img href='lister-livres.php' src=./image/covers/$enregistrement->photo alt='$enregistrement->titre'class='d-block' style='width:20%'>
        </div> </div> </div>";

  ?>

  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

</body>
</html>
