<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 30/11/2018
 * Time: 18:48
 */

class ViewAnnonce
{

    /**
     * @var ModelAnnonce
     */
    protected $model;

    /**
     * ViewAnnonce constructor.
     */
    public function __construct()
    {
        $this->model = new ModelAnnonce();
    }


    /**
     *
     */
    public function displayNewAnnonce()
    {
        $file = file_get_contents('template/newAnnonce.html', FILE_USE_INCLUDE_PATH);

        if (isset($_SESSION['user'])) {
            $file = str_replace("{{iduser}}", $_SESSION['user']->getId(), $file);
        } else {
            $file = str_replace("{{iduser}}", "", $file);
        }
        echo $file;
    }

    /**
     *
     */
    public function displayAnnonce()
    {
        $file = file_get_contents('template/annonce.html', FILE_USE_INCLUDE_PATH);

        $annonceArray = $this->model->getAnnonce();
        $blockAnnonce = "";
        for ($i = 0; $i < count($annonceArray); $i++) {
            $fileannonce = file_get_contents('template/blockAnnonce.html', FILE_USE_INCLUDE_PATH);
            $fileannonce = str_replace('{{titreannonce}}', $annonceArray[$i]->getTitre(), $fileannonce);
            $fileannonce = str_replace('{{contenuannonce}}', $annonceArray[$i]->getContenu(), $fileannonce);
            $fileannonce = str_replace('{{idannonce}}', $annonceArray[$i]->getId(), $fileannonce);
            $fileannonce = str_replace('{{dateannonce}}', $annonceArray[$i]->getDate(), $fileannonce);
            $blockAnnonce .= $fileannonce;
        }
        $file = str_replace('{{annonce}}', $blockAnnonce, $file);
        echo $file;
    }

    /**
     *
     */
    public function displayErreurNewAnnonce()
    {
        echo "Imposible de sauvegarder dans la base";
    }

    /**
     * @param $Titre
     */
    public function displayAnnonceSuccess($Titre)
    {
        $file = file_get_contents('template/successAnnonce.html', FILE_USE_INCLUDE_PATH);

        $file = str_replace('{{titre}}', $Titre, $file);

        echo $file;
    }

    /**
     *
     */
    public function displayEmptyNewAnnonce()
    {
        echo "Veuillez remplir tout les champs";
    }

    /**
     * @param $iduser
     */
    public function displayAnnonceFromUser($iduser)
    {
        $file = file_get_contents('template/annonce.html', FILE_USE_INCLUDE_PATH);

        $annonceArray = $this->model->getAnnonceFromUser($iduser);
        $blockAnnonce = "";
        for ($i = 0; $i < count($annonceArray); $i++) {
            $fileannonce = file_get_contents('template/blockAnnonce.html', FILE_USE_INCLUDE_PATH);
            $fileannonce = str_replace('{{titreannonce}}', $annonceArray[$i]->getTitre(), $fileannonce);
            $fileannonce = str_replace('{{contenuannonce}}', $annonceArray[$i]->getContenu(), $fileannonce);
            $fileannonce = str_replace('{{idannonce}}', $annonceArray[$i]->getId(), $fileannonce);
            $fileannonce = str_replace('{{dateannonce}}', $annonceArray[$i]->getDate(), $fileannonce);
            $blockAnnonce .= $fileannonce;
        }
        $file = str_replace('{{annonce}}', $blockAnnonce, $file);
        echo $file;
    }
}