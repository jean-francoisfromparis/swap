<?php

//fuseau horaire
date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL,'fr_FR.utf8','fra.utf8');

// Nom et ouverture de sessions
session_name('SWAP'); // default : PHPSESSID
session_start();

// Connexion BDD
$pdo = new PDO(
    'mysql:host=localhost;charset=utf8;dbname=swap',
    'root',
    '',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    )
);

// Inclusion des fonction du site
require_once('functions.php');

// Constante du site ---- Chemin------
define('URL', '/swap/');

// Récupération du sous-titre du site, son slogan et son image d'entrée en fonction du profil d'utilisateur
/*$recup_infos = sql('SELECT * FROM membre');

if($recup_infos->rowCount() > 0) {
    while($membre = $recup_profil->fetch()) {

        switch ($membre['nom']) {
            case 'title': define('SUBTITLE', $membre['valeur']); break;
            case 'slogan': define('SLOGAN', $membre['valeur']); break;
            case 'header': define('HEADER', $membre['valeur']); break;
        }

    }
}


