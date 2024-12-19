<?php
require_once('connexion-mysql.php');
$stmt = $connexion -> prepare("SELECT * FROM livre order by dateajout desc limit 3");
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$livres = $stmt->fetchAll();
?>

<div class="container-fluid sm-3">
  <h3 class="text-center">Dernières acquisitions:</h3>
</div>

<div id="demo" class="carousel slide" data-bs-ride="carousel" style="background-color:rgb(52, 108, 190);">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>

  <div class='carousel-inner'>
    <?php foreach($livres as $id => $livre) : ?>
      <div class='carousel-item <?=$id == 0 ? "active" : ""?>'>
        <div class='d-flex justify-content-center'>
          <img src="./image/covers/<?=$livre->photo?>" alt="<?=$livre->titre?>" class="d-block" style="width:20%">
        </div>
      </div>
    <?php endforeach ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
