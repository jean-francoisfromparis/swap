<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"/>


  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
 <!-- css principal -->
 <link rel="stylesheet" href="./css/style.css">
 
  <title>SWAP</title>
  </head>
  <body>
  <header>

    <!-- Navbar administrateur Gestion du back-office -->
<nav class="navbar navbar-expand-lg navbar-light bg-info d-none">
  <div class="container-fluid">
    <a class="navbar-brand me-lg-2 text-white fs-3 me-2" href="<?php echo URL ?>backoffic.php">Gestion du Back-office</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav1">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active ms-lg-2 text-white fs-3 mx-3" aria-current="page" href="<?php echo URL ?>gestion_annonces.php">Gestion des annonces</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fs-3 mx-3" href="<?php echo URL ?>gestion_categories.php">">Gestion des catégories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fs-3 mx-3" href="<?php echo URL ?>gestion_membres.php">">Gestion des membres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fs-3 mx-3" href="<?php echo URL ?>gestion_commentaires.php">" >Gestion des commentaires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fs-3 mx-3" href="<?php echo URL ?>gestion_notes.php">" >Gestion des notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fs-2 mx-3" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Statistique"><i class="fas fa-chart-pie"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Navbar utilisateurs -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-lg-5 swap text-info" href="#">Swap</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active ms-lg-2 fs-3 text-info" aria-current="page" href="#"><i class="fa fa-home"></i> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link ms-lg-2 mt-2 text-info" href="<?php echo URL ?>emploi.php">EMPLOI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ms-lg-2 mt-2 text-info" href="<?php echo URL ?>auto.php">AUTO/MOTO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ms-lg-2 mt-2 text-info" href="<?php echo URL ?>immobilier.php">IMMOBILIER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ms-lg-2 mt-2 text-info" href="<?php echo URL ?>vacances.php">VACANCES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ms-lg-2 mt-2 text-info" href="<?php echo URL ?>multimedia.php">MULTIMEDIA</a>
        </li>
        <li class="nav-item dropdown text-info">
          <a class="nav-link dropdown-toggle ms-lg-5 mt-2 text-info" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Autres Rubriques
          </a>
          <ul class="dropdown-menu text-info" aria-labelledby="navbarDropdown1">
            <li><a class="dropdown-item text-info" href="<?php echo URL ?>loisirs.php">LOISIRS</a></li>
            <li><a class="dropdown-item text-info" href="<?php echo URL ?>materiels.php">MATERIELS</a></li>
            <li><a class="dropdown-item text-info" href="<?php echo URL ?>services.php">SERVICES</a></li>
            <li><a class="dropdown-item text-info" href="<?php echo URL ?>maison.php">MAISON</a></li>
            <li><a class="dropdown-item text-info" href="<?php echo URL ?>vetements.php">VETEMENTS</a></li>
            <li><hr class="dropdown-divider text-info"></li>
            <li><a class="dropdown-item text-info" href="<?php echo URL ?>divers.php">DIVERS</a></li>
          </ul>
        </li>
        <li class="nav-item">
         <a class="nav-link mx-lg-3 fs-3 border-start text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inscription" href="<?php echo URL ?>inscription.php"><i class="fas fa-sign-in-alt"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-lg-3 fs-3 text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Connexion/déconnexion" href="<?php echo URL ?>connexion.php"><i class="fas fa-power-off"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-lg-3 fs-3 text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Profil" href="<?php echo URL ?>profil.php"><i class="far fa-address-card"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-lg-3 fs-3 text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fiche annonce" href="<?php echo URL ?>pageannonce.php"><i class="far fa-newspaper"></i></a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
        <button class="btn btn-outline-info text-info" type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
  </div>
</nav>
</header>
<main class=" my-5">

    <?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>
