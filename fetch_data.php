<?php

require_once('includes/init.php');
$connect = new PDO("mysql:host=localhost;charset=utf8;dbname=swap", "root", "");


//Vérification du fetch de data via le $_POST
if (isset($_POST['action'])) {
  
  $filtreCategorie = '';
  $filtreRegion    = '';
  $filtrePrix      = '';
  $filtreDivers    ='';
  $filtreDivers1   ='';
  $filtre          = '';
  " , date_enregistrement DESC";

if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
 {
  $filtrePrix .= "
   AND prix BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
  ";
 }
 if(isset($_POST["categorie"]))
 {
  $categorie = implode("','", $_POST["categorie"]);
  var_dump($categorie);
  $filtreCategorie .= "
   AND categorie_id IN('".$categorie."')
  ";
 }
 if(isset($_POST["region"]))
 {
  $region = implode("','", $_POST["region"]);
  var_dump($region);
  $filtreRegion .= "
   AND region IN('".$region."')
  ";
 }
if(isset($_POST["divers"]))
{$divers = implode("','", $_POST["divers"]);
  switch ($divers) {
    case 1:
      $filtreDivers .= " ORDER BY `prix` ASC";     // requêtes de sélection en fonction des tris par ordre
      break;
    case 2:
      $filtreDivers .= " ORDER BY `prix` DESC";
      break;
    case 3:
      $filtreDivers .= " ORDER BY `date_enregistrement` ASC";
      break;
    case 4:
      $filtreDivers .= " ORDER BY `date_enregistrement` DESC";;
      break;
}
}

$annonces = sql("SELECT * FROM annonce WHERE '1' " 
. $filtreCategorie 
. $filtreRegion   
. $filtrePrix     
. $filtreDivers   
. $filtreDivers1   
. $filtre );
   


  

  //Mise en place de la pagination
  $photo2 = '';
  $photo3 = '';
  $photo4 = '';
  $photo5 = '';


  $resultat = "";


  if ($annonces->rowCount() > 0) {
    $annonce = $annonces->fetch();
    while ($annonce = $annonces->fetch()) {
      $prix_affiche = new \NumberFormatter("fr-FR", \NumberFormatter::CURRENCY);
      $a =  (int) $annonce['prix'];
      $prix_affiche->formatCurrency($a, "EUR");
      $date=date('d/m/Y', strtotime($annonce['date_enregistrement']));
      $photo = $annonce['photo'] ?: 'placeholder-350x350.png';
      $photo2 = '' ?: 'placeholder-350x350.png';
      $photo3 = '' ?: 'placeholder-350x350.png';
      $photo4 = '' ?: 'placeholder-350x350.png';
      $photo5 = '' ?: 'placeholder-350x350.png';
      $resultat .=                            // Card d'affichage des produits issues de la sélection
        <<<HTML
<div class="col-lg-6">
    <div class="card mb-3 border" data-bs-toggle="modal" data-bs-target="#modal$annonce[id_annonce]" style="max-width: 540px;">
      <div class="row g-0 d-flex align-items-center">
        <div class="col-md-4 flex-shrink-0">
          <img class="img-fluid rounded w-100 img-thumbnail" src="./includes/img/$photo" alt="$photo">
        </div>
        <div class="col-md-8">
          <div class="card-body">
          <a href="./fiche_annonce.php?id=$annonce[id_annonce]">
            <h5 class="card-title fw-bold fs-4">$annonce[titre] /$annonce[id_annonce] </h5>
            <p class="card-text">$annonce[description_courte]</p>
            <p class="card-text"><small class="text-muted fs-5">$a € </small><br>Annonce publiée : le $date </p>
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>

 <!-- Modal d'affichage des annonces -->

 <div class="modal fade" id="modal$annonce[id_annonce]" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel$annonce[id_annonce]" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <!-- header -->
    <div class="modal-header">
      <div class="container-fluid">
        <div class="row p-0 m-0">
          <div class="col-12">
            <h5 class="modal-title fw-bold fs-4" id="staticBackdropLabel$annonce[id_annonce]">$annonce[titre]</h5>
          </div>
        </div>
      </div>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <!-- Body -->
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row my-2">
            <div class="col-4">
              <img class="img-fluid rounded w-100 image_gallerie" src="./includes/img/$photo" alt="$photo"> 
            </div>
            <div class="col-8">
              <p class="mt-5 text-justify fs-6">$annonce[description_longue]</p>
            </div>
          </div>

       
            <!-- <div id="mapid"></div> -->
          </div>
          <!-- Gallerie -->
          <div class="row my-5">
            <div class="col-2 p-1">
              <a href="./includes/img/$photo" data-fancybox="preview" data-width="750" data-height="500">
                  <img class="img-fluid rounded w-100 image_galerie" src="./includes/img/$photo" alt="$photo">
              </a>
            </div>
            <div class="col-2 p-1">
              <a href="./includes/img/$photo2" data-fancybox="preview" data-width="750" data-height="500">
                  <img class="img-fluid rounded w-100 image_galerie" src="./includes/img/$photo2" alt="$photo2">
              </a>
            </div>
            <div class="col-2 p-1">
              <a href="./includes/img/$photo3" data-fancybox="preview" data-width="750" data-height="500">
                  <img class="img-fluid rounded w-100 image_galerie" src="./includes/img/$photo3" alt="$photo3">
              </a>
            </div>
            <div class="col-2 p-1">
              <a href="./includes/img/$photo4" data-fancybox="preview" data-width="750" data-height="500">
                  <img class="img-fluid rounded w-100 image_galerie" src="./includes/img/$photo4" alt="$photo4">
              </a>
            </div>
            <div class="col-2 p-1">
              <a href="./includes/img/$photo5" data-fancybox="preview" data-width="750" data-height="500">
                  <img class="img-fluid rounded w-100 image_galerie" src="./includes/img/$photo5" alt="$photo5">
              </a>
            </div>
          </div>
        </div>




       



      
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