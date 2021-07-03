<?php

require_once('../includes/init.php');
if (!isAdmin()) {
    header('location:' . URL . 'connexion.php');
    exit();
}
//Traitement de la suppression
if (isset($_GET['action']) && $_GET['action'] == 'delete' && is_numeric($_GET['id']) && !empty($_GET['id'])) {
    $get = $_GET['id'];
    $id_membre = intval($get);
    $membreSupprimer = sql("SELECT * FROM membre WHERE `id_membre` = $id_membre ");
    if ($membreSupprimer->rowCount() > 0) {
        sql("DELETE FROM membre WHERE $id_membre = id_membre ", array(
            'id_membre' => $_GET['id']
        ));
        add_flash('👍 Suppression du membre réussie', 'info');
        header('location: gestion_membres1?page=1&id=3');
        exit();
    } else
        add_flash('&#x26A0; Une erreur a dû se glisser dans la matrix le membre sélectionner n`existe.', 'warning');
}



//traitement du formulaire
if (!empty($_POST)) {
    $errors = 0;
    $get = $_GET['id'];
    $id_membre = intval($get);

    if (isset($_POST['modifier'])) {
        $errors = 0;

        if (!empty($_POST['pseudo']) && $_POST['pseudo'] != '') {
            $user = getUserByLogin($_POST['pseudo']);

            if ($user) {
                $errors++;
                add_flash('&#x26A0; le pseudo choisi est indisponible. Merci d\'en choisir un autre', 'warning');
            }
            $errors = 0;
            $newPseudo = valid_donnees($_POST['pseudo']);
            sql("UPDATE `membre` SET `pseudo`=:pseudo WHERE `id_membre` = $id_membre", array(
                'pseudo' => $newPseudo
            ));
            add_flash('👍 modification du pseudo réussie', 'info');
        }
        if (!empty($_POST['nouveauMdp'])) {
            $pattern = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\S]{8,20}$#';
            if (!preg_match($pattern, $_POST['nouveauMdp'])) {
                $errors++;
                add_flash('&#x26A0; Le mot de passse doit être composé de 8 a 20 caratères comprenant au moins une minuscule, une majuscule et un chiffre', 'danger');
            }
            $errors = 0;
            $nouveauMdp = password_hash(valid_donnees($_POST['nouveauMdp']), PASSWORD_BCRYPT);
            sql("UPDATE `membre` SET `mdp`=:mdp WHERE `id_membre` = $id_membre", array(
                'mdp' => $nouveauMdp
            ));
            add_flash('👍 modification du mot de passe réussie', 'info');
        }
        if (!empty($_POST['nouveauEmail'])) {
            if (!filter_var($_POST['nouveauEmail'], FILTER_VALIDATE_EMAIL)) {
                $errors++;
                add_flash('&#x26A0; Adresse mail invalide', 'danger');
            }
            $nouveauEmail = valid_donnees($_POST['nouveauEmail']);
            $errors = 0;
            sql("UPDATE `membre` SET `email`=:email WHERE `id_membre` = $id_membre", array(
                'email' => $nouveauEmail
            ));
            add_flash('👍 modification de l`email réussie', 'info');
        }
        if (!empty($_POST['nouveauTele'])) {
            $pattern1 = '#^(0|\+33)[1-9]( *[0-9]{2}){4}$#';
            if (!preg_match($pattern1, $_POST['nouveauTele'])) {
                $errors++;
                add_flash('&#9888; Le numéro de téléphone doit être composé de 8 chiffres', 'danger');
            }
            $nouveauTele = valid_donnees($_POST['nouveauTele']);
            $errors = 0;
            sql("UPDATE `membre` SET `telephone`=:telephone WHERE `id_membre` = $id_membre", array(
                'telephone' => $nouveauTele
            ));
            add_flash('👍 modification du N° de téléphone réussie', 'info');
        }
        if (!empty($_POST['nom'])) {
            $errors = 0;
            $nom = valid_donnees($_POST['nom']);
            sql("UPDATE `membre` SET `nom`=:nom WHERE `id_membre` = $id_membre", array(
                'nom' => $nom
            ));
            add_flash('👍 modification du nom réussie', 'info');
        }
        if (!empty($_POST['prenom'])) {
            $errors = 0;
            $prenom = valid_donnees($_POST['prenom']);
            sql("UPDATE `membre` SET `prenom`=:prenom WHERE `id_membre` = $id_membre", array(
                'prenom' => $prenom
            ));
            add_flash('👍 modification du prenom réussie', 'info');
        }
        if (isset($_POST['civilite'])) {
            $errors = 0;

            var_dump($_POST['civilite']);
            sql("UPDATE `membre` SET `civilite`=:civilite WHERE `id_membre` = $id_membre", array(
                'civilite' =>  $_POST['civilite']
            ));
            add_flash('👍 modification de la civilité réussie', 'info');
        }
        if (isset($_POST['statut'])) {
            $errors = 0;
            sql("UPDATE `membre` SET `statut`=:statut WHERE `id_membre` = $id_membre", array(
                'statut' => $_POST['statut']
            ));
        }
        header('location: gestion_membres1?page=1&id=3');
        exit();
    }
} //--------------------------



//initialisation de la pagination
$record_per_page = 5;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$query = "SELECT * FROM membre order by id_membre DESC LIMIT $start_from, $record_per_page";
$result = sql($query);

//Selection des membres à afficher
$membres = sql("SELECT * FROM membre ORDER BY id_membre DESC LIMIT $start_from, $record_per_page");
$membres1 = sql("SELECT pseudo FROM membre ORDER BY id_membre DESC LIMIT $start_from, $record_per_page");

$suggestions = sql("SELECT * FROM membre ORDER BY id_membre DESC LIMIT $start_from, $record_per_page");
$title = "Gestion des membres";
require_once('../includes/haut.php');
?>
<div class="container-fluid titre1 " style="width:100vw">
    <div class="row text-center">
        <h1 class="mt-2">Gestion des Membres</h1>
        <hr class="mb-2">
    </div>
    <?php if (!empty(show_flash())) : ?>
        <div class="row justify-content-center">
            <div class="col">
                <?php echo show_flash('reset'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div>
        <!-- tableau de présentation des membres -->
        <table class="table-responsive-lg shadow-sm text-center table-hover" id="">
            <thead class="text-center">
                <th style="width:3rem">id</th>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Téléphone</th>
                <th>email</th>
                <th style="width:3rem">Civilité</th>
                <th style="width:3rem">Statut</th>
                <th>Date Entrée</th>


                <div class="row">
                    <?php if ($membres->rowCount() > 0) : ?>

                        <?php while ($membre = $membres->fetch()) : ?>

                            <form method="GET" class="row mb-2">
                                <tr>
                                    <td><input type="text" name="id_membre" class="form-control text-center" value="<?php echo $membre['id_membre'] ?>"></td>
                                    <td><input type="text" name="pseudo" class="form-control text-center text-wrap" value="<?php echo $membre['pseudo'] ?>"></td>
                                    <td><input type="text" name="nom" class="form-control text-center text-wrap" value="<?php echo $membre['nom'] ?>"></td>
                                    <td><input type="text" name="prenom" class="form-control text-center text-wrap" value="<?php echo $membre['prenom'] ?>"></td>
                                    <td><input type="text" name="telephone" class="form-control text-center text-wrap" value="<?php echo $membre['telephone'] ?>"></td>
                                    <td><input type="text" name="email" class="form-control text-center text-wrap" value="<?php echo $membre['email'] ?>"></td>
                                    <td><input type="text" name="civilite" class="form-control text-center" value="<?php echo $membre['civilite'] ?>"> </td>
                                    <td><input type="text" name="statut" class="form-control text-center" value="<?php echo $membre['statut'] ?>"> </td>
                                    <td><input type="text" name="date_enregistrement" class="form-control text-center text-wrap px-0" value="<?php echo  $membre['date_enregistrement'] ?>"></td>
                                    <td> <a href="gestion_membres1.php?id=<?= $membre['id_membre'] ?>" class="btn btn-info confirm">
                                            <i class="fa fa-edit"></i>
                                            </button></td>
                                    <td><a href="gestion_membres1.php?action=delete&id=<?= $membre['id_membre'] ?>" class="btn btn-danger onclick="return confirm('&#x26A0; Comfirmez vous la suppression de ce membre ?')"">
                                            <i class="fas fa-trash"></i>
                                        </a></td>
                                </tr>
                            </form>

                        <?php endwhile; ?>
            </thead>
        </table>

        <?php
                        $page_query = "SELECT * FROM membre ORDER BY id_membre DESC";
                        $page_result = sql($page_query);
                        $total_records = $page_result->rowCount();
                        $total_pages = ceil($total_records / $record_per_page);
                        $start_loop = $page;
                        $difference = $total_pages - $page;
                        if ($difference <= 2) {
                            $start_loop = $total_pages - 1;
                        }
                        $end_loop = $start_loop + 2;
                        if ($page == 1) {
                            echo "<nav aria-label='Page navigation example mt-5'>";
                            echo "<ul class='pagination'>";
                            echo "<li class='page-item'><a class='page-link' href='gestion_membres1.php?page=1'>1<sup>ère<sup></a></li>";
                        }
                        if ($page > 1) {
                            echo "<nav aria-label='Page navigation example mt-5'>";
                            echo "<ul class='pagination'>";
                            echo "<li class='page-item'><a class='page-link' href='gestion_membres1.php?page=1&id=" . @$_GET['id'] . "'>1<sup>ère<sup></a></li>";
                            echo "<li class='page-item'><a class='page-link' href='gestion_membres1.php?page=" . ($page - 1) . "&id=" . @$_GET['id'] . "'><<</a></li>";
                        }
                        for ($i = $start_loop; $i <= $end_loop; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='gestion_membres1.php?page=" . $i . "&id=" . @$_GET['id'] . "'>" . $i . "</a></li>";
                        }
                        if ($page <= $total_pages) {
                            echo "<li class='page-item'><a class='page-link' href='gestion_membres1.php?page=" . ($page + 1) . "&id=" . @$_GET['id'] . "'>>></a></li>";
                            echo "<li class='page-item'><a class='page-link' href='gestion_membres1.php?page=" . $total_pages . "&id=" . @$_GET['id'] . "'>Fin</a></li>";
                            echo "</ul>";
                            echo "</nav>";
                        }
                        if ($page > $total_pages) {
                            header('location: gestion_membres1.php?page=1');
                            exit();
                        }
        ?>

    <?php else : ?>
        <div class="mt-4 alert alert-info">Il n'y a pas encore de membre</div>
    <?php endif; ?>
    </div>

    <hr class="mb-1">
    <div class="col-4 fs-4">
        <?php
        $req = sql("SELECT COUNT(*)  FROM membre where civilite= 'f';");
        $countF = $req->fetch();
        $nbf = intval(implode("','", $countF));
        $req1 = sql("SELECT COUNT(*)  FROM membre");
        $count = $req1->fetch();
        $nbh = intval(implode("','", $count)) - $nbf;
        echo "Il y a actuellement $nbf membres femmes et $nbh hommes."; ?>
    </div>
</div>

<?php
//traitement des GET pour la modification des données membres
if (!empty($_GET['id'])) {

    if (is_numeric(intval($_GET['id']))) {
        $get = $_GET['id'];
        $id_membre = intval($get);

        // Requêtes de sélection des données de l'annonce cliqué par l'utilisateur
        $membres3 = sql("SELECT * FROM membre WHERE  $id_membre = id_membre");
    }
}
?>

<form action="" method="post" id="formulaire" class="container-fluid mb-5">
    <?php if ($membres3->rowCount() > 0) : ?>

        <?php while ($membre3 = $membres3->fetch()) : ?>

            <h3 class="mt-3"><span class="fs-3 far fa-address-card">&nbsp;&nbsp;<?= $membre3['pseudo']  ?>&nbsp;<?= $membre3['id_membre']  ?></span> </h3>
            <div class="row row-cols-1 row-cols-md-2 editform border rounded p-2 m-2">
                <div class="col">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control w-50" name="pseudo" placeholder="">
                    <label for="nouveauMdp" class="form-label">Nouveau Mot de passe</label>
                    <input type="password" class="form-control w-50" name="nouveauMdp" minlength="8" maxlength="20">
                </div>
                <div class="col">
                    <label for="nouveauEmail" class="form-label">Nouvel Email</label>
                    <input type="email" class="form-control w-50" name="nouveauEmail" placeholder="">
                    <label for="nouveauTele" class="form-label">Nouveau # de Téléphone</label>
                    <input type="text" class="form-control w-50" name="nouveauTele" minlength="10" maxlength="10" placeholder="">
                </div>
                <div class="col">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control w-50" name="nom" placeholder="">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control w-50" name="prenom" value="" placeholder="">
                </div>


                <div class="col">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="radio" name="civilite" id="civilite1" value="f">
                        <label class="form-check-label" for="civilite1">
                            Civilité : Femme
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="civilite" id="civilite2" value="h">
                        <label class="form-check-label" for="civilite2">
                            Civilité : Homme
                        </label>
                    </div>


                    <!-- demande de confirmation pour le passage du membre en statut d'administrateur -->
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="radio" name="statut" id="statut1" value="1" onclick="return confirm('&#x26A0; Comfirmez vous le passage de ce membre au statut d`administrateur ?')">
                        <label class="form-check-label" for="statut1">
                            Statut : administrateur
                        </label>
                    </div>
                    <div class="form-check justify-content-between">
                        <input class="form-check-input" type="radio" name="statut" id="statut2" value="0">
                        <label class="form-check-label" for="statut2">
                            Statut : membre
                        </label>
                        <input type="submit" value="modifier" name="modifier" class="btn btn-primary ms-5 w-25">
                    </div>
                </div>
                <div class="container h-100"></div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>
</form>

<?php
require_once('../includes/footer.php');
