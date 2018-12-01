<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 01/12/2018
 * Time: 10:20
 */

class ViewUser
{

    protected $model;

    /**
     * ViewAnnonce constructor.
     */
    public function __construct()
    {
        $this->model = new ModelUser();
    }



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

    public function diplayListUser()
    {
        $file = file_get_contents('template/listUser.html', FILE_USE_INCLUDE_PATH);

        $userArray = $this->model->getUserInfo();
        $blockUser = "";
        for($i = 0; $i < count($userArray); $i++)
        {
            $fileannonce = file_get_contents('template/blockListUser.html', FILE_USE_INCLUDE_PATH);
            $fileannonce = str_replace('{{login}}', $userArray[$i]->getLogin(), $fileannonce);
            $fileannonce = str_replace('{{email}}', $userArray[$i]->getEmail(), $fileannonce);
            $blockUser .= $fileannonce;
        }
        $file = str_replace('{{userlistblock}}', $blockUser, $file);
        echo $file;
    }
}