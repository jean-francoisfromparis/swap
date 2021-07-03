<?php

require_once('../includes/init.php');

if (!isAdmin()) {
    header('location:' . URL . 'connexion.php');
    exit();
}
// Initialisation des requêtes au niveau de l'id
if (isset($_GET) && is_numeric($_GET['id'])) :
    $id_annonce = implode("','", $_GET);
    // var_dump($_FILES);

    // Requêtes de sélection des données de l'annonce cliqué par l'utilisateur
    $annonces = sql("SELECT * FROM annonce WHERE  $id_annonce = id_annonce");
    $annonce = $annonces->fetch();

endif;
// traitement du formulaire de modification
if (!empty($_POST)) {
    $errors = 0;
    if (!empty($_FILES)) {

        // traitement update images et suppression ancien fichier
        $ext_autorisees = array('image/jpeg', 'image/jpg', 'image/png');
        if ((!in_array($_FILES['file1']['type'], $ext_autorisees)) && (!in_array($_FILES['file2']['type'], $ext_autorisees)) && (!in_array($_FILES['file3']['type'], $ext_autorisees)) && (!in_array($_FILES['file4']['type'], $ext_autorisees)) && (!in_array($_FILES['file5']['type'], $ext_autorisees))) {
            $errors++;
            add_flash('&#9888; Seules les images JPEG et PNG sont autorisées', 'danger');
        } else {
            // copie physique du fichier

            $photoExsitants = sql("SELECT * FROM `photo` WHERE `id_photo` = $annonce[photo_id]");
            $photo = $photoExsitants->fetch();
            $chemin = $_SERVER['DOCUMENT_ROOT'] . URL . 'includes/img/';

            if (!empty($_FILES['file1']['name'])) {
                $errors = 0;
                $nom_photo1 = 'photo1_' . uniqid() . trim(pathinfo($_FILES['file1']['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['file1']['tmp_name'], $chemin . $nom_photo1);

                if ($photo['photo1'] == 0) {

                    sql("UPDATE `photo` SET`photo1`=:photo1 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo1' => $nom_photo1
                    ));
                    sql("UPDATE `annonce` SET`photo`=:photo WHERE `id_annonce` = $annonce[id_annonce]", array(
                        'photo' => $nom_photo1
                    ));
                } else {
                    if ($nom_photo1 != $photo['photo1'] && file_exists($chemin . $photo['photo1'])) {
                        unlink($chemin . $photo['photo1']);
                    }
                    sql("UPDATE `photo` SET`photo1`=:photo1 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo1' => $nom_photo1
                    ));
                }
            }
            if ($_FILES['file2']['name']) {
                $errors = 0;
                $nom_photo2 = 'photo2_' . uniqid() . trim(pathinfo($_FILES['file2']['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES['file2']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['file2']['tmp_name'], $chemin . $nom_photo2);

                if ($photo['photo2'] == 0) {

                    sql("UPDATE `photo` SET`photo2`=:photo2 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo2' => $nom_photo2
                    ));
                } else {
                    if ($nom_photo2 != $photo['photo2'] && file_exists($chemin . $photo['photo2'])) {
                        unlink($chemin . $photo['photo2']);
                    }
                    sql("UPDATE `photo` SET`photo2`=:photo2 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo2' => $nom_photo2
                    ));
                }
            }
            if ($_FILES['file3']['name']) {
                $errors = 0;
                $nom_photo3 = 'photo3_' . uniqid() . trim(pathinfo($_FILES['file3']['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES['file3']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['file3']['tmp_name'], $chemin .  $nom_photo3);


                if ($photo['photo3'] == 0) {

                    sql("UPDATE `photo` SET`photo3`=:photo3 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo3' => $nom_photo3
                    ));
                } else {
                    if ($nom_photo3 != $photo['photo3'] && file_exists($chemin . $photo['photo3'])) {
                        unlink($chemin . $photo['photo3']);
                    }
                    sql("UPDATE `photo` SET`photo1`=:photo1 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo3' => $nom_photo3
                    ));
                }
            }
            if ($_FILES['file4']['name']) {
                $errors = 0;
                $nom_photo4 = 'photo4_' . uniqid() . trim(pathinfo($_FILES['file4']['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES['file4']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['file4']['tmp_name'], $chemin .  $nom_photo4);

                if ($photo['photo4'] == 0) {

                    sql("UPDATE `photo` SET`photo4`=:photo4 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo4' => $nom_photo4
                    ));
                } else {
                    if ($nom_photo4 != $photo['photo4'] && file_exists($chemin . $photo['photo4'])) {
                        unlink($chemin . $photo['photo4']);
                    }
                    sql("UPDATE `photo` SET`photo4`=:photo4 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo4' => $nom_photo4
                    ));
                }
            }
            if ($_FILES['file5']['name']) {
                $errors = 0;
                $nom_photo5 = 'photo5_' . uniqid() . trim(pathinfo($_FILES['file5']['name'], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES['file5']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['file5']['tmp_name'], $chemin . $nom_photo5);

                if ($photo['photo5'] == 0) {

                    sql("UPDATE `photo` SET`photo5`=:photo5 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo5' => $nom_photo5
                    ));
                } else {
                    if ($nom_photo5 != $photo['photo5'] && file_exists($chemin . $photo['photo5'])) {
                        unlink($chemin . $photo['photo5']);
                    }
                    sql("UPDATE `photo` SET`photo5`=:photo5 WHERE `id_photo` = $annonce[photo_id]", array(
                        'photo5' => $nom_photo5
                    ));
                }
            }
        }
    }
    //traitement update autres champs

    if ($_POST['titre']) {
        $titre  = valid_donnees($_POST['titre']);
        sql("UPDATE `annonce` SET`titre`=:titre WHERE `id_annonce` = $annonce[id_annonce]", array(
            'titre' => $titre
        ));
    }
    if ($_POST['description_courte']) {
        $description_courte = valid_donnees($_POST['description_courte']);
        sql("UPDATE `annonce` SET`description_courte`=:description_courte WHERE `id_annonce` = $annonce[id_annonce]", array(
            'description_courte' => $description_courte
        ));
    }
    if ($_POST['description_longue']) {
        $description_longue = valid_donnees($_POST['description_longue']);
        sql("UPDATE `annonce` SET`description_longue`=:description_longue WHERE `id_annonce` = $annonce[id_annonce]", array(
            'description_longue' => $description_longue
        ));
    }
    if ($_POST['prix']) {
        $prix = valid_donnees($_POST['prix']);
        sql("UPDATE `annonce` SET`prix`=:prix WHERE `id_annonce` = $annonce[id_annonce]", array(
            'prix' => $prix
        ));
    }
    if ($_POST['ville']) {
        $ville = valid_donnees($_POST['ville']);
        sql("UPDATE `annonce` SET`ville`=:ville WHERE `id_annonce` = $annonce[id_annonce]", array(
            'ville' => $ville
        ));
    }
    if ($_POST['cp']) {
        $cp = valid_donnees($_POST['cp']);
        sql("UPDATE `annonce` SET `cp`=:cp WHERE `id_annonce` = $annonce[id_annonce]", array(
            'cp' => $cp
        ));
    }
    if ($_POST['adresse']) {
        $adresse = valid_donnees($_POST['adresse']);
        sql("UPDATE `annonce` SET `adresse`=:adresse WHERE `id_annonce` = $annonce[id_annonce]", array(
            'adresse' => $adresse
        ));
    }
    add_flash('👍 modification réussie', 'info');
    header('location:' . URL . 'admin/gestion_annonces.php');
    exit();
}

// var_dump($_FILES);

$title = "Modification des Annonces";
require_once('../includes/haut.php');

//      Récupération du $_GET de l'URL
if (isset($_GET) && is_numeric($_GET['id'])) :
    $id_annonce = implode("','", $_GET);
    // var_dump($_FILES);

    // Requêtes de sélection des données de l'annonce cliqué par l'utilisateur
    $annonces = sql("SELECT * FROM annonce WHERE  $id_annonce = id_annonce");
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
    if ($annonce['photo_id']) {
        $photos = sql("SELECT * FROM photo WHERE  $annonce[photo_id] = id_photo");
    }
    $photo = $photos->fetch();
?>
    <div class="container-fluid titre1 " style="width:100vw">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row text-center mt-5">
                <h1 class="">Modification de l'annonce N°<?= $id_annonce ?> publiée par <?= $membre['pseudo'] ?? ' Pseudo' ?></h1>
                <hr class="mb-2">
            </div>
            <?php if (!empty(show_flash())) : ?>
                <div class="row justify-content-center">
                    <div class="col">
                        <?= show_flash('reset'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-end">
                <button type="submit" class="btn btn-primary col-md-2">Valider la modification</button>
            </div>

            <div class="row">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-10">
                        <div class="row g-3 align-items-center">
                            <div class=" col-sm-4 text-center">
                                <label for="file1" class="form-label fs-4">Photo <i class="far fa-images"></i></label>
                                <input type="file" id="file1" name="file1" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                                <div id="photo1" class="photo position-relative" name="photo1">
                                    <img src="../includes/img/<?= $annonce['photo'] ?>" alt="<?= $annonce['photo'] ?>" class="img-fluid rounded img-thumbnail w-100 image_galerie">
                                    <a href="?id=<?= $_GET['id'] ?>" class="position-absolute  bg-light px-2 border fa fa-times top-0 end-0"></a>
                                </div>

                            </div>
                            <div class="col-sm-5">
                                <h3><label for="titre" class="form-label">Titre</label>
                                    <input type="text" class="form-control w-100" name="titre" id="titre" placeholder="<?= $annonce['titre'] ?? "Titre de l'annonce" ?>">

                                </h3>
                                <p class="text-annonce p-2 mt-2">
                                    <label for="description_courte" class="form-label">Description Courte</label>
                                    <textarea type="text" class="form-control w-100" id="description_courte" name="description_courte" maxlength="125" rows="3" placeholder=" <?= $annonce['description_courte'] ?? 'lorem125' ?>"></textarea>
                                </p>
                                <p class="text-annonce p-2 mt-2">
                                    <label for="description_longue" class="form-label">Description longue</label>
                                    <textarea type="text" class="form-control w-100" id="description_longue" name="description_longue" maxlength="600" rows="8" placeholder=" <?= $annonce['description_longue'] ?? ">lorem600 "  ?>"></textarea>

                                </p>

                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Ville<i class="fas fa-map-signs ms-2"></i></label>
                                    <input class="form-control border fs-4 text-end" type="text" name="ville" id="ville" placeholder="<?= $annonce['ville'] ?? ' Ville' ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="cp" class="form-label">code postal</label>
                                    <input type="text" class="form-control w-100" name="cp" id="cp">
                                </div>
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <textarea type="text" class="form-control w-100" name="adresse" id="adresse" row="3"></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="row justify-content-center text-start ms-1 mt-2 align-items-center">

                            <div class="col-4 fs-5">
                                <i class="far fa-calendar-alt me-2"></i> <?= "date de publication : $date" ?? "date de publication :  " . date('d/m/Y') ?>
                            </div>
                            <div class="col-4 fs-4">
                                <i class="far fa-user"> &nbsp;</i><?= $membre['pseudo'] ?? ' Pseudo' ?>
                            </div>
                            <div class="col-4 fs-4">
                                <label for="prix" class="form-label">Prix en <i class="fas fa-euro-sign"></i></label>
                                <input type="number" class="form-control w-100" id="prix" name="prix" max="3000000" step="0.1" placeholder="<?= $a ?? ' prix' ?>">
                            </div>

                        </div>




                        <div class="row justify-content-between align-items-center my-1">
                            <div class="col-2">
                                <label for="file2" class="form-label fs-4">Photo 2 <i class="far fa-images"></i></label>
                                <input type="file" id="file2" name="file2" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                                <div id="photo2" class="position-relative photo" name="photo2">
                                    <a href="../includes/img/<?= $photo['photo2'] ?>" data-fancybox="preview" data-width="750" data-height="500">
                                        <img src="../includes/img/<?= $photo['photo2'] ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo2'] ?? '' ?>">
                                        <a href="?id=<?= $_GET['id'] ?>" class="position-absolute  bg-light px-2 border fa fa-times top-0 end-0 translate-middle-x"></a>
                                    </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="file3" class="form-label fs-4">Photo 3 <i class="far fa-images"></i></label>
                                <input type="file" id="file3" name="file3" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                                <div id="photo3" class="position-relative photo" name="photo3">
                                    <a href="<?= URL . 'includes/img/' . $photo['photo3'] ?? URL . 'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                                        <img src="../includes/img/<?= $photo['photo3'] ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo3'] ?? '' ?>">
                                        <a href="?id=<?= $_GET['id'] ?>" class="position-absolute  bg-light px-2 border fa fa-times top-0 end-0 translate-middle-x"></a>
                                    </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="file4" class="form-label fs-4">Photo 4 <i class="far fa-images"></i></label>
                                <input type="file" id="file4" name="file4" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                                <div id="photo4" class="position-relative photo" name="photo4">
                                    <a href="<?= URL . 'includes/img/' . $photo['photo4'] ?? URL . 'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                                        <img src="<?= URL . 'includes/img/' . $photo['photo4'] ?? URL . 'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo4'] ?? '' ?>">
                                        <a href="?id=<?= $_GET['id'] ?>" class="position-absolute  bg-light px-2 border fa fa-times top-0 end-0 translate-middle-x"></a>
                                    </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="file5" class="form-label fs-4">Photo 5 <i class="far fa-images"></i></label>
                                <input type="file" id="file5" name="file5" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                                <div id="photo5" class="position-relative photo" name="photo5">
                                    <a href="<?= URL . 'includes/img/' . $photo['photo5'] ?? URL . 'photo/placeholder/placeholder-350x350.png' ?>" data-fancybox="preview" data-width="750" data-height="500">
                                        <img src="<?= URL . 'includes/img/' . $photo['photo5'] ?? URL . 'photo/placeholder/placeholder-350x350.png' ?>" class="img-fluid rounded img-thumbnail image1 image_galerie" alt="<?= $photo['photo5'] ?? '' ?>">
                                        <a href="?id=<?= $_GET['id'] ?>" class="position-absolute  bg-light px-2 border fa fa-times top-0 end-0 translate-middle-x"></a>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



    </div>
    </form>
<?php
endif;


require_once('../includes/footer.php');
