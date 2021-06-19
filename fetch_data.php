<?php

require_once('includes/init.php');
$connect = new PDO("mysql:host=localhost;charset=utf8;dbname=swap", "root", "");


//Vérification du fetch de data via le $_POST
if (isset($_POST['action'])) {
  $req =
    "SELECT * FROM `annonce`"; // requête de base

  if (isset($_POST["categorie"])) // vérification sélection d'un checkbox pour les catégorie
  {
    $filtre_categorie = implode("','", $_POST["categorie"]); // transformation de l'array $_POST en string
    $req .= " WHERE `categorie_id` IN ('$filtre_categorie');"; // requête de sélection en fonction de la catégorie

  }
  if (isset($_POST["region"])) // vérification sélection d'un checkbox pour les régions
  {
    $filtre_region = implode("','", $_POST["region"]);
    $req .= " AND `region` IN ('$filtre_region')";     // requête de sélection en fonction de la régions

  }
  if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
    $req .= " WHERE `prix` BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'"; // requête de sélection en fonction de la gamme de prix

  }
  if (isset($_POST['divers'])) {
    $filtre_divers = implode("','", $_POST["divers"]);
    switch ($filtre_divers) {
      case 1:
        $req .= " ORDER BY `prix` ASC";     // requêtes de sélection en fonction des tris par ordre
        break;
      case 2:
        $req .= " ORDER BY `prix` DESC";
        break;
      case 3:
        $req .= " ORDER BY `date_enregistrement` ASC";
        break;
      case 4:
        $req .= " ORDER BY `date_enregistrement` DESC";;
        break;
    }
  }

  $annonces = $connect->prepare($req);
  $annonces->execute();

  //Mise en place de la pagination
  $resultat = "";

  if ($annonces->rowCount() > 0) {
    $annonce = $annonces->fetch();
    while ($annonce = $annonces->fetch()) {
      $prix_affiche = new \NumberFormatter("fr-FR", \NumberFormatter::CURRENCY);
      $a =  (int) $annonce['prix'];
      $prix_affiche->formatCurrency($a, "EUR");
      $photo = $annonce['photo'] ? : 'placeholder-350x350.png';

      $resultat .=                            // Card d'affichage des produits issues de la sélection
        <<<HTML
<div class="col-lg-6">
  <div class="card mb-3 border" data-bs-toggle="modal" data-bs-target="#Modal$annonce[id_annonce]" style="max-width: 540px;">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-md-4 flex-shrink-0">
        <img class="img-fluid rounded w-100 img-thumbnail" src="./includes/img/$photo" alt="$photo">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title fw-bold fs-4">$titre</h5>
          <p class="card-text">$annonce[description_courte]</p>
          <p class="card-text"><small class="text-muted fs-5">$a € </small></p>
        </div>
      </div>
    </div>
  </div>
</div>
 <!-- Modal d'affichage des annonces -->
 <div class="modal fade" id="Modal$annonce[id_annonce]" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header container">
        <div class="row justify-content-between">
          <div class="col-md-4 flex-shrink-0">
            <img class="img-fluid rounded w-100 img-thumbnail" src="./includes/img/$photo" alt="$photo">
          </div>
          <div class="col-md-7">
            <h5 class="modal-title fw-bold fs-4" id="exampleModalLabel">$annonce[titre]</h5>
          </div>
          <div class="col-md-1">
            <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
      </div>
      <div class="modal-body">
        $annonce[description_longue]
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

HTML;
    }
  } else
      if ($resultat == false) {
    $resultat = '<h3>Aucune annonce ne correspond à votre sélection</h3>';
  } {
    echo $resultat;
  }
}
// $allAnnonces = sql($req);
// $nbAnnoncesParPage = 4;
// $totalAnnonces = $allAnnonces->rowcount();
// $resultat ='';
// $totalPages = ceil($totalAnnonces / $nbAnnoncesParPage);
// if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
//     $_GET['page'] = intval($_GET['page']);
//     $pageCourante = $_GET['page'];
// } else {
//     $pageCourante = 1;
// }
// $depart = ($pageCourante - 1) * $nbAnnoncesParPage;
// var_dump($depart);var_dump($totalPages);var_dump($totalAnnonces);
// if($allAnnonces->rowcount()>0){
//   $resultat .=
// <<<HTML
// <!-- Pagination -->
// <nav aria-label="Page navigation example">
//     <ul class="pagination">
//         <?php for ($i = 1; $i <= $totalPages; $i++) {
//             if ($i == $pageCourante) {
//                 echo '<li class="page-item active"><a class="page-link active" href="annonce.php?page=' . $i . '">' . $i . '</a></li>';
//             } else {
//                 echo '<li class="page-item"><a class="page-link" href="annonce.php?page=' . $i . '">' . $i . '</a></li>';
//             }
//         }} 
// 
?>

</ul>
</nav>
<!-- HTML ; -->