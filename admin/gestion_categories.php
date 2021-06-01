<?php

require_once('../includes/init.php');
if(!isAdmin()){
    header('location:'.URL.'connexion.php');
    exit();
}
// Suppression ($_GET)
if( isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id']) && is_numeric($_GET['id'])){
    sql("DELETE FROM categorie WHERE id_categorie=:id",array(
        'id' => $_GET['id']
    ));
    add_flash('👍 La catégorie a été supprimée','success');
    header('location:'.$_SERVER['PHP_SELF']);
    exit();    
}
// Traitement des formulaires
if(!empty($_POST)){

    // Formulaire d'ajout soumis
    if(isset($_POST['ajouter'])){

        if(!empty($_POST['titre'])){
            
            $titre       = valid_donnees($_POST['titre']);
            $motscles    = valid_donnees($_POST['motscles']);
            
            sql("INSERT INTO categorie VALUES (NULL,:titre,:motscles)", array(
                'titre'     => $titre,
                'motscles' => $motscles
            ));
            add_flash('👍 La catégorie '.$_POST['titre'].' a été ajoutée','success');
            header('location:'.$_SERVER['PHP_SELF']);
            exit();
        }
        else{
            add_flash('La catégorie ne doit pas être vide','danger');
        }
    }    // Formulaire d'update soumis
        if(isset($_POST['update'])){
            if(!empty($_POST['categorie'])){

                $nouveaunom  = valid_donnees($_POST['categorie']);
                $newMotsCles = valid_donnees($_POST['newMotsCles']);

                sql("UPDATE categorie SET titre=:nouveaunom, motscles=:newMotsCles  WHERE id_categorie=:id_categorie",array(
                    'nouveaunom'  => $nouveaunom,
                    'newMotsCles' => $newMotsCles,
                    'id_categorie'=> $_POST['id_categorie']
                ));
                add_flash("La catégorie a été mise à jour",'success');
                header('location:'.$_SERVER['PHP_SELF']);
                exit();
            }
            else{
                add_flash('La catégorie ne doit pas être vide','danger');
            }
        }
}

$categories = sql("SELECT * FROM categorie ORDER BY id_categorie");

$title= "Gestion des Catégories";
require_once('../includes/haut.php');
?>
<div class="container-fluid titre1">
<?php if (!empty(show_flash())) : ?>
    <div class="row justify-content-center">
        <div class="col">
            <?php echo show_flash('reset'); ?>
        </div>
    </div>
<?php endif; ?>

    <div class="row text-center">
        <h1>Gestion des catégories</h1>
        <hr class="mb-2">
    </div>
    <div class="row justify-content-center">
    <div class="col">
        <h3>Insertion des catégories</h3>
        <hr class="my-2">
        <form method="POST" action="" class="row">
            <div class="col-8 mb-2">
                <label for="titre" class="mb-2">Titre</label>
                <input type="text" id="titre" name="titre" class="form-control mb-2" placeholder="catégorie à ajouter">
                <label for="motscles" class="mb-2">Description</label>
                <textarea type="text" id="motscles" name="motscles" class="form-control mb-2" placeholder="courte description" rows="2"></textarea>
                <button type="submit" name="ajouter" class="btn btn-primary my-2">Ajouter</button>
            </div>
        </form>
        <?php if($categories->rowCount() > 0 ) : ?>
            <h2>Liste des catégories</h2>
            <?php while( $categorie = $categories->fetch() ) : ?>

                <form method="POST" class="row mb-2">
                    <div class="col-1">
                        <input type="" name="id_categorie" class="form-control text-center" value="<?php echo $categorie['id_categorie'] ?>">
                    </div>
                    <div class="col-sm-2 col-lg-3">
                        <input type="text" id="categorie" name="categorie" class="form-control text-center" value="<?php echo $categorie['titre'] ?>">
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <input type="text" id="newMotsCles" name="newMotsCles" class="form-control text-center" value="<?php echo $categorie['motscles'] ?>">
                    </div>
                    <div class="col-2">
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                        </button>
                        <a href="?action=delete&id=<?php echo $categorie['id_categorie'] ?>" class="btn btn-danger confirm">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </form>

            <?php endwhile; ?>

        <?php else : ?>
            <div class="mt-4 alert alert-info">Il n'y a pas encore de catégorie</div>
        <?php endif; ?>

    </div>
   



</div>
<?php
require_once('../includes/footer.php');
