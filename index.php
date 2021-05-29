<?php

require_once('includes/init.php') ;

$title= 'Accueil';
require_once ('includes/haut.php');
?>
<div id="carouselExampleControls" class="carousel slide carousel-fade taille_carousel" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu1.jpg" class="d-block w-100 " alt="immobilier">
    </div>
    <div class="carousel-item">
      <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu2.jpg" class="d-block w-100 " alt="Auto/Moto">
    </div>
    <div class="carousel-item">
      <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu1.jpg" class="d-block w-100" alt="Annonces">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container text-center text-info"><h1>Votre site d'Annonce</h1></div>

<div class="container">
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu1_sm.jpg" class="card-img" alt="Immobilier">
            <div class="card-img-overlay">
                <h4 class="card-title titre fw-bold">Immobilier</h4>
                <p class="card-text position-absolute bottom-0 fs-5 fw-bold"><?php echo $nbannonceImmo ?? '' ?>Annonces immobilières <br> ventes locations appartements maisons  </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu2_sm.jpg" class="card-img" alt="Auto/Moto">
            <div class="card-img-overlay">
                <h4 class="card-title titre fw-bold">Auto/Moto</h4>
                <p class="card-text position-absolute bottom-0 fs-5 fw-bold"><?php echo $nbannonceAuto ?? '' ?>Annonces Auto/Moto <br> Achats ventes de voitures et deux roues d'occasions</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu3_sm.jpg" class="card-img" alt="Immobilier">
            <div class="card-img-overlay">
                <h4 class="card-title titre fw-bold">EMPLOI</h4>
                <p class="card-text position-absolute bottom-0 fs-5 fw-bold"><?php echo $nbannoncejob ?? '' ?>Offres d'emploi </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu4_sm.jpg" class="card-img" alt="Immobilier">
            <div class="card-img-overlay">
                <h4 class="card-title titre fw-bold">VACANCES</h4>
                <p class="card-text position-absolute bottom-0 fs-5 fw-bold"><?php echo $nbannonceVacances ?? '' ?>Annonces locations vacances<br> Appartement Studio Villa Camping-car  </p>
            </div>
        </div>
    </div>
  </div>
</div>

<?php
require_once('includes/footer.php');