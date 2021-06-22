<?php

require_once('includes/init.php') ;
$data = ('');

$title= "Annonce";
require_once ('includes/haut.php');
?>
<!-- message flash -->
<?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>

<!-- Récupération du $_GET de l'URL -->
<?php  if (isset($_GET) && is_numeric($_GET['id'])) : 
$id_annonce = implode("','", $_GET);
// Requêtes de sélection des données de l'annonce cliqué par l'utilisateur
$annonces = sql ("SELECT * FROM annonce WHERE  $id_annonce = id_annonce");
$annonce = $annonces->fetch();
$prix_affiche = new \NumberFormatter("fr-FR", \NumberFormatter::CURRENCY);
      $a =  (int) $annonce['prix'];
      $prix_affiche->formatCurrency($a, "EUR");
$date = date('d/m/Y', strtotime($annonce['date_enregistrement']));
// Requêtes de la catégorie de l'annonce cliqué par l'utilisateur
$categories = sql("SELECT titre FROM categorie WHERE  $annonce[categorie_id] = id_categorie");

$categorie = $categories->fetch();

// Requêtes des données du membres de l'annonce cliqué par l'utilisateur

$membres = sql("SELECT pseudo, email FROM membre WHERE  $annonce[membre_id] = id_membre");

$membre = $membres->fetch();

// Requêtes des autres photos liées à l'annonce sélectionné par l'utilisateur

$photos = sql("SELECT * FROM photo WHERE  $annonce[photo_id] = id_photo");

$photo = $photos->fetch();

?>





<div class="row titre1 mt-3">
    <h2 class="col-8"> Fiche Annonce : <?= $categorie["titre"]  ?></h2>
        <div class="col-4 text-center">
              <button type="submit" class="btn btn-primary col-md-4" data-bs-toggle="modal" data-bs-target="#modalEmail" data-bs-whatever="<?= $membre['email'] ?? '' ?>" id="contacter" name="contacter">Contacter :&nbsp; <?= $membre['pseudo'] ?? '' ?>
              </button>
        </div>
   
    <hr class="mb-3">
</div>

<div class="container-fluid px-5 mt-2" onload="init()">
  <div class="row g-3 justify-content-center">
    <div class="col-sm-10">
      <div class="row g-3 align-items-center">
        <div class=" col-sm-4 text-center">
            <img src="./includes/img/<?= $annonce['photo']?>" alt="<?= $annonce['photo']?>" class="img-fluid rounded img-thumbnail w-75 image_galerie"  id="expandedImg">
        </div>
        <div class="col-sm-5">
        <h3><?= $annonce['titre'] ??"Titre de l'annonce" ?></h3>
            <p class="text-annonce p-2 mt-2">
                <?= $annonce['description_courte'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil a neque asperiores, similique beatae nisi atque quasi quam totam dolor mollitia iste, voluptates optio sint, deserunt debitis voluptatibus id incidunt.
         Reiciendis, esse debitis. Itaque, porro. Tempora corrupti, mollitia, repudiandae voluptatibus iure a debitis fugit repellendus error at voluptate consectetur? Error similique, sapiente est et culpa nihil voluptatibus repellat totam modi?' ?>
            </p>
            <p class="text-annonce p-2 mt-2">
                <?= $annonce['description_longue'] ??" Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut fugiat, animi et, accusamus sapiente doloremque quasi pariatur totam quidem veritatis ratione temporibus incidunt voluptas neque quos ipsa numquam dolore eius?
         Perspiciatis atque dolorum unde quae ipsum amet voluptatibus, cum vitae tenetur illum ab pariatur culpa, corrupti repellat omnis voluptas doloribus! Dolores aperiam recusandae maxime quo quis animi minus perspiciatis eaque.
         Consectetur, eum. Nesciunt dolorum, laudantium non officia expedita provident dolores, molestias in reiciendis dolorem itaque aliquam aut blanditiis impedit voluptatibus. Ea aliquam aut ut eligendi itaque voluptas maxime, atque iusto?
         Veniam dignissimos aliquid dolores quae ea qui enim, corporis eveniet. Alias eveniet mollitia consequatur consectetur officia. Nostrum aut accusamus consectetur, beatae tenetur quas cum ea, assumenda, neque consequatur nesciunt nobis!"  ?>
            </p>
         
        </div>
        <div class="col-sm-3  p-5">
          <h3>commentaire</h3>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><?= $commentaire['commentaire'] ?? 'Commentaire' ?> '' de : <?= $commentaire['id_membres'] ?? 'pseudo' ?></li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
          </ul>
      </div>
      </div>
      <div class="row justify-content-center text-start ms-1 mt-2 align-items-center">
      
        <div class="col-3 fs-5">
            <i class="far fa-calendar-alt me-2"></i> <?= "date de publication : $date" ?? "date de publication :  ".date('d/m/Y') ?>
        </div>
        <div class="col-3 fs-4">
        <i class="far fa-user"> &nbsp;</i><?= $membre['pseudo'] ?? ' Pseudo'?>
        </div>
        <div class="col-3 fs-4">
            <?= $a ?? ' prix'?> &nbsp; <i class="fas fa-euro-sign"></i> 
        </div>
        <div class="col-3 fs-4 text-end">
          <button id="send" class="btn btn-primary col-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Pour afficher la carte cliquez sur ok">OK</button>
          <label for="adresse" class="form-label"><i class="fas fa-map-signs ms-2"></i></label>
          <input class="form-control border-0 fs-4 text-end" type="text" id="address" value="<?= $annonce['ville'] ?? ' Ville' ?>" /><pre id="output" class="d-none"></pre>
        </div>

      </div>
      <div class="row justify-content-between align-items-center my-1">
                <div class="col-2">
                  <a href="<?= URL.'includes/img/'.$photo['photo2'] ?? URL.'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                    <img src="<?= URL.'includes/img/'.$photo['photo2'] ?? URL.'photo/placeholder/placeholder-350x350.png' ?>"  class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo2'] ?? '' ?>">
                  </a>    
                </div>
                <div class="col-2">
                  <a href="<?= URL.'includes/img/'.$photo['photo3'] ??URL.'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                      <img src="<?= URL.'includes/img/'.$photo['photo3'] ??URL.'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo3'] ?? '' ?>">
                  </a>
                </div>
                <div class="col-2">
                  <a href="<?= URL.'includes/img/'.$photo['photo4'] ?? URL.'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                      <img src="<?= URL.'includes/img/'.$photo['photo4'] ?? URL.'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo4'] ?? '' ?>">
                  </a>
                </div>
                <div class="col-2">
                  <a href="<?= URL.'includes/img/'.$photo['photo5'] ?? URL.'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                      <img src="<?= URL.'includes/img/'.$photo['photo5'] ?? URL.'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo5'] ?? '' ?>">
                  </a>
                </div>
                <div class="col-2">
                    <div id="mapid" class="me-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Pour afficher la carte en grand format maintenez l'appui sur la carte"></div>
                </div>
        </div>
        <a href="" data-bs-toggle="modal" class="fs-5 mt-5" data-bs-target="#commentaire"> <i class="far fa-comments"></i> Partagez un commentaire</a>
    </div>
    
   
  </div>
  
</div>
<!-- Dêpot de commentaires dans une modal-->

<div class="modal fade" id="commentaire" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Partagez un commentaire</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="membre_id" method="post">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $_SESSION['user']['pseudo'] ?? '' ?>">
                <input type="hidden" class="form-control" name="membre_id" id="membre_id" value="<?php echo $_SESSION['user']['id_membre'] ?? '' ?>"> 
            </div>
            <div class="mb-3">
                <label for="annonce_id" class="form-label"></label>
                <input type="text" class="form-control" id="annonce_id" name="annonce_id" value="<?php echo $annonce['id_annonce'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Example textarea</label>
                <textarea class="form-control" id="commentaire" rows="3"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" name="valider">Valider</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Envoi d'un email dans une modal-->

<div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Destinataire :&nbsp;<?= $membre['pseudo'] ?? '' ?></label>
            <input type="text" class="form-control" id="recipient-name" value="<?= $membre['email'] ?? '' ?>" required>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" rows="2" maxlength="140" placeholder="votre message doit comporter au plus 140 caractères" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Envoyer le message</button>
      </div>
    </div>
  </div>
</div>






<?php endif; ?>
<?php
require_once('includes/footer.php');