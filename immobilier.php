<?php

require_once('includes/init.php') ;

$title= "Annonce";
require_once ('includes/haut.php');
?>
<div class="container titre2">
    <div class="row text-center ">
        <h1> Annonce</h1>
        <hr class="mb-4">
    </div>
</div>
<?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>

<div class="row titre1 ">
    <h2 class="col-8"> Appartement</h2>
   
        <div class="col-4 text-center">
             <form action="" method="post">
             <button type="submit" class="btn btn-info w-25" id="contacter" name="contacter">Contacter <?php echo $membre['pseudo'] ?? '' ?>
            </button>
            </form>
        </div>
   
    <hr class="mb-3">
</div>

<div class="container-fluid px-5 mt-2">
  <div class="row g-3">
    <div class="col-sm-10">
      <div class="row g-3 align-items-center">
        <div class="col-8 col-sm-6">
        <img src="<?php echo URL.'photo/placeholder/640x360.png' ?>" alt="<?php echo $annonce['photo'] ?? '' ?>">
        </div>
        <div class="col-4 col-sm-6">
        <h3><?php echo $annonce['titre'] ??"Titre de l'annonce" ?></h3>
            <p class="text-annonce p-2 mt-2">
                <?php echo $annonce['description_courte'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil a neque asperiores, similique beatae nisi atque quasi quam totam dolor mollitia iste, voluptates optio sint, deserunt debitis voluptatibus id incidunt.
         Reiciendis, esse debitis. Itaque, porro. Tempora corrupti, mollitia, repudiandae voluptatibus iure a debitis fugit repellendus error at voluptate consectetur? Error similique, sapiente est et culpa nihil voluptatibus repellat totam modi?' ?>
            </p>
            <p class="text-annonce p-2 mt-2">
                <?php echo $annonce['description_longue'] ??" Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut fugiat, animi et, accusamus sapiente doloremque quasi pariatur totam quidem veritatis ratione temporibus incidunt voluptas neque quos ipsa numquam dolore eius?
         Perspiciatis atque dolorum unde quae ipsum amet voluptatibus, cum vitae tenetur illum ab pariatur culpa, corrupti repellat omnis voluptas doloribus! Dolores aperiam recusandae maxime quo quis animi minus perspiciatis eaque.
         Consectetur, eum. Nesciunt dolorum, laudantium non officia expedita provident dolores, molestias in reiciendis dolorem itaque aliquam aut blanditiis impedit voluptatibus. Ea aliquam aut ut eligendi itaque voluptas maxime, atque iusto?
         Veniam dignissimos aliquid dolores quae ea qui enim, corporis eveniet. Alias eveniet mollitia consequatur consectetur officia. Nostrum aut accusamus consectetur, beatae tenetur quas cum ea, assumenda, neque consequatur nesciunt nobis!"  ?>
            </p>
         
        </div>
      </div>
      <div class="row align-items-center text-start">
      
        <div class="col fs-4">
            <i class="far fa-calendar-alt me-2"></i> <?php echo "date de publication : ".date('d/m/Y') ?>
        </div>
        <div class="col fs-4">
        <i class="far fa-user"></i><?php echo $membre['pseudo'] ?? ' Pseudo'?>
        </div>
        <div class="col fs-4">
            <i class="fas fa-euro-sign"></i><?php echo $annonce['prix'] ?? ' prix'?>
        </div>
        <div class="col fs-4">
        <i class="fas fa-map-signs"></i><?php echo $annonce['ville'] ?? ' Ville' ?>
        </div>

      </div>
      <div class="row align-items-center text-start mt-1">  
                <div class="col">
                   <img src="<?php echo URL.'photo/placeholder/placeholder-350x350.png' ?>"  class="img-fluid image1" alt="<?php echo $photo['photo2'] ?? '' ?>">    
                </div>
                <div class="col">
                    <img src="<?php echo URL.'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid image1" alt="<?php echo $photo['photo3'] ?? '' ?>">
                </div>
                <div class="col">
                    <img src="<?php echo URL.'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid image1" alt="<?php echo $photo['photo4'] ?? '' ?>">
                </div>
                <div class="col">
                     <img src="<?php echo URL.'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid image1" alt="<?php echo $photo['photo5'] ?? '' ?>">
                </div>
        </div>
        <a href="" data-bs-toggle="modal" class="fs-5 mt-5" data-bs-target="#commentaire"> <i class="far fa-comments"></i> Partagez un commentaire</a>
    </div>
    <div class="col-sm-2  p-5">
                <p class="text-annonce p-2">
                Le clic sur le lien «déposer un commentaire ou une note » (en bas à gauche) ouvre une lightbox avec deux options : <br>
                1 – Attribuer une note ainsi qu’un avis sur la relation avec le vendeur (cette note est basé sur la qualité des échanges et du relationnel).<br>
                2 – Déposer un commentaire sur l’annonce (pour poser une question ou obtenir des précisions sur le produit ou service proposés). <br>
                S’il y a déjà des commentaires pour cette annonce, nous les afficherons directement sur la page web fiche annonce. <br>
                Si l’internaute n’est pas connecté, nous lui afficherons un lien « connectez-vous pour déposer un commentaire ou une note ». <br>
                Le clic sur le bouton vert (en haut à droite) ouvre également une lightbox avec le numéro de téléphone du vendeur ainsi qu’un formulaire pour lui écrire un email. Les autres annonces sont générés à partir de traits commun en fonction de la recherche de l’internaute.
                </p> 
    </div>
   
  </div>
  
</div>
<!-- Dêpot de commentaires -->

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

<?php
require_once('includes/footer.php');