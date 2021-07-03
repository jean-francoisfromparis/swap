<?php

require_once('includes/init.php') ;
//Traitement de la déconnexion
if(isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['user']);
    add_flash('Vous vous êtes déconnecté', 'success');
    header('location: index.php');
    exit();
}



//redirection en cas de connection
// if(isConnected()){
//     header('location:'.URL.'profil.php');
//     exit();
// }
// Traitement du formulaire
if (!empty($_POST)){
    $errors = 0;
    if(empty($_POST['pseudo'])){
        $errors++;
        add_flash('&#9888; Merci de choisir un pseudo', 'danger');
    }else{
        $user = getUserByLogin($_POST['pseudo']);
        if ($user) {
            $errors++;
            add_flash("&#9888; Le pseudo choisi est indisponible. Merci d'en choisir un autre", 'warning');
        }
        elseif ($user = false){
        if( iconv_strlen($_POST['pseudo']) < 4 || iconv_strlen($_POST['pseudo']) > 14 ) {
            // cas erreur
            $errors++;
            add_flash("&#9888; Le pseudo choisi doit être composé de 4 à 14 caratères. Merci d'en choisir un autre", 'warning');
        }
        }
    }
    if(empty($_POST['mdp'])){
        $errors++;
        add_flash('&#9888; Merci de saisir un mot de passe','danger');
    }
    else {
        $pattern = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\S]{8,20}$#';
        if (!preg_match($pattern,$_POST['mdp'])){
            $errors++;
            add_flash('&#9888; Le mot de passse doit être composé de 8 à 20 caratères comprenant au moins une minuscule, une majuscule et un chiffre', 'danger');
        }   
    }
    if (empty($_POST['confirmmdp'])) {
        $errors++;
        add_flash('&#9888; Merci de confirmer votre mot de passe', 'danger');
    } else {
        if (!empty($_POST['mdp']) && $_POST['confirmmdp'] !== $_POST['mdp']) {
            $errors++;
            add_flash('&#9888; La confirmation ne concorde pas avec le mot de passe', 'danger');
        }
        }
    if(empty($_POST['nom'])){
        $errors++;
        add_flash('&#9888; Merci de saisir votre nom', 'danger');
    }
    if(empty($_POST['prenom'])){
        $errors++;
        add_flash('&#9888; Merci de saisir votre prénom', 'danger');
    }
    if(empty($_POST['telephone'])){
        $errors++;
        add_flash('&#9888; Merci de saisir votre numéro de téléphone', 'danger');
    }
    else{
        $pattern1 = '#^(0|\+33)[1-9]( *[0-9]{2}){4}$#';
        if (!preg_match($pattern1,$_POST['telephone'])){
            $errors++;
            add_flash('&#9888; Le numéro de téléphone doit être composé de 10 chiffres', 'danger');
        }  
    }
    if(empty($_POST['email'])){
        $errors++;
        add_flash('&#9888; Merci de saisir une adresse email', 'danger');
    }
    else{
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors++;
        add_flash('&#9888; Merci de saisir une adresse email valide', 'danger');
    }
    }

    if(empty($_POST['civilite']) ){
        $errors++;
        add_flash('&#9888; Merci de valider au moins une civilité', 'danger');
    }
    if ($errors === 0) {
        
        $pseudo         = valid_donnees($_POST['pseudo']);
        $mdp            = valid_donnees($_POST['mdp']);
        $nom            = valid_donnees($_POST['nom']);
        $prenom         = valid_donnees($_POST['prenom']);
        $telephone      = valid_donnees($_POST['telephone']);
        $email          = valid_donnees($_POST['email']);
        $civilite       = valid_donnees($_POST['civilite']);

        sql("INSERT INTO membre VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :telephone, :email, :civilite, 0, NOW())", array(
            'pseudo'    => $pseudo,
            'mdp'       => password_hash($mdp, PASSWORD_DEFAULT),
            'nom'       => $nom,
            'prenom'    => $prenom,
            'telephone' => $telephone,
            'email'     => $email,
            'civilite'  => $civilite 

        ));
        add_flash(' 👍 Inscription réussie, vous pouvez vous connecter', 'success');
        header('Location: index.php');
        exit();
    }

}





$title= "Bienvenu sur votre site d'annonce";
require_once ('includes/haut.php');
?>

<div id="carousel1" class="carousel slide carousel-fade taille_carousel" data-bs-ride="carousel">
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
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container text-center text-info"><h1>Votre site d'Annonce</h1>

<?php echo var_dump($_SESSION) ?></div>

<?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>


<div class="container justify-content-center">
  <div class="row row-cols-1 row-cols-md-2 g-4 card_group">
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu1_sm.jpg" class="card-img" alt="Immobilier">
            <div class="card-img-overlay">
                <h3 class="card-title titre position-absolute top-0 fw-bold">Immobilier</h3>
                <p class="card-text position-absolute bottom-0 fs-6 fw-bold"><?php echo $nbannonceImmo ?? '' ?>Annonces immobilières <br> ventes locations appartements maisons  </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu2_sm.jpg" class="card-img" alt="Auto/Moto">
            <div class="card-img-overlay">
                <h3 class="card-title position-absolute top-0 titre fw-bold">Auto/Moto</h3>
                <p class="card-text position-absolute bottom-0 fs-6 fw-bold"><?php echo $nbannonceAuto ?? '' ?>Annonces Auto/Moto <br> Achats ventes de voitures et deux roues d'occasions</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark rounded ">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu3_sm.jpg" class="card-img" alt="Immobilier">
            <div class="card-img-overlay">
                <h3 class="card-title titre position-absolute top-0 fw-bold text-black">EMPLOI</h3>
                <p class="card-text position-absolute bottom-0 fs-6 fw-bold text-white"><?php echo $nbannoncejob ?? '' ?>Offres d'emploi </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark rounded text-white">
            <img src="<?php echo URL ?>photo/bienvenu/photo_bienvenu4_sm.jpg" class="card-img" alt="Immobilier">
            <div class="card-img-overlay">
                <h3 class="card-title titre position-absolute top-0 fw-bold">VACANCES</h3>
                <p class="card-text position-absolute bottom-0 fs-6 fw-bold"><?php echo $nbannonceVacances ?? '' ?>Annonces locations vacances<br> Appartement Studio Villa Camping-car  </p>
            </div>
        </div>
    </div>
  </div>
  </div>
<!-- Modal Inscription -->

<form method="POST">
<div class="modal fade" id="inscriptionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">S'inscrire</h5>
      </div>
      <div class="modal-body">
          <!-- Tabs -->
        <ul class="nav nav-tabs w-100">
            <li class="nav-item">
                <a class="nav-link active effet1 border" aria-current="page" href="#onglet1" data-bs-toggle="tab" role="tab" aria-controls="home" aria-selected="true"><small>Informations<br>de compte</small></a>
            </li>
            <li class="nav-item">
                <a class="nav-link border effet1 h-100" href="#onglet2" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false"><small>Validation<br></small></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            
            <div class="tab-pane fade show active container-fluid" id="onglet1" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row g-3">
                            <div class="col-6">
                                <div class="mb-3 row mt-2 g-1 p-2">
                                    <label for="pseudo" class="form-label  w-50 ">Votre pseudo</label>
                                    <input type="text" class="form-control "id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? '' ?>">
                                </div>
                                <div class="mb-3 row g-1 p-2">
                                    <label for="mdp" class="form-label w-50">Votre mot de passe</label>
                                    <input type="password" class="form-control-sm" name="mdp" id="mdp"  minlength="8"  maxlength="20"><input type="password" class="form-control-sm" name="confirmmdp" id="confirmmdp" placeholder="confirmez votre mot de passe"  minlength="8" maxlength="20">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 row mt-2 g-1 p-2">
                                    <label for="nom" class="form-label  w-50">Votre nom</label>
                                    <input type="text" class="form-control "id="nom" name="nom" value="<?php echo $_POST['nom'] ?? '' ?>">
                                </div>
                                <div class="mb-3 row g-1 p-2">
                                    <label for="prenom" class="form-label  w-50">Votre prénom</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? '' ?>">
                                </div>
                            </div>
                    </div>
            </div>
            <div class="tab-pane fade container-fluid" id="onglet2" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row g-3">
                            <div class="col-6">
                                <div class="mb-3 row mt-2 g-1 p-2">
                                    <label for="telephone" class="form-label  w-75 ">Votre # de Téléphone</label>
                                    <input type="text" class="form-control "id="telephone" name="telephone" value="<?php echo $_POST['telephone'] ?? '' ?>" minlength="10" maxlength="10">
                                </div>
                                <div class="mb-3 row g-1 p-2">
                                    <label for="email" class="form-label w-50">Votre email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mb-3 mt-4 ms-5 g-1 p-2">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite1" value="m">
                                    <label class="form-check-label" for="civilite1">
                                        Homme
                                    </label>
                                </div>
                                <div class="form-check  mb-3 mt-2 ms-5 g-1 p-2">
                                    <input class="form-check-input" type="radio" name="civilite" id="civilite2" value="f">
                                    <label class="form-check-label" for="civilite2">
                                        Femme
                                    </label>
                                </div>
                                <div class="mb-3 mt-2 ms-3 g-1 p-2">
                                    <P>Déjà inscrit ? Vous pouvez vous connecter en <a class=" nav-link fs-6 effet2" data-bs-toggle="modal" data-bs-target="#connexionModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Connexion/déconnexion" href="<?php echo URL ?>connexion.php">cliquant ici <i class="fas fa-power-off"></i> </a></P>
                                </div>
                            </div>
                    </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary w-25"><i class="fas fa-sign-in-alt"></i></button>
        <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal"><i class="far fa-window-close"></i></button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal connexion -->

<form method="POST" action="connexion.php">
<div class="modal fade" id="connexionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
      </div>
      <div class="modal-body">
          <!-- Tabs -->
        <ul class="nav nav-tabs w-100">
            <li class="nav-item">
                <a class="nav-link active effet1 border" aria-current="page" href="#onglet3" data-bs-toggle="tab" role="tab" aria-controls="home" aria-selected="true"><small>Informations<br>de connexion</small></a>
            </li>
            <li class="nav-item">
                <a class="nav-link border effet1 h-100" href="#onglet4" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false"><small>Oubli de <br> Mot de Passe</small></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            
            <div class="tab-pane fade show active container-fluid" id="onglet3" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row g-3">
                            <div class="col-6">
                                <div class="mb-3 row mt-2 g-1 p-2">
                                    <label for="pseudo" class="form-label  w-50 ">Votre pseudo</label>
                                    <input type="text" class="form-control "id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? '' ?>">
                                </div>
                                <div class="mb-3 row g-1 p-2">
                                    <label for="mdp" class="form-label w-50">Votre mot de passe</label>
                                    <input type="password" class="form-control-sm" name="mdp" id="mdp"  minlength="8"  maxlength="20"><input type="password" class="form-control-sm" name="confirmmdp" id="confirmmdp" placeholder="confirmez votre mot de passe"  minlength="8" maxlength="20">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 row mt-5 g-1 p-2">
                                    <button type="submit" class="btn btn-primary w-50"><i class="fas fa-sign-in-alt"></i></button>
                                </div>
                                <div class="mb-3 row mt-5 g-1 p-2">
                                    <button type="button" class="btn btn-danger w-50" data-bs-dismiss="modal"><i class="far fa-window-close"></i></button>
                                </div>
                                <div class="mb-3 row mt-5 g-1 p-2">
                                    <a type="button" class="btn btn-warning w-50" href="?action=logout">Déconnexion<i class="fas fa-power-off"></i></a>
                                </div>
                            </div>
                    </div>
            </div>
            <div class="tab-pane fade container-fluid" id="onglet4" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row g-3">
                            <div class="col-6">
                                <div class="mb-3 row mt-2 g-1 p-2">
                                    <label for="telephone" class="form-label  w-75 ">Votre # de Téléphone</label>
                                    <input type="text" class="form-control "id="telephone" name="telephone" value="<?php echo $_POST['telephone'] ?? '' ?>" minlength="10" maxlength="10">
                                </div>
                                <div class="mb-3 row g-1 p-2">
                                    <label for="email" class="form-label w-50">Votre email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mb-3 mt-4 ms-5 g-1 p-2">
                                    <input class="form-check-input" type="radio" name="civilite1" id="civilite1" value="m">
                                    <label class="form-check-label" for="civilite1">
                                        Homme
                                    </label>
                                </div>
                                <div class="form-check  mb-3 mt-2 ms-5 g-1 p-2">
                                    <input class="form-check-input" type="radio" name="civilite2" id="civilite2" value="f">
                                    <label class="form-check-label" for="civilite2">
                                        Femme
                                    </label>
                                </div>
                                <div class="mb-3 mt-2 ms-3 g-1 p-2">
                                    <P>Déjà inscrit ? Vous pouvez vous connecter en <a href="<?php echo URL ?>">cliquant ici</a></P>
                                </div>
                            </div>
                    </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</form>

<?php
require_once('includes/footer.php');