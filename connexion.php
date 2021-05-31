<?php

require_once('includes/init.php') ;


// Gestion du formulaire de connexion
if(!empty($_POST)){
    $errors = 0;
    if(empty($_POST['pseudo'])){
        $errors++;
        add_flash('&#9888; Merci de saisir votre pseudo', 'danger');
    }
    if(empty($_POST['mdp'])){
        $errors++;
        add_flash('&#9888; Merci de saisir votre mot de passe', 'danger');
    }
    if($erros == 0){
        $user = getUserByLogin($_POST['pseudo']);
        if($user){
            if(password_verify($_POST['mdp'],$user['mdp'])){
                $_SESSION['user'] =  $user;
                add_flash('👍; Connexion réussie', 'info');
                header('location:'.URL.'profil.php');
                exit();
            }else {
                add_flash('&#9888; Erreur sur les identifiants', 'danger');
            }
        } else {
            add_flash('&#9888; Erreur sur les identifiants', 'danger');
        }

        }

    }