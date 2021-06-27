<?php

require_once('../includes/init.php');
if (!isAdmin()) {
    header('location:' . URL . 'connexion.php');
    exit();
}


//Selection des membres à afficher
$membres = sql("SELECT * FROM membre ORDER BY id_membre");
$membres1 = sql("SELECT pseudo FROM membre ORDER BY id_membre");
// récupération du tableau de suggestions des ID pour la recherche
// $stmt = $pdo->query("SELECT pseudo FROM membre WHERE pseudo LIKE '%$_GET[myInputValue]%' ");
// $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $export = json_encode($suggestions,JSON_PRETTY_PRINT);
// file_put_contents('suggestions.json',$export);




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
    <?php var_dump($_POST) ?>
    <div>
        <table class="table-responsive-lg shadow-sm text-center table-hover" id="membres">
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
                                    <td> <button type="submit" name="update" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </button></td>
                                    <td><a href="?action=delete&id=<?php echo $membre['id_membre'] ?>" class="btn btn-danger confirm">
                                            <i class="fas fa-trash"></i>
                                        </a></td>
                                </tr>
                            </form>

                        <?php endwhile; ?>
            </thead>
        </table>
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
    <div class="row row-cols-1 row-cols-md-2 recherchebar border rounded P-2 m-2">
        <div class="col-lg-1 py-2">

            <label for="rechercheParId" class="form-label">par ID</label>
            <input class="form-control " list="datalistId" id="rechercheParId" name="rechercheParId">
            <datalist id="datalistId">
                <?php if ($suggestions->rowCount() > 0) : ?>
                    <?php while ($suggestion = $suggestions->fetch()) : ?>
                        <option value="<?php echo $suggestion['id_membre'] ?>">
                        <?php endwhile; ?>
                    <?php endif; ?>
            </datalist>
        </div>
        <div class="col-lg-3 py-2">
            <?php if ($membres1->rowCount() > 0) : ?>
                <label for="rechercheParPseudo" class="form-label">par Pseudo</label>
                <input class="form-control" list="datalistPseudo" id="rechercheParPseudo" name="rechercheParPseudo" placeholder="">
                <datalist id="datalistPseudo">
                    <?php while ($membre1 = $membres1->fetch()) : ?>
                        <?php echo (' <option  value="' . $membre1['pseudo'] . '">') ?>

                    <?php endwhile; ?>
                <?php endif; ?>
                </datalist>

        </div>
        <button type="submit" class="btn btn-sm btn-primary w-25" id="submit"></button>

    </div>
</form>

<form action="" method="post" id="formulaire" class="container-fluid mb-5">
    <div class="row row-cols-1 row-cols-md-2 editform border rounded p-2 m-2">
        <div class="col">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control w-50" name="pseudo">
            <label for="nouveauMdp" class="form-label">Nouveau Mot de passe</label>
            <input type="password" class="form-control w-50" name="nouveauMdp" minlength="8" maxlength="20">
        </div>
        <div class="col">
            <label for="nouveauEmail" class="form-label">Nouvel Email</label>
            <input type="email" class="form-control w-50" name="nouveauEmail">
            <label for="nouveauTele" class="form-label">Nouveau # de Téléphone</label>
            <input type="text" class="form-control w-50" name="nouveauTele" minlength="10" maxlength="10">
        </div>
        <div class="col">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control w-50" name="nom">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control w-50" name="prenom" value="<?php echo ($membre['id_membre'])  ?>">
        </div>
        <div class="col">
            <div class="form-check mt-4">
                <input class="form-check-input" type="radio" name="civilite1" id="civilite1">
                <label class="form-check-label" for="civilite1">
                    Civilité : Femme
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="civilite2" id="civilite2" checked>
                <label class="form-check-label" for="civilite2">
                    Civilité : Homme
                </label>
            </div>

            <div class="form-check mt-4">
                <input class="form-check-input" type="radio" name="statut1" id="statut1">
                <label class="form-check-label" for="statut1">
                    Statut : administrateur
                </label>
            </div>
            <div class="form-check justify-content-between">
                <input class="form-check-input" type="radio" name="statut2" id="statut2" checked>
                <label class="form-check-label" for="statut2">
                    Statut : membre
                </label>
                <input type="submit" value="Editer" class="btn btn-primary ms-5 w-25">
            </div>
        </div>
        <div class="container h-100"></div>
    </div>
</form>

<?php
require_once('../includes/footer.php');
