<?php

require_once('includes/init.php');










$categories = sql("SELECT * FROM categorie ORDER BY id_categorie");
$allAnnonces = sql("SELECT * FROM annonce ORDER BY id_annonce");
$nbAnnoncesParPage = 4;
$totalAnnonces = $allAnnonces->rowcount();

$totalPages = ceil($totalAnnonces / $nbAnnoncesParPage);
if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}
$depart = ($pageCourante - 1) * $nbAnnoncesParPage;
$annonces = sql('SELECT * FROM annonce ORDER BY id_annonce');
// // $annonces = sql(
// //     'SELECT annonce.*, pseudo AS membre, categorie.titre AS categorie FROM annonce  
// // LEFT JOIN membre ON membre.id_membre = annonce.membre_id
// LEFT JOIN categorie ON categorie.id_categorie = annonce.categorie_id 
// ORDER BY annonce.id_annonce ',
//     array(
//         'triCategorie' => $_GET['triCategorie']
//     ));
$annonce = $annonces->fetchAll();
$export = json_encode($annonce,JSON_PRETTY_PRINT);
file_put_contents('annonces.json',$export);    
$title = "Annonce";
require_once('includes/haut.php');
?>
<div class="container titre1">
    <div class="row text-center ">
        <h1>Annonces</h1>
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
<section id="annonce">
    <form action="" method="GET">
        <div class="container mt-3 ">
            <div class="row col-5 justify-content-center ">
                <div class=" mb-4 col-6 position-relative">
                    <input type="text" class="form-control bg-transparent position-absolute top-50 start-100 ms-5 fs-5" list="datalistOptions" id="triselect" name="triselect" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        <option value="Prix par ordre croissant">
                        <option value="Prix par ordre décroissant">
                        <option value="Par date croissante">
                        <option value="Par date décroissante">
                        <option value="Chicago">
                    </datalist>


                </div>
            </div>

        </div>

        <div class="container-fluid mt-4">
            <div class="row row-cols-2">
                <div class="col-5">
                    <!-- 1er card  -->
                    <div class="card rounded mb-3">
                        <div class="card-body">
                            <div class="input-group mb-4">
                                <?php if ($categories->rowCount() > 0) : ?>
                                    
                                    <select type="select" class="form-select bg-transparent w-50 fs-5" id="triCategorie" name="triCategorie">
                                        <option value="0" selected>Sélectionnez la catégorie</option>
                                        <?php while ($categorie = $categories->fetch()) : ?>
                                            <?php echo (' <option value="' . $categorie['id_categorie'] . '">' . $categorie['titre'] . '</option>') ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    </select>
                            </div>
                            <div class="input-group mb-4">
                               
                                <select class="form-select bg-transparent w-50 fs-5" id="inputGroupSelect03" name="triRegion" type="select">
                                    <option value="0" selected>Sélectionnez la région</option>
                                    <option value="1">Auvergne-Rhône-Alpes</option>
                                    <option value="2">Bourgogne-Franche-Comté</option>
                                    <option value="3">Bretagne                </option>
                                    <option value="4">Centre-Val de Loire</option>
                                    <option value="5">Corse            </option> 
                                    <option value="6">Grand Est        </option> 
                                    <option value="7">Guyane           </option> 
                                    <option value="8">Hauts-de-France  </option> 
                                    <option value="9">Ile-de-France    </option> 
                                    <option value="10">La Réunion       </option> 
                                    <option value="11">Martinique       </option> 
                                    <option value="12">Mayotte          </option> 
                                    <option value="13">Normandie        </option> 
                                    <option value="14">Nouvelle-Aquitaine</option>
                                    <option value="15">Occitanie         </option>
                                    <option value="16">Pays de la Loire  </option>
                                    <option value="17"> Provence-Alpes-Côte d'Azur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- 2eme card  -->
                    <div class="card rounded mb-3">
                        <div class="card-body">
                            <div class="input-group mb-4">
                                <label class="input-group-text  btn-outline-secondary bg-transparent  fs-5" for="inputGroupSelect04">Trier par membres :</label>
                                <input class="form-select btn-outline-secondary bg-transparent w-50 fs-5" list="datalistRegions" id="inputGroupSelect04" name="triMembre">
                                <datalist id="datalistRegions">
                                   
                                </datalist>
                                <div class="my-4">
                                    <label for="customRange2" class="form-label">Trier par prix :</label>
                                    <input type="range" class="form-range" min="0" max="100000000" step="1000" id="customRange2" name="triPrix" style="width:38vh">
                                    <button type="submit" class="btn btn-primary w-50" name="trier">Trier</button>
                                    <div class="resultSearch"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

    <div class="col-7">

        <div id="content">
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center align-items-center">
                <li class="page-item"><button class="btn page-link" id="premiere">|<i class="fas fa-caret-left"></i></button></li>
                <li class="page-item">
                    <button class="btn page-link" id="precedente">
                        <span aria-hidden="true">&laquo;</span>
                    </button>
                </li>
                <span id="infoPage"></span>
                <li class="page-item">
                    <button class="btn page-link" id="suivante">
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
                <li class="page-item"><button class="btn page-link " id="derniere"><i class="fas fa-caret-right"></i>|</button></li>
            </ul>
        </nav>
    </div>
    </div>
    </div>
</section>
<section id="separateur"></section>


































<?php
require_once('includes/footer.php');
