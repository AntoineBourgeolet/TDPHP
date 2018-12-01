<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 30/11/2018
 * Time: 18:48
 */

class ViewAnnonce
{

    public function displayNewAnnonce()
    {
        $file = file_get_contents('template/newAnnonce.html', FILE_USE_INCLUDE_PATH);
        echo $file;
    }

    /**
     *
     */
    public function displayAnnonce()
    {
        $file = file_get_contents('template/Annonce.html', FILE_USE_INCLUDE_PATH);

        $model = new ModelAnnonce();
        $annonce = $model->getAnnonce();
        $blockAnnonce = "";
        for($i = 0; $i < count($annonce); $i++)
        {
            $fileannonce = file_get_contents('template/blockAnnonce.html', FILE_USE_INCLUDE_PATH);
            $fileannonce = str_replace('{{titreannonce}}', $annonce[$i]->getTitre(), $fileannonce);
            $fileannonce = str_replace('{{contenuannonce}}', $annonce[$i]->getContenu(), $fileannonce);
            $fileannonce = str_replace('{{idannonce}}', $annonce[$i]->getId(), $fileannonce);
            $fileannonce = str_replace('{{dateannonce}}', $annonce[$i]->getDate(), $fileannonce);
            $blockAnnonce .= $fileannonce;
        }
        $file = str_replace('{{annonce}}', $blockAnnonce, $file);
        echo $file;
    }

    public function displayErreurNewAnnonce()
    {
        echo "Imposible de sauvegarder dans la base";
    }

    public function displayAnnonceSuccess($Titre)
    {
        $file = file_get_contents('template/successAnnonce.html', FILE_USE_INCLUDE_PATH);

        $file = str_replace('{{titre}}', $Titre, $file);

        echo $file;    }

    public function displayEmptyNewAnnonce()
    {
        echo "Veuillez remplir tout les champs";
    }
}