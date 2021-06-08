<?php

require_once('includes/init.php') ;
//Traitement de la déconnexion
// if (!isConnected()) {
// 	header ('Location:'.URL.'index.php');
// 	exit();}

    // Traitement du formulaire
    $reqs = sql("SELECT id_photo, photo1 FROM photo");
    $req = $reqs->fetchAll();
    $last_photo =implode(" ", $req[count($req)-1] );
    $lastId_photo=substr(implode(" ", $req[count($req)-1] ) ,0, strpos(implode(" ", $req[count($req)-1] ),' '));
    // $nom_photo1 = ltrim(stristr( implode(" ", $req[count($req)-1] )  ,' '));
    
    
 
    if (!empty($_POST)){
    
        $errors=0;
        if(empty($_POST['titre'])){
            $errors++;
            add_flash('&#9888; Merci de choisir un titre à votre annonce', 'danger');
        }
        if(empty($_POST['description_courte'])){
            $errors++;
             add_flash('&#9888; Merci de choisir une courte description pour votre annonce', 'danger');
         }
         if(empty($_POST['prix'])){
             $errors++;
             add_flash('&#9888; Merci de choisir le prix pour votre annonce', 'danger');
         }else{
             $pattern = '#^\d{1,8}\.?(\d{1,2})?$#';
             if (!preg_match($pattern,$_POST['prix'])){
                 $errors++;
                 add_flash('&#9888; Le prix indiqué doit être un chiffre avec 2 chiffres aprés un point', 'danger');
             }
         }
         if(empty($_POST['categorie_id'])){
             $errors++;
             add_flash('&#9888; Merci de choisir une catégorie pour votre annonce', 'danger');
         }
         $nom_photo1 = '';

        if((!empty($_FILES['file1']['name']) && $_FILES['file1']['error'] == 0) || (  (!empty($_FILES['file2']['name']) && $_FILES['file2']['error'] == 0)  ) ||  (  (!empty($_FILES['file3']['name']) && $_FILES['file3']['error'] == 0) )  ||   ( (!empty($_FILES['file4']['name']) && $_FILES['file4']['error'] == 0)  ) || (  (!empty($_FILES['file5']['name']) && $_FILES['file5']['error'] == 0)  )){
            $errors=0;
            $ext_autorisees = array('image/jpeg','image/png');
            if( (!in_array($_FILES['file1']['type'], $ext_autorisees)) && (!in_array($_FILES['file2']['type'], $ext_autorisees)) && (!in_array($_FILES['file3']['type'], $ext_autorisees)) && (!in_array($_FILES['file4']['type'], $ext_autorisees)) && (!in_array($_FILES['file5']['type'], $ext_autorisees))){
                $errors++;
                add_flash('Seules les images JPEG et PNG sont autorisées','danger');
            }
            else{
                // copie physique du fichier
                $nom_fichier1 ='photo1_'.date('d_m_Y_H_i').trim(pathinfo($_FILES['file1']['name'], PATHINFO_FILENAME)). '.'.pathinfo($_FILES['file1']['name'],PATHINFO_EXTENSION);
                $nom_fichier2 ='photo2_'.date('d_m_Y_H_i').trim(pathinfo($_FILES['file2']['name'], PATHINFO_FILENAME)). '.'.pathinfo($_FILES['file2']['name'],PATHINFO_EXTENSION);
                $nom_fichier3 ='photo3_'.date('d_m_Y_H_i').trim(pathinfo($_FILES['file3']['name'], PATHINFO_FILENAME)). '.'.pathinfo($_FILES['file3']['name'],PATHINFO_EXTENSION);
                $nom_fichier4 ='photo4_'.date('d_m_Y_H_i').trim(pathinfo($_FILES['file4']['name'], PATHINFO_FILENAME)). '.'.pathinfo($_FILES['file4']['name'],PATHINFO_EXTENSION);
                $nom_fichier5 ='photo5_'.date('d_m_Y_H_i').trim(pathinfo($_FILES['file5']['name'], PATHINFO_FILENAME)). '.'.pathinfo($_FILES['file5']['name'],PATHINFO_EXTENSION);
                $chemin = $_SERVER['DOCUMENT_ROOT'] . URL . 'includes/img/';
                move_uploaded_file($_FILES['file1']['tmp_name'], $chemin.$nom_fichier1);
                move_uploaded_file($_FILES['file2']['tmp_name'], $chemin.$nom_fichier2);
                move_uploaded_file($_FILES['file3']['tmp_name'], $chemin.$nom_fichier3);
                move_uploaded_file($_FILES['file4']['tmp_name'], $chemin.$nom_fichier4);
                move_uploaded_file($_FILES['file5']['tmp_name'], $chemin.$nom_fichier5);
                $nom_photo1 = $nom_fichier1;
               
                
                sql("INSERT INTO photo (photo1, photo2, photo3, photo4, photo5) VALUES (:photo1, :photo2, :photo3, :photo4, :photo5)",array(
                        'photo1' => $nom_fichier1,
                        'photo2' => $nom_fichier2,
                        'photo3' => $nom_fichier3,
                        'photo4' => $nom_fichier4,
                        'photo5' => $nom_fichier5
                    ));
               
                }
                
            }  

   
    $titre              = valid_donnees($_POST['titre']);
    $description_courte = valid_donnees($_POST['description_courte']);
    $description_longue = valid_donnees($_POST['description_longue']);
    $prix               = valid_donnees($_POST['prix']);
    $photo1             = $nom_photo1;
    $region               = valid_donnees($_POST['region']);
    $ville              = valid_donnees($_POST['ville']);
    $adresse            = valid_donnees($_POST['adresse']);
    $cp                 = valid_donnees($_POST['cp']);
    $membre_id          = $_SESSION['user']['id_membre'];
    $photo_id           = $lastId_photo;
    $categorie_id       =substr($_POST['categorie_id'],0,strpos($_POST['categorie_id'],' '));
    

    sql("INSERT INTO `annonce`(`titre`, `description_courte`, `description_longue`, `prix`, `photo`, `region`, `ville`,`adresse`, `cp`, `membre_id`, `photo_id`, `categorie_id`, `date_enregistrement`) 
    VALUES ( :titre, :description_courte, :description_longue, :prix, :photo, :region, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, NOW() )",
    array(
    'titre'              =>   $titre,                        
    'description_courte' =>   $description_courte,
    'description_longue' =>   $description_longue,
    'prix'               =>   $prix,
    'photo'              =>   $photo1,
    'region'             =>   $region,
    'ville'              =>   $ville,
    'adresse'            =>   $adresse,
    'cp'                 =>   $cp,
    'membre_id'          =>   $membre_id,
    'photo_id'           =>   $photo_id,
    'categorie_id'       =>   $categorie_id 
        ));
            add_flash("L'annonce a bien été enregistré", 'success');
            // header('Location:' .URL. 'pageannonce.php');
            // exit();
    }

$categories = sql("SELECT * FROM categorie ORDER BY id_categorie");
    $title= "Déposer une annonce";
require_once ('includes/haut.php');
?>
<div class="container titre1">
    <div class="row text-center ">
        <h1>Déposer une annonce</h1>
        <hr class="mb-3">
    </div>
</div>
<?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>

 <span><?php var_dump( gettype($nom_photo1)); ?></span><span><?php var_dump(($nom_photo1)); ?></span>

<div class="container-fluid">
<form  method="POST" enctype="multipart/form-data">
        <div class="row row-cols-1 row-cols-md-2 editform border rounded p-2 m-2">
            <div class="col">    
                <div class="mb-1">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control w-100" name="titre" id="titre" required>
                </div>
                <div class="mb-2">
                    <label for="description_courte" class="form-label">Description Courte</label>
                    <textarea type="text" class="form-control w-100" id="description_courte" name="description_courte" required></textarea>
                </div>
            </div>
            <div class="col">
                    <div class="row row-cols-5 text-center">
                        <div class="col">
                            <label for="file1" class="form-label">Photo 1</label>
                           <input type="file" id="file1" name="file1" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                            <!-- <label>Image actuelle</label> -->
                            <div id="photo1" class="position-relative photo" name="photo1">
                                <img src="./photo/placeholder/placeholder-350x350.png" class="img-fluid w-50">
                                <?php if(defined('BLOGHEADER')) : ?>
                                    <a href="?action=supimg" class="bg-light px-2 border"><i class="fa fa-times"></i></a>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <div class="col">
                            <label for="file2" class="form-label">Photo 2</label>
                            <input type="file" id="file2" name="file2" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                            <!-- <label>Image actuelle</label> -->
                            <div id="photo2" class="position-relative photo" name="photo2">
                                <img src="./photo/placeholder/placeholder-350x350.png" class="img-fluid w-50">
                                <?php if(defined('BLOGHEADER')) : ?>
                                    <a href="?action=supimg" class="bg-light px-2 border"><i class="fa fa-times"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col">
                            <label for="file3" class="form-label">Photo 3</label>
                            <input type="file" id="file3" name="file3" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                            <!-- <label>Image actuelle</label> -->
                            <div id="photo3" name="photo3" class="position-relative photo">
                                <img src="./photo/placeholder/placeholder-350x350.png" class="img-fluid w-50">
                                <?php if(defined('BLOGHEADER')) : ?>
                                    <a href="?action=supimg" class="bg-light px-2 border"><i class="fa fa-times"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col">
                            <label for="file4" class="form-label">Photo 4</label>
                            <input type="file" id="file4" name="file4" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                            <!-- <label>Image actuelle</label> -->
                            <div id="photo4" name="photo4" class="position-relative photo">
                                <img src="./photo/placeholder/placeholder-350x350.png" class="img-fluid w-50">
                                <?php if(defined('BLOGHEADER')) : ?>
                                    <a href="?action=supimg" class="bg-light px-2 border"><i class="fa fa-times"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col">
                            <label for="file5" class="form-label">Photo 5</label>
                            <input type="file" id="file5" name="file5" class="form-control w-100 d-none" accept="image/jpeg,image/png">
                            <!-- <label>Image actuelle</label> -->
                            <div id="photo5" name="photo5" class="position-relative photo" >
                                <img src="./photo/placeholder/placeholder-350x350.png" class="img-fluid w-50">
                                <?php if(defined('BLOGHEADER')) : ?>
                                    <a href="?action=supimg" class="bg-light px-2 border"><i class="fa fa-times"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col">
                <div class="mb-2">
                    <label for="description_longue" class="form-label">Description longue</label>
                    <textarea type="text" class="form-control w-100" id="description_longue" name="description_longue"  row="3"></textarea>
                </div>
                <div class="mb-2">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control w-100" id="prix" name="prix" max="10000000" step="0.1" required>
                </div>
                <div class="mb-2">
                <?php if($categories->rowCount() > 0 ) : ?>    
                <label for="categorie_id" class="form-label">Catégorie</label>
                <input class="form-control" list="datalistCategorie" id="categorie_id" placeholder="choississez une catégorie..." name="categorie_id">
               
                <datalist id="datalistCategorie">
                <?php while( $categorie = $categories->fetch() ) : ?>
                <?php echo(' <option action=""  value="'.$categorie['id_categorie'].' '.$categorie['titre'].'">')?>
                <?php endwhile; ?>
                <?php endif; ?>
                </datalist>
               
                
                </div>
                <div class="mt-3">
                     <input type="submit" value="valider" class="btn btn-primary w-25" id="submit">
                </div>
            </div>
            <div class="col">
                <div class="mb-1">
                    <label for="region" class="form-label">Région</label>
                    <input type="text" class="form-control w-100" list="datalistRegions" name="region" id="region">
                        <datalist id="datalistRegions">
                            <option value="Auvergne-Rhône-Alpes">
                            <option value="Bourgogne-Franche-Comté">
                            <option value="Bretagne">
                            <option value="Centre-Val de Loire">
                            <option value="Corse">
                            <option value="Grand Est">
                            <option value="Guyane">
                            <option value="Hauts-de-France">
                            <option value="Ile-de-France">
                            <option value="La Réunion">
                            <option value="Martinique">
                            <option value="Mayotte">
                            <option value="Normandie">
                            <option value="Nouvelle-Aquitaine">
                            <option value="Occitanie">
                            <option value="Pays de la Loire">
                            <option value="Provence-Alpes-Côte d'Azur">
                        </datalist>


                </div>
                <div class="mb-1">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control w-100" name="ville" id="ville" >
                </div>

                <div class="mb-1">
                    <label for="cp" class="form-label">code postal</label>
                    <input type="text" class="form-control w-100" name="cp" id="cp">
                </div>
                <div class="mb-1">
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea type="text" class="form-control w-100" name="adresse" id="adresse" row="3"></textarea>
                </div>
                   

            </div>
          
        </div>
</form>
</div>



</div>

<?php
require_once('includes/footer.php');