<?php
require_once('includes/init.php') ;
if (!isConnected()) {
	header ('Location:'.URL.'index.php');
	exit();}

//Traitement des suppressions de profil
if(isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_SESSION['user']['id_membre']) && is_numeric($_SESSION['user']['id_membre'])){
       
    sql("DELETE FROM membre WHERE id_membre=:id_membre", array(
            'id_membre' => $_SESSION['user']['id_membre']
    ));
    add_flash("Votre profil on été supprimé. Merci d'avoir été un de nos membre. A bientôt !", 'success');
    session_destroy();
    header('Location:'.URL.'index.php');
    exit();
}

//Traitement du modifications demandés dans le profil

if (!empty($_POST)){

    // Formulaire données personnelles
    if (isset($_POST['update_perso'])) {

        $errors = 0;
        if (empty($_POST['pseudo'])) {
            $errors++;
            add_flash('&#9888; Merci de saisir de pseudo', 'danger');
        } else {

            $user = getUserByLogin($_POST['pseudo']);
            if ($user && $user['id_membre'] != $_SESSION['user']['id_membre']) {
                $errors++;
                add_flash('&#9888; Le pseudo est indisponible pour changer de profil', 'danger');
            }
        }

        if (empty($_POST['email'])) {
            $errors++;
            add_flash("&#9888; L'email ne peut pas etre vide", 'danger');
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors++;
                add_flash("&#9888; L'adresse mail saisie est invalide", 'danger');
            }
        }if (empty($_POST['telephone']) && !empty($_SESSION['user']['telephone'])){
             $_POST['telephone'] = $_SESSION['user']['telephone'];
        }

        if ($errors == 0) {

            $pseudo         = valid_donnees($_POST['pseudo']);
            $telephone      = valid_donnees($_POST['telephone']);
            $email          = valid_donnees($_POST['email']);

            sql("UPDATE membre SET pseudo=:pseudo , email=:email, telephone=:telephone WHERE id_membre=:id_membre", array(
                'pseudo'    => $pseudo,
                'telephone' => $telephone,
                'email'     => $email,
                'id_membre' => $_SESSION['user']['id_membre']
            ));
            $_SESSION['user']['pseudo']     = $pseudo;
            $_SESSION['user']['telephone']  = $telephone;
            $_SESSION['user']['email']      = $email;
            add_flash('👍 Vos informations ont été mises à jour', 'success');
        }
    }

    // Formulaire mot de passe
    if (isset($_POST['update_password'])) {

        $errors = 0;


        if (empty($_POST['mdp'])) {
            $errors++;
            add_flash('&#9888; Merci de saisir votre mot de passe actuel', 'danger');
        } else {
            if (!password_verify($_POST['mdp'], $_SESSION['user']['mdp'])) {
                $errors++;
                add_flash('&#9888 Mot de passe incorrect', 'danger');
            }
        }

        if (empty($_POST['newMdp'])) {
            $errors++;
            add_flash('&#9888; Merci de saisir un nouveau mot de passe', 'danger');
        } else {
            $pattern = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\S]{8,20}$#';
            if (!preg_match($pattern, $_POST['newMdp'])) {
                $errors++;
                add_flash('&#9888; Le nouveau mot de passe doit être composé de 8 à 20 caractères comprenant au moins une minuscule, une majuscule et un chiffre', 'danger');
            }
        }


        if (empty($_POST['confirmation'])) {
            $errors++;
            add_flash('&#9888; Merci de confirmer votre mot de passe', 'danger');
        } else {
            if (!empty($_POST['newMdp']) && ($_POST['confirmation'] !== $_POST['newMdp'])) {
                $errors++;
                add_flash('&#9888; La confirmation ne concorde pas avec le mot de passe', 'danger');
            }
        }

        if ($errors == 0) {

            $mdp = valid_donnees(password_hash($_POST['newMdp'], PASSWORD_DEFAULT));

            sql("UPDATE users SET mdp=:mdp  WHERE id_user=:id_user", array(
                'mdp' => $mdp,
                'id_user' => $_SESSION['user']['id_user']
            ));
            $_SESSION['user']['mdp']  =  $mdp;
            add_flash('👍 Votre mot de passe a été mise à jour', 'success');
        }
    }
}

$title= "Profil";
require_once('includes/haut.php');
?>
<div class="container-fluid titre1">
    <div class="row text-center">
        <h1>Bienvenue sur votre profil</h1>
        <hr class="mb-3">
    </div>
    <div class="row mt-3">
        <h2 class="text-start">Infos sur votre profil</h2>
        <hr class="mb-3">
    </div>

<!-- formulaire de modification de profil  -->


<form class="mt-5" method="POST">
<?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-6">
        <h2>Modifier les infos personnelles</h2>
        <hr class="mb-3">
        <form method="post">

            <div class="mb-3">
                <label for="login">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" class="form-control" value="<?php echo $_SESSION['user']['pseudo'] ?>">
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $_SESSION['user']['email'] ?>">
            </div>

            <div class="mb-3">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" class="form-control" value="<?php echo $_SESSION['user']['telephone'] ?>" minlength="10" maxlength="10">
            </div>
            <button class="btn btn-primary" name="update_perso">Mettre à jour</button>

        </form>

    </div>
    <div class="col-md-6">
        <h2>Modifier mon mot de passe</h2>
        <hr class="mb-3">

        <form method="post">

            <div class="mb-3">
                <label for="mdp">Mot de passe actuel</label>
                <input type="password" id="mdp" name="mdp" class="form-control" minlength="8"  maxlength="20">
            </div>
            <div class="mb-3">
                <label for="newpassword">Nouveau mot de passe</label>
                <input type="password" id="newMdp" name="newMdp" class="form-control" minlength="8"  maxlength="20">
            </div>
            <div class="mb-3">
                <label for="confirmation">Confirmation</label>
                <input type="password" id="confirmation" name="confirmation" class="form-control" minlength="8"  maxlength="20">
            </div>
            <button class="btn btn-primary" name="update_mdp">Mettre à jour</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col pt-4 ">
        <hr class="mb-3">
        <a href="?action=delete" class="btn btn-danger confirm" data-message="Etes-vous sûr(e) de vouloir  supprimer votre compte ? Cette action est irreversible et supprimera toutes vos données personnelles."><i class="fas fa-exclamation-triangle"></i> Supprimer mon compte</a>
    </div>
</div>
</div>


<?php
require_once('includes/footer.php');