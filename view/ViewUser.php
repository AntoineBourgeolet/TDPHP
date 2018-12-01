<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 01/12/2018
 * Time: 10:20
 */

class ViewUser
{

    public function displayNewUser()
    {
        $file = file_get_contents('template/newUser.html', FILE_USE_INCLUDE_PATH);
        echo $file;
    }

    public function displayEmptyNewUser()
    {
        echo "Veuillez remplir tout les champs";
    }

    public function displayNewUserSuccess($Login)
    {
        $file = file_get_contents('template/successNewUser.html', FILE_USE_INCLUDE_PATH);

        $file = str_replace('{{login}}', $Login, $file);

        echo $file;
    }

    public function displayErreurNewUser()
    {
        echo "Impossible d'enrigistrer dans la base";
    }

    public function displayExistingNewUser()
    {
        echo "Cette utilisateur existe déjà";
    }

    public function displayLogin()
    {
        $file = file_get_contents('template/login.html', FILE_USE_INCLUDE_PATH);
        echo $file;
    }

    public function displayEmptyLogin()
    {
        echo "Veuillez remplir tout les champs";
    }

    public function displayIncorectLogin()
    {
        echo "Identifiant ou mot de passe incorect";
    }

    public function displayNewAnnonce()
    {
        header('location: index.php?page=newannonce');
    }
}