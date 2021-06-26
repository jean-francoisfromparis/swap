<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="<?php echo URL ?>css/jquery.fancybox.min.css">




  <!-- CSS liée au table données -->

  <!-- css principal -->
  <link rel="stylesheet" href="<?php echo URL ?>/css/style.css">






  <title>SWAP</title>
</head>

<body>
  <header>

    <!-- Navbar utilisateurs -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient fixed-top ">
      <div class="container-fluid">
        <a class="navbar-brand ms-lg-5 swap text-info effet" href="<?php echo URL ?>index.php">Swap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active ms-lg-2 fs-3 text-info effet" aria-current="page" href="<?php echo URL ?>index.php"><i class="fa fa-home"></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-lg-2 mt-2 text-info effet" href="<?php echo URL ?>emploi.php">EMPLOI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-lg-2 mt-2 text-info effet" href="<?php echo URL ?>auto.php">AUTO/MOTO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-lg-2 mt-2 text-info effet" href="<?php echo URL ?>immobilier.php">IMMOBILIER</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-lg-2 mt-2 text-info effet" href="<?php echo URL ?>vacances.php">VACANCES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ms-lg-2 mt-2 text-info effet" href="<?php echo URL ?>multimedia.php">MULTIMEDIA</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle ms-lg-3 mt-2 text-info effet" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Autres Rubriques
              </a>
              <ul class="dropdown-menu text-info" aria-labelledby="navbarDropdown1">
                <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>loisirs.php">LOISIRS</a></li>
                <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>materiels.php">MATERIELS</a></li>
                <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>services.php">SERVICES</a></li>
                <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>maison.php">MAISON</a></li>
                <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>vetements.php">VETEMENTS</a></li>
                <li>
                  <hr class="dropdown-divider text-info fw-bold">
                </li>
                <li><a class="dropdown-item black effet3" href="<?php echo URL ?>divers.php">DIVERS</a></li>
              </ul>
            </li>
            <?php if (!isConnected()) : ?>
              <li class="nav-item">
                <a class="nav-link mx-lg-3 fs-3 border-start text-info effet" data-bs-toggle="modal" data-bs-target="#inscriptionModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inscription" href="<?php echo URL ?>inscription.php"><i class="fas fa-sign-in-alt"></i></a>
              </li>
            <?php endif ?>

            <li class="nav-item">
              <a class="nav-link mx-lg-3 fs-3 text-info effet" data-bs-toggle="modal" data-bs-target="#connexionModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Connexion/déconnexion" href="<?php echo URL ?>connexion.php"><i class="fas fa-power-off"></i></a>
            </li>
            <?php if (isAdmin() || (isConnected())) : ?>
              <li class="nav-item">
                <a class="nav-link mx-lg-3 fs-3 text-info effet" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Profil" href="<?php echo URL ?>profil.php"><i class="far fa-address-card"></i><br>
                  <span class="fs-6"><?php echo $_SESSION['user']['pseudo'] ?></span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link mx-lg-3 fs-3 text-info effet" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fiche annonce" href="<?php echo URL ?>pageannonce.php"><i class="far fa-newspaper"></i></a>
              </li>
            <?php endif ?>
            <!-- Dropdown administrateur Gestion du back-office -->
            <?php if (isAdmin()) : ?>
              <li class="nav-item dropdown text-info">
                <a class="nav-link dropdown-toggle mx-lg-2 mt-2 text-info effet" href="<?php echo URL ?>backoffice.php" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Gestion du Back-office
                </a>
                <ul class="dropdown-menu " aria-labelledby="navbarDropdown2">
                  <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>admin/gestion_annonces.php">Gestion des annonces</a></li>
                  <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>admin/gestion_categories.php">Gestion des catégories</a></li>
                  <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>admin/gestion_membres.php">Gestion des membres</a></li>
                  <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>admin/gestion_commentaires.php">Gestion des commentaires</a></li>
                  <li><a class="dropdown-item text-black effet3" href="<?php echo URL ?>admin/gestion_notes.php">Gestion des notes</a></li>
                  <li>
                    <hr class="dropdown-divider text-info fw-bold">
                  </li>
                  <li><a class="dropdown-item text-black effet3 text-center" href="<?php echo URL ?>admin/gestion_statistiques.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Statistique"><i class="fas fa-chart-pie"></i></a></li>
                </ul>
              </li>
            <?php endif ?>
          </ul>



          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
            <button class="btn btn-outline-info text-info effet" type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>

      </div>
    </nav>
  </header>
  <main>