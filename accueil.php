<?php
  include("entete.html"); 
  session_start();
?>

<div class = row>
<div class = "col-sm-9">
  <?php
    include("carousel.php"); 
  ?>
</div>

<div class = "col-sm-3">
<?php include("authentification.php"); ?>
</div>