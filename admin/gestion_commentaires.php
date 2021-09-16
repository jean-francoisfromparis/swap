<?php

require_once('../includes/init.php');
if (!isAdmin()) {
    header('location:' . URL . 'index.php');
    exit();
}
if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    sql("DELETE FROM commentaire WHERE id_commentaire=:id", array(
        'id' => $_GET['id']
    ));
    add_flash("👍 Le commentaire a été supprimée", 'success');
    header('location: gestion_commentaires.php');
    exit();
}





//Gestion de la modification des commentaires - Bien que seuls les commentaires licencieux, injurieux ou mensongers soit légalement susceptible de modifications ou de censures. Nous donnons donc ici la possibilité à l’administrateur de modifier uniquement le champs commentaires (hors id).

if(isset($_POST))
{
    $errors = 0;
    if(!empty($_POST['commentaire']) && $_POST['commentaire'] != '')
    {
        $errors = 0;
        if(strlen($_POST['commentaire']) > 300)
        {
            $errors ++;
            add_flash('&#9888; Veuillez déposer un commentaire comportant mois de 300 caractéres', 'danger');
        }
        else
        { $errors = 0;

            $commentaire = valid_donnees($_POST['commentaire']);
            sql("UPDATE `commentaire` SET`commentaire`=:commentaire WHERE `id_commentaire` = $_POST[id_commentaire]", array(
                'commentaire' =>  $commentaire
            ));

        }
        add_flash("👍 Le commentaire a été modifié", 'success');
        header('location: gestion_commentaires.php');
        exit();
    }


}

//initialisation de la pagination
$record_per_page = 5;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$query = "SELECT * FROM commentaire order by id_commentaire DESC LIMIT $start_from, $record_per_page";
$result = sql($query);

//Selection des commentaires à afficher
$commentaires = sql("SELECT * FROM commentaire ORDER BY id_commentaire DESC LIMIT $start_from, $record_per_page");



$title = "Gestion des commentaires";
require_once('../includes/haut.php');
?>
<div class="container-fluid titre1 " style="width:100vw">

    <div class="row text-center">
        <h1 class="mt-3">Gestion des Commentaires</h1>
        <hr class="mb-2">
    </div>
    <?php if (!empty(show_flash())) : ?>
        <div class="row justify-content-center">
            <div class="col">
                <?php echo show_flash('reset'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="table-responsive-md mt-3">
        <table class="table table-striped text-center table-hover mt-3 align-middle">
            <thead class="text-center ">
                <tr>
                    <th style="width:3rem">id_commentaire</th>
                    <th style="width:3rem">id_membre</th>
                    <th>Pseudo du membre</th>
                    <th>id_annonce</th>
                    <th>Commentaire</th>
                    <th>Date d'enregistrement</th>
                    <th style="width:3rem"></th>
                    <th style="width:3rem"></th>
                </tr>
            </thead>

            <div class="row">
                <?php if ($commentaires->rowCount() > 0) : ?>

                    <?php while ($commentaire = $commentaires->fetch()) : ?>
                        <?php $membres = sql("SELECT `pseudo` FROM `membre` WHERE `id_membre`= $commentaire[membre_id]") ?>
                        <?php $membre = $membres->fetch() ?>

                        <form method="POST" class="row mb-2">
                            <tr>
                                <td><input type="hidden" class="form-control text-center" name="id_commentaire" value="<?php echo $commentaire['id_commentaire'] ?>"><?php echo $commentaire['id_commentaire'] ?></td>
                                <td><input type="text" name="membre_id" class="form-control text-center text-wrap" placeholder="<?php echo $commentaire['membre_id'] ?>"></td>
                                <td><input type="text" class="form-control text-center text-wrap" placeholder="<?php echo $membre['pseudo'] ?>"></td>
                                <td><input type="text" name="annonce_id" class="form-control text-center text-wrap" placeholder="<?php echo $commentaire['annonce_id'] ?>"></td>
                                <td><textarea type="textarea" name="commentaire" class="form-control text-center text-wrap" placeholder="<?php echo $commentaire['commentaire'] ?>" rows="3"></textarea></td>
                                <td><input type="text" name="date_enregistrement" class="form-control text-center text-wrap" placeholder="<?php echo $commentaire['date_enregistrement'] ?>"></td>
                                <td style="width:3rem"> <button class="btn btn-info fa fa-edit" name="submit"></button></td>

                                <td style="width:3rem"><a href="gestion_commentaires.php?action=delete&id=<?= $commentaire['id_commentaire'] ?>" ><span class="btn btn-danger  fas fa-trash" ></span></a></td>
                            </tr>
                        </form>

                    <?php endwhile; ?>
                    </thead>
        </table>

        <?php
                    $page_query = "SELECT * FROM commentaire ORDER BY id_commentaire DESC";
                    $page_result = sql($page_query);
                    $total_records = $page_result->rowCount();
                    $total_pages = floor($total_records / $record_per_page);
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if ($difference <= 2) {
                        $start_loop = $total_pages - 1;
                    }
                    $end_loop = $start_loop + 1;
                    if ($page == 1) {
                        echo "<nav aria-label='Page navigation example mt-5'>";
                        echo "<ul class='pagination'>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_commentaires.php?page=1'>1<sup>ère<sup></a></li>";
                    }
                    if ($page > 1) {
                        echo "<nav aria-label='Page navigation example mt-5'>";
                        echo "<ul class='pagination'>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_commentaires.php?page=1'>1<sup>ère<sup></a></li>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_commentaires.php?page=" . ($page - 1) . "'><<</a></li>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='gestion_commentaires.php?page=" . $i . " '>" . $i . "</a></li>";
                    }
                    if ($page <= $total_pages) {
                        echo "<li class='page-item'><a class='page-link' href='gestion_commentaires.php?page=" . ($page + 1) . "'>>></a></li>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_commentaires.php?page=" . $total_pages . "'>Fin</a></li>";
                        echo "</ul>";
                        echo "</nav>";
                    }

                    if ($page > $total_pages) {
                        header('location: gestion_commentaires.php');
                        exit();
                    }
        ?>

    <?php else : ?>
        <div class="mt-4 alert alert-info">Il n'y a pas encore de commentaires</div>
    <?php endif; ?>
    </div>


    <?php
    //traitement des GET pour la modification des commentaires
    if (!empty($_GET['id'])) {

        if (is_numeric(intval($_GET['id']))) {
            $get = $_GET['id'];
            $id_commentaire = intval($get);

            // Requêtes de sélection des données de l'annonce cliqué par l'utilisateur
            $commentaires1 = sql("SELECT * FROM commentaire WHERE $id_commentaire = id_commentaire");
        }
    }
    ?>



</div><!-- fin du container -->

<?php
require_once('../includes/footer.php');
