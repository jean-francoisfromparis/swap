<?php

require_once('../includes/init.php');

if (!isAdmin()) {
    header('location:' . URL . 'connexion.php');
    exit();
}
//gestion du bouton de sppression d'une annonce
if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    sql("DELETE FROM annonce WHERE id_annonce=:id", array(
        'id' => $_GET['id']
    ));
    add_flash("👍 L'annonce a été supprimée", 'success');
    header('location: admin/gestion_annonces.php');
    exit();
}


$record_per_page = 4;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;

$query = "SELECT * FROM annonce order by id_annonce DESC LIMIT $start_from, $record_per_page";
$result = sql($query);

$annonces = sql("SELECT * FROM annonce ORDER BY id_annonce DESC LIMIT $start_from, $record_per_page ");

$title = "Gestion des Annonces";
require_once('../includes/haut.php');
?>
<div class="container-fluid titre1 " style="width:100vw">
    <div class="row text-center">
        <h1 class="mt-2">Gestion des Annonces</h1>
        <hr class="mb-2">
    </div>
    <?php if (!empty(show_flash())) : ?>
        <div class="row justify-content-center">
            <div class="col">
                <?= show_flash('reset'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="table">
        <table class="table table-striped text-annonce align-middle">
            <thead>
                <tr>
                    <th><?= ucfirst('id')         ?></th>
                    <th><?= ucfirst('titre')              ?></th>
                    <th><?= ucfirst('description courte') ?></th>
                    <th><?= ucfirst('description longue') ?></th>
                    <th><?= ucfirst('prix')               ?></th>
                    <th><?= ucfirst('photo')              ?></th>
                    <th><?= ucfirst('region')             ?></th>
                    <th><?= ucfirst('ville')              ?></th>
                    <th><?= ucfirst('adresse')            ?></th>
                    <th><?= ucfirst('code postal')        ?></th>
                    <th><?= ucfirst('membre')          ?></th>
                    <th><?= ucfirst('categorie')       ?></th>
                    <th><?= ucfirst('date enregistrement')?></th>
                    <th><?= ucfirst('Supprimer')?></th>
                    <th><?= ucfirst('Modifier')?></th>
                </tr>
            </thead>
            <tbody>
                <!-- injection des données des tables annonce membre et categorie -->
                <?php if ($annonces->rowCount() > 0) : ?>
                    <?php while ($annonce = $annonces->fetch()) : ?>
                        <?php $membres  = sql("SELECT `id_membre`,`pseudo` FROM `membre` WHERE id_membre = $annonce[membre_id]"); ?>
                        <?php if ($membres->rowCount() > 0) : ?>
                            <?php while ($membre = $membres->fetch()) : ?>
                                <?php $categories  = sql("SELECT `id_categorie`, `titre` FROM `categorie` WHERE id_categorie = $annonce[categorie_id]"); ?>
                                <?php if ($categories->rowCount() > 0) : ?>
                                    <?php while ($categorie = $categories->fetch()) : ?>
                                        <tr>
                                            <td><span><?= $annonce['id_annonce'] ?></span></td>
                                            <td><span><?= $annonce['titre'] ?></span></td>
                                            <td class="text-break" style="width:150px;"><span><?= $annonce['description_courte'] ?></span></td>
                                            <td class="" style="width:500px;"><span><?= $annonce['description_longue'] ?></span></td>
                                            <td><span><?= $annonce['prix'] ?></span></td>
                                            <td><span><img src="../includes/img/<?= $annonce['photo'] ?>" class="img-fluid rounded img-thumbnail image1" alt="$annonce[photo]"></span></td>
                                            <td><span><?= $annonce['region'] ?></span></td>
                                            <td><span><?= $annonce['ville'] ?></span></td>
                                            <td><span><?= $annonce['adresse'] ?></span></td>
                                            <td><span><?= $annonce['cp'] ?></span></td>
                                            <td><span><?= $membre['pseudo'] ?></span></td>
                                            <td><span><?= $categorie['titre'] ?></span></td>
                                            <td><span><?= $annonce['date_enregistrement'] ?></span></td>
                                            <td><a href="?action=delete&id=<?= $annonce['id_annonce'] ?>" class="btn btn-danger fas fa-trash"></a></td>
                                            <td><a href="edit_annonce.php?id=<?= intval($annonce['id_annonce']) ?>" class="btn btn-info far fa-eye"></a></td>
                                        </tr>
                                    <?php endwhile ?>
                                <?php endif ?>
                            <?php endwhile ?>
                        <?php endif ?>
                    <?php endwhile ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<div>
<!-- Pagination  -->
    <?php
    $page_query = "SELECT * FROM annonce ORDER BY id_annonce DESC";
    $page_result = sql($page_query);
    $total_records = $page_result->rowCount();
    $total_pages = ceil($total_records / $record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if ($difference <= 5) {
        $start_loop = $total_pages - 1;
    }
    $end_loop = $start_loop + 2;
    if ($page >= 1) {
        echo "<nav aria-label='Page navigation example mt-5'>";
        echo "<ul class='pagination'>";
        echo "<li class='page-item'><a class='page-link' href='gestion_annonces.php?page=1'>1<sup>ère<sup></a></li>";
        echo "<li class='page-item'><a class='page-link' href='gestion_annonces.php?page=" . ($page - 1) . "'><<</a></li>";
    }
    for ($i = $start_loop; $i <= $end_loop; $i++) {
        echo "<li class='page-item'><a class='page-link' href='gestion_annonces.php?page=" . $i . "'>" . $i . "</a></li>";
    }
    if ($page <= $total_pages) {
        echo "<li class='page-item'><a class='page-link' href='gestion_annonces.php?page=" . ($page + 1) . "'>>></a></li>";
        echo "<li class='page-item'><a class='page-link' href='gestion_annonces.php?page=" . $total_pages . "'>Fin</a></li>";
        echo "</ul>";
        echo "</nav>";
    }


    ?>

    <?php
    require_once('../includes/footer.php');
