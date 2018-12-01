<?php
include 'controller/ControllerAnnonce.php';
include 'controller/ControllerUser.php';

//Initialise controllers
$ControllerAnnonce = new ControllerAnnonce();
$ControllerUser = new ControllerUser();

//Start Session
session_start();
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'newannonce':
            $ControllerAnnonce->displayNewAnnonce();
            return;
            break;
        case 'traitementnewannonce':
            $ControllerAnnonce->traitementNewAnnonce();
            return;
            break;
        case 'newuser':
            $ControllerUser->displayNewUser();
            return;
            break;
        case 'traitementnewuser':
            $ControllerUser->traitementNewUser();
            return;
            break;
        case 'login':
            $ControllerUser->displayLogin();
            return;
            break;
        case 'traitementlogin':
            $ControllerUser->traitementLogin();
            return;
            break;
        case 'traitementdeconnexion':
            session_unset();
            $ControllerAnnonce->displayAnnonce();
            return;
            break;
        case 'userannonce':
            if (isset($_GET['utilisateur'])) {
                $ControllerAnnonce->displayAnnonceFromUser($_GET['utilisateur']);
            } else {
                $ControllerUser->displayUserList();
            }
            return;
            break;
    }
} else {
    $ControllerAnnonce->displayAnnonce();
}



