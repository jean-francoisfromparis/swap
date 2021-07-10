<?php

require_once('../includes/init.php');
if (!isAdmin()) {
    header('location:' . URL . 'index.php');
    exit();
}
//suppression des notes
if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])) {

    sql("DELETE FROM note WHERE id_note=:id", array(
        'id' => $_GET['id']
    ));
    add_flash("👍 La note a été supprimée", 'success');
    header('location: gestion_notes.php?page=1');
    exit();
}


//Gestion de la modification des notes - afin d'éviter des conflits dans la base de données seul les champs note et avis peuvent être modifié.
if (isset($_POST)) {
    $errors = 0;
    if (!empty($_POST['avis']) && $_POST['avis'] !='' ) {
        $errors = 0;
        if (strlen($_POST['avis']) > 300) {
            $errors++;
            add_flash('&#9888; Veuillez déposer un avis comportant mois de 300 caractéres', 'danger');
        } else {
            $errors = 0;
            $avis = valid_donnees($_POST['avis']);
            sql("UPDATE `note` SET`avis`=:avis WHERE `id_note` = $_POST[id_note]", array(
                'avis' =>  $avis
            ));
            add_flash("👍 L'avis a bien été modifié", 'success');
            header('location: gestion_notes.php?page=1');
            exit();
        }
       
    }
    
    if (!empty($_POST['note']) && intval($_POST['note']) > 0 && intval($_POST['note']) < 6) {
        $errors = 0;
        $note = valid_donnees($_POST['note']);
        sql("UPDATE `note` SET`note`=:note WHERE `id_note` = $_POST[id_note]", array(
            'note' =>  $note
        ));
        add_flash("👍 La note a bien été modifié", 'success');
        header('location: gestion_notes.php?page=1');
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
//récupération des requêtes pour la pagination
$query = "SELECT * FROM note order by id_note DESC LIMIT $start_from, $record_per_page";
$result = sql($query);

//Selection des notes à afficher
$notes = sql("SELECT * FROM note ORDER BY id_note DESC LIMIT $start_from, $record_per_page");


$title = "Gestion des notes";
require_once('../includes/haut.php');
?>
<div class="container-fluid titre1 " style="width:100vw">

    <div class="row text-center">
        <h1 class="mt-3">Gestion des notes</h1>
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
                    <th style="width:3rem">id_note</th>
                    <th style="width:3rem">membre_id1</th>
                    <th style="width:10rem">Pseudo du membre évalué</th>
                    <th style="width:3rem">membre_id2</th>
                    <th style="width:10rem">Pseudo du membre noté</th>
                    <th style="width:6rem">Notes</th>
                    <th style="width:6rem">Notes</th>
                    <th>Avis</th>
                    <th style="width:4rem">Date d'enregistrement</th>
                    <th style="width:3rem"></th>
                    <th style="width:3rem"></th>
                </tr>
            </thead>

            <div class="row">
                <?php if ($notes->rowCount() > 0) : ?>

                    <?php while ($note = $notes->fetch()) : ?>
                        <?php $membres1 = sql("SELECT `pseudo` FROM `membre` WHERE `id_membre`= $note[membre_id1]") ?>
                        <?php $membre1 = $membres1->fetch() ?>
                        <?php $membres2 = sql("SELECT `pseudo` FROM `membre` WHERE `id_membre`= $note[membre_id2]") ?>
                        <?php $membre2 = $membres2->fetch() ?>

                        <form method="POST" class="row mb-2">
                            <tr>
                                <td><input type="hidden" class="form-control text-center" name="id_note" value="<?php echo $note['id_note'] ?>"><?php echo $note['id_note'] ?></td>
                                <td><input type="text" name="membre_id1" class="form-control text-center text-wrap" placeholder="<?php echo $note['membre_id1'] ?>"></td>
                                <td><input type="text" class="form-control text-center text-wrap" placeholder="<?php echo $membre1['pseudo'] ?>"></td>
                                <td><input type="text" name="membre_id2" class="form-control text-center text-wrap" placeholder="<?php echo $note['membre_id2'] ?>"></td>
                                <td><input type="text" class="form-control text-center text-wrap" placeholder="<?php echo $membre2['pseudo'] ?>"></td>
                                <td><input type="text" name="note" class="form-control text-center text-wrap" placeholder="<?php echo $note['note'] ?>"></td>
                                <td style="color:orange"> <?php
                                                            switch ($note['note']) {
                                                                case 5:
                                                                    echo '<span class="far fa-star" data-star="1"></span>
                                                        <span class="far fa-star" data-star="1"></span>
                                                        <span class="far fa-star" data-star="1"></span>
                                                        <span class="far fa-star" data-star="1"></span>
                                                        <span class="far fa-star" data-star="1"></span>';
                                                                    break;
                                                                case 4:
                                                                    echo '<span class="far fa-star" data-star="1"></span>
                                                       <span class="far fa-star" data-star="1"></span>
                                                       <span class="far fa-star" data-star="1"></span>
                                                       <span class="far fa-star" data-star="1"></span>';
                                                                    break;
                                                                case 3:
                                                                    echo '<span class="far fa-star" data-star="1"></span>
                                                      <span class="far fa-star" data-star="1"></span>
                                                      <span class="far fa-star" data-star="1"></span>';
                                                                    break;
                                                                case 2:
                                                                    echo '<span class="far fa-star" data-star="1" ></span>
                                                      <span class="far fa-star" data-star="1" ></span>';
                                                                    break;
                                                                case 1:
                                                                    echo '<span class="far fa-star" data-star="1"></span>';
                                                                    break;
                                                            } ?></td>
                                <td><textarea type="textarea" name="avis" class="form-control text-center text-wrap" placeholder="<?php echo $note['avis'] ?>" rows="2"></textarea></td>
                                <td><input type="text" name="date_enregistrement" class="form-control text-center text-wrap" placeholder="<?php echo $note['date_enregistrement'] ?>"></td>
                                <td style="width:3rem"> <button class="btn btn-info fa fa-edit" name="submit"></button></td>
                                <td style="width:3rem"><a href="gestion_notes.php?action=delete&id=<?= $note['id_note'] ?>"><span class="btn btn-danger  fas fa-trash"></span></a></td>
                            </tr>
                        </form>

                    <?php endwhile; ?>
                    </thead>
        </table>

        <?php
                    $page_query = "SELECT * FROM note ORDER BY id_note DESC";
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
                        echo "<li class='page-item'><a class='page-link' href='gestion_notes.php?page=1'>1<sup>ère<sup></a></li>";
                    }
                    if ($page > 1) {
                        echo "<nav aria-label='Page navigation example mt-5'>";
                        echo "<ul class='pagination'>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_notes.php?page=1'>1<sup>ère<sup></a></li>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_notes.php?page=" . ($page - 1) . "'><<</a></li>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='gestion_notes.php?page=" . $i . " '>" . $i . "</a></li>";
                    }
                    if ($page <= $total_pages) {
                        echo "<li class='page-item'><a class='page-link' href='gestion_notes.php?page=" . ($page + 1) . "'>>></a></li>";
                        echo "<li class='page-item'><a class='page-link' href='gestion_notes.php?page=" . $total_pages . "'>Fin</a></li>";
                        echo "</ul>";
                        echo "</nav>";
                    }
                   
        ?>

    <?php else : ?>
        <div class="mt-4 alert alert-info">Il n'y a pas encore de note</div>
    <?php endif; ?>
    </div>


</div><!-- fin du container -->

<?php
require_once('../includes/footer.php');
