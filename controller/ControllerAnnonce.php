<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 30/11/2018
 * Time: 18:47
 */

include "view/ViewAnnonce.php";
include "model/ModelAnnonce.php";
include "objet/Annonce.php";

class ControllerAnnonce
{
    public function displayNewAnnonce()
    {
        $view = new ViewAnnonce();
        $view->displayNewAnnonce();
    }

    public function displayAnnonce()
    {
        $view = new ViewAnnonce();
        $view->displayAnnonce();
    }

    public function traitementNewAnnonce()
    {
        if(isset($_POST['titre']))
        {
            $annonce = new Annonce();
            $annonce->setTitre($this->is_string($_POST['titre']));
            $annonce->setContenu($this->is_string($_POST['contenu']));

            $model = new ModelAnnonce();
            $testResultat = $model->saveAnnonce($annonce);

            $view = new ViewAnnonce();
            if($testResultat)
            {
                $view->displayAnnonce();
            }
            else
            {
                $view->displayErreurNewAnnonce();
            }
        }
        else
        {
            $view = new ViewAnnonce();
            $view->displayNewAnnonce();
        }


    }

    private function is_string($value)
    {
        return (is_string($value)) ? $value : "";
    }


}