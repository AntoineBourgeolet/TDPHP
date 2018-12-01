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

    public function displayAnnonce()
    {
        $file = file_get_contents('template/Annonce.html', FILE_USE_INCLUDE_PATH);
        echo $file;
    }

    public function displayErreurNewAnnonce()
    {
        echo "Imposible de sauvegarder dans la base";
    }
}