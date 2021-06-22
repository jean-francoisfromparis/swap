<?php

require_once('includes/init.php');
require_once('fetch_data.php');



$title = "Annonce";
require_once('includes/haut.php');
?>
<div class="container titre1">
    <div class="row text-center ">
        <h1 onload="init()">Annonces</h1>
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
<div class="container">
        <div class="row">
            <div class="col-md-3"> 

                <div class="list-group">
                     <h3>Trier par prix</h3>
                     <input type="hidden" id="hidden_minimum_price" value="1" />
                    <input type="hidden" id="hidden_maximum_price" value="3000000" />
                    <p id="price_show">1 - 3000000</p>
                        <div id="price_range"></div>
                </div>
                <div class="list-group mt-4">
                    <h3>Trier par catégorie</h3>
                        <ul class="list-group list-group-flush" style="height: 180px; overflow-y: scroll; overflow-x: hidden;">
                            <?php
                                        $categories = sql ("SELECT * FROM categorie ORDER BY id_categorie");
                                            $categorie = $categories->fetchAll();
                                            foreach($categorie as $row)
                                            {
                                            ?>
                                            <li class="list-group-item checkbox">
                                                <label><input type="checkbox" class="common_selector categorie" value="<?php echo $row['id_categorie']; ?>"  > <?php echo $row['titre']; ?></label>
                                            </li>
                                            <?php
                                            }

                                            ?>
                                        
                       
                </div>
                <div class="list-group mt-4">
                    <h3>Trier par région</h3>
                        <ul class="list-group list-group-flush " style="height: 180px; overflow-y: scroll; overflow-x: hidden;">
                            <?php
                                        $regions = sql ("SELECT DISTINCT region FROM annonce ORDER BY region ASC");
                                            $region = $regions->fetchAll();
                                            foreach($region as $row)
                                            {
                                            ?>
                                            <li class="list-group-item checkbox">
                                                <label><input type="checkbox" class="common_selector region" value="<?php echo $row['region']; ?>"  > <?php echo $row['region']; ?></label>
                                            </li>
                                            <?php
                                            }

                                            ?>
                        </ul>
                </div>  
                <div class="list-group mt-3">
                <h3>Tris divers</h3>
                        <ul class="list-group list-group-flush " style="height: 180px; overflow-x: hidden;">
                            <li class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector divers" value="1"  > Prix par ordre croissant </label>
                                <label><input type="checkbox" class="common_selector divers" value="2"  > Prix par ordre décroissant </label>
                                <label><input type="checkbox" class="common_selector divers" value="3"  > Par date croissante</label>
                                <label><input type="checkbox" class="common_selector divers" value="4"  > Par date décroissante</label>
                            </li>
                        </ul>
                </div>  
            

            </div>
            <div class="col-md-9">
                <div class="row data_filtrer">

                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('includes/footer.php');