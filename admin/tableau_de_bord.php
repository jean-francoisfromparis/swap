<?php

require_once('../includes/init.php');
$annee = (int)date('Y');
$annee_selection = empty($_GET['annee']) ? $annee : (int)$_GET['annee'];
$mois_selection = empty($_GET['mois']) ? (int)date('m') : (int)$_GET['mois'];

if ($annee_selection && $mois_selection) {
    $total = nombre_vues_mois($annee_selection, $mois_selection);
    $detail = nombre_vues_details_mois($annee_selection, $mois_selection);
} else {
    $total = nombre_vues();
}

$mois = [
    '01' => 'janvier',
    '02' => 'Février',
    '03' => 'Mars',
    '04' => 'Avril',
    '05' => 'Mai',
    '06' => 'Juin',
    '07' => 'Juillet',
    '08' => 'Août',
    '09' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre'
];


$title = "Tableau de bord";
require_once('../includes/haut.php');
?>
<div class="container titre1 mt-5">
    <div class="row text-center ">
        <h1>Tableau de Bord</h1>
        <hr class="mb-5">


    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <?php for ($i = 0; $i < 4; $i++) : ?>
                    <a class="list-group-item <?= $annee - $i === $annee_selection ? 'active' : ''; ?> " href="tableau_de_bord.php?annee=<?= $annee - $i ?>"> <?= $annee - $i ?> </a>
                    <?php if ($annee - $i === $annee_selection) :   ?>
                        <div class="list-group">
                            <?php foreach ($mois as $numero => $nom) : ?>
                                <a class="list-group-item <?= $numero == $mois_selection ? 'active' : '' ?>" href="tableau_de_bord.php?annee=<?= $annee_selection ?>&mois=<?= $numero ?>"><?= $nom ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                <?php endfor ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <strong class="fs-4"><?= $total ?></strong><br>
                    visite<?= $total > 1 ? 's' : ''  ?> total
                </div>
            </div>
            <?php if (isset($detail)) : ?>
                <h2>Détails des visites du site pour le mois</h2>
                <table class="table table-striped table-hover w-50">
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Nombre de visite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail as $ligne) : ?>
                            <tr>
                                <td><?= $ligne['jour'] ?></td>
                                <td><?= $ligne['visites'] ?> Visite<?= $ligne['visites'] > 1 ? 's' : '' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>


<?php
require_once('../includes/footer.php');
