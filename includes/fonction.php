<?php
// fonction de requête à bdd
function sql($request, $params = array()) :PDOStatement{
    global $pdo;
    $statement = $pdo -> prepare($request);

    if(!empty($params)){
        foreach($params as $key=>$value){
            $statement->bindValue($key, htmlspecialchars($value), PDO::PARAM_STR);
        }

    }
    $statement->execute();
    return $statement;
}
//function utilisateur 
function isConnected(): bool
{
    return isset($_SESSION['user']['statut']); //indicateur d'une connection
}
function isAdmin(): bool
{
    return (isConnected() && ($_SESSION['user']['statut'] == 1));
}

//Vérifie l'existence d'un pseudo
function getUserByLogin(string $pseudo) {
    $request = sql("SELECT * FROM membre WHERE pseudo=:pseudo", array(
        'pseudo' => $pseudo
    ));
    if($request->rowCount() > 0 ) {
        return $request->fetch();
    } else {
        return false;
    }
}

// Message d'alertes
function add_flash(string $message, string $class) {
    if(!isset($_SESSION['messages'][$class])) {
        $_SESSION['messages'][$class] = array();
    }
    $_SESSION['messages'][$class][] = $message;
}

//fonction de définition de l'alerte
function show_flash($option=null): string
{
    $messages = '';
    if(isset($_SESSION['messages'])) {
        foreach(array_keys($_SESSION['messages']) as $keyName) {
            $messages .= '<div class="alert fade disparition alert-dismissible show alert-' . $keyName . '" role="alert">' . implode('<br>', $_SESSION['messages'][$keyName]) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
    if($option == 'reset') {
        // Je détruit les message pour les afficher 1 fois
        unset($_SESSION['messages']);
    }
    return $messages;
}
// Vérification des entrées des formulaires
function valid_donnees ($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

// Ajouter une vue 
function ajouter_vue(): void {

    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    $fichier_journalier = $fichier . '-' . date('Y-m-d');
    incrementer_compteur($fichier);
    incrementer_compteur($fichier_journalier);

}
function incrementer_compteur(string $fichier):void {
    $compteur = 1;
    if(file_exists($fichier)){
        $compteur = (int)file_get_contents($fichier);
        $compteur++;
    }
    file_put_contents($fichier, $compteur);
}

// compte le nombre de vues
function nombre_vues(): string {
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($fichier);
}

//nombre de vue par mois
function nombre_vues_mois(int $annee, int $mois):int {
$mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
$fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-'.$annee.'-'. $mois.'-'.'*';
$files = glob($fichier);

$total = 0;
foreach( $files as $file){
    $total += (int)file_get_contents($file);
}
return $total;
}
// détail des vues par mois
function nombre_vues_details_mois(int $annee, int $mois):array {
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-'.$annee.'-'. $mois.'-'.'*';
    $files = glob($fichier);
    $visites = [];
    foreach( $files as $file){
        $parties = explode('-', basename($file));
        $visites[] =[
            'annee' =>$parties[1],
            'mois' =>$parties[2],
            'jour' =>$parties[3],
            'visites'=> file_get_contents($file)
        ];

    }
    return $visites;
    }