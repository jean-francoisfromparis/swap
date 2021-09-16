<?php

require_once('../includes/init.php');
if (!isAdmin()) {
    header('location:' . URL . 'index.php');
    exit();
}
//Gestion des suppressions
if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    sql("DELETE FROM membre WHERE id_membre=:id", array(
        'id' => $_GET['id']
    ));
    add_flash('👍 Le membre a été supprimée', 'success');
    header('location:' . $_SERVER['PHP_SELF']);
    exit();
}

// récupération des données d'un membres dans le formulaire
$rechercheParPseudo = '';


if (!empty($_POST['submit'])) {
    $errors = 0;
    if (!empty($_POST['rechercheParPseudo'])) {
        $errors = 0;
        $rechercheParPseudo = valid_donnees($_POST['rechercheParPseudo']);

        $modifications = sql("SELECT * FROM membre WHERE '$rechercheParPseudo' = pseudo");
    }
}
//Insertion des nouvelles données du profil choisi
if (!empty($_POST['editer'])) {

    $errors = 0;
    if (!empty($_POST['pseudo'])) {
        $errors = 0;
        $user = getUserByLogin($_POST['pseudo']);
        if ($user) {
            $errors++;
            add_flash("&#9888; Le pseudo choisi est indisponible. Merci d'en choisir un autre", 'warning');
        } elseif ($user = false) {
            if (iconv_strlen($_POST['pseudo']) < 4 || iconv_strlen($_POST['pseudo']) > 14) {
                // cas erreur
                $errors++;
                add_flash("&#9888; Le pseudo choisi doit être composé de 4 à 14 caratères. Merci d'en choisir un autre", 'warning');
            }
        }
    }
    if (!empty($_POST['nouveauEmail'])) {
        if (!filter_var($_POST['nouveauEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors++;
            add_flash('&#9888; Merci de saisir une adresse email valide', 'danger');
        }
    }
    if (!empty($_POST['nouveauTele'])) {
        $pattern1 = '#^(0|\+33)[1-9]( *[0-9]{2}){4}$#';
        if (!preg_match($pattern1, $_POST['nouveauTele'])) {
            $errors++;
            add_flash('&#9888; Le numéro de téléphone doit être composé de 8 chiffres', 'danger');
        }
    }




    if ($errors === 0) {

        $id_membre      = valid_donnees($_POST['id_membre']);
        $pseudo         = valid_donnees($_POST['pseudo']);
        $nom            = valid_donnees($_POST['nom']);
        $prenom         = valid_donnees($_POST['prenom']);
        $telephone      = valid_donnees($_POST['nouveauTele']);
        $nouveauEmail   = valid_donnees($_POST['nouveauEmail']);

        sql(
            "UPDATE `membre` SET `pseudo` = '$pseudo', `nom` = '$nom', `prenom` = '$prenom', `telephone` = '$telephone', `email` = '$nouveauEmail' WHERE '$id_membre' = id_membre"
        );
        add_flash('👍 Modification réussie ', 'success');
        header('location: gestion_membres.php');
        exit();
    }
}


//Selection des membres à afficher
$membres = sql("SELECT * FROM membre ORDER BY id_membre");
$membres1 = sql("SELECT pseudo FROM membre ORDER BY id_membre");
$suggestions = sql("SELECT * FROM membre ORDER BY id_membre");
$title = "Gestion des membres";
require_once('../includes/haut.php');
?>
<div class="container-fluid titre1 " style="width:100vw">
    <?php if (!empty(show_flash())) : ?>
        <div class="row justify-content-center">
            <div class="col">
                <?php echo show_flash('reset'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row text-center">
        <h1 class="mt-2">Gestion des Membres</h1>
        <hr class="mb-2">
    </div>

    <div class="table-responsive-md ">
        <table id="tableau1" class="table table-striped text-center table-hover">
            <thead class="text-center">
                <tr>
                    <th style="width:4rem">id</th>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Téléphone</th>
                    <th>email</th>
                    <th style="width:3rem">Civilité</th>
                    <th style="width:3rem">Statut</th>
                    <th>Date Entrée</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($membres->rowCount() > 0) : ?>

                    <?php while ($membre = $membres->fetch()) : ?>

                        <form method="POST" class="row mb-2">
                            <tr>
                                <td><input type="text" name="id_membres" class="form-control text-center" value="<?php echo $membre['id_membre'] ?>"></td>
                                <td><input type="text" name="pseudo" class="form-control text-center text-wrap" value="<?php echo $membre['pseudo'] ?>"></td>
                                <td><input type="text" name="nom" class="form-control text-center text-wrap" value="<?php echo $membre['nom'] ?>"></td>
                                <td><input type="text" name="prenom" class="form-control text-center text-wrap" value="<?php echo $membre['prenom'] ?>"></td>
                                <td><input type="text" name="telephone" class="form-control text-center text-wrap" value="<?php echo $membre['telephone'] ?>"></td>
                                <td><input type="text" name="email" class="form-control text-center text-wrap" value="<?php echo $membre['email'] ?>"></td>
                                <td><input type="text" name="civilite" class="form-control text-center" value="<?php echo $membre['civilite'] ?>"> </td>
                                <td><input type="text" name="statut" class="form-control text-center" value="<?php echo $membre['statut'] ?>"> </td>
                                <td><input type="text" name="date_enregistrement" class="form-control text-center text-wrap px-0" value="<?php echo  $membre['date_enregistrement'] ?>"></td>

                                <td><a href="?action=delete&id=<?php echo $membre['id_membre'] ?>" class="btn btn-danger confirm">
                                        <i class="fas fa-trash"></i>
                                    </a></td>
                                <td><a href="?action=edit&id=<?php echo $membre['id_membre'] ?>" class="btn btn-info confirm" data-bs-toggle="modal" data-bs-target="#Modal<?php echo $membre['id_membre'] ?>">
                                        <i class="far fa-eye"></i>
                                    </a></td>
                            </tr>
                        </form>
     
                        <!-- Modal affichage données Membres -->

                        <div class="modal fade" id="Modal<?php echo $membre['id_membre'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Profil de <?php echo $membre['pseudo'] ?> (Pseudo)</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- données du profil -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <hr class="mb-3">
                                                <div class="mb-3">
                                                    <label for="login">Pseudo</label>
                                                    <input type="text" name="pseudo" class="form-control" value="<?php echo $membre['pseudo'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <hr class="mb-3">
                                                <div class="mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" class="form-control" value="<?php echo $membre['email'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Commentaires</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Notes</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Ventes</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Achats</button>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                                                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                                                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
                                                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                   
                            </tbody>
                </table>
            </div>
    <?php else : ?>
        <div class="mt-4 alert alert-info">Il n'y a pas encore de membre</div>
    <?php endif; ?>
    </div>
    <hr class="mb-1">
    <div class="col-4 fs-4">
        <?php $count = $membres->rowCount();
        echo "Il y a actuellement $count membres."; ?>
    </div>
</div>
<form method="POST" action="gestion_membres.php" class="container-fluid">
    <div class="row row-cols-1 row-cols-md-2 recherchebar border rounded P-2 m-2 align-items-center">
        <div class="col-lg-3 py-2">
            <?php if ($suggestions->rowCount() > 0) : ?>
                <label for="rechercheParPseudo" class="form-label">par Pseudo</label>
                <input class="form-control" list="datalistPseudo" id="rechercheParPseudo" name="rechercheParPseudo" placeholder="">
                <datalist id="datalistPseudo">
                    <?php while ($suggestion = $suggestions->fetch()) : ?>
                        <?php echo (' <option  value="' . $suggestion['pseudo'] . '">') ?>

                    <?php endwhile; ?>
                <?php endif; ?>
                </datalist>

        </div>
        <div class="col-lg-3 align-items-end pt-4 ">
            <button type="submit" class="btn btn-primary w-50 h-100" id="submit" name="submit" value="submit">Récupérer</button>

        </div>


    </div>
</form>

<form action="" method="post" id="formulaire" class="container-fluid mb-5">

    <div class="row row-cols-1 row-cols-md-2 editform border rounded p-2 m-2">

        <?php if (isset($modifications) && (@$modifications->rowCount() > 0)) : ?>
            <?php while (@$modification = @$modifications->fetch()) : ?>
                <div class="col">
                    <input type="hidden" class="form-control w-50" name="id_membre" value="<?php echo @$modification['id_membre'] ?>">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control w-50" name="pseudo" value="<?php echo $modification['pseudo'] ?>">
                    <label for="nouveauMdp" class="form-label">Nouveau Mot de passe</label>
                    <input type="password" class="form-control w-50" name="nouveauMdp" minlength="8" maxlength="20">
                </div>
                <div class="col">
                    <label for="nouveauEmail" class="form-label">Nouvel Email</label>
                    <input type="email" class="form-control w-50" name="nouveauEmail" value="<?php echo $modification['email'] ?>">
                    <label for="nouveauTele" class="form-label">Nouveau # de Téléphone</label>
                    <input type="text" class="form-control w-50" name="nouveauTele" minlength="10" maxlength="10" value="<?php echo $modification['telephone'] ?>">
                </div>
                <div class="col">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control w-50" name="nom" value="<?php echo $modification['nom'] ?>">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control w-50" name="prenom" value="<?php echo $modification['prenom'] ?>">
                </div>
                <div class="col mt-3">
                    <button type="submit" value="editer" id="editer" class="btn btn-primary ms-5 w-25" name="editer">Editer</button>
                </div>
    </div>
<?php endwhile; ?>
<?php endif; ?>

</form>
<div class="h-100 container"></div>
<?php
require_once('../includes/footer.php');
