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
    protected $model;

    protected $view;

    protected $annonce;

    /**
     * ControllerAnnonce constructor.
     */
    public function __construct()
    {
        $this->model = new ModelAnnonce();
        $this->view = new ViewAnnonce();
        $this->annonce = new Annonce();
    }


    public function displayNewAnnonce()
    {
        $this->view->displayNewAnnonce();
    }

    public function displayAnnonce()
    {
        $this->view->displayAnnonce();
    }

    public function traitementNewAnnonce()
    {
        if(isset($_POST['titre']))
        {
            $this->annonce->setTitre($this->is_string($_POST['titre']));
            $this->annonce->setContenu($this->is_string($_POST['contenu']));
            $this->annonce->setIdAuthor($this->is_id($_POST['iduser']));

            if (empty($this->annonce->getTitre()) || empty($this->annonce->getContenu()))
            {
                $this->view->displayEmptyNewAnnonce();
                $this->view->displayNewAnnonce();
            }
            else
            {
                $testResultat = $this->model->saveAnnonce($this->annonce);

                if($testResultat)
                {
                    $this->view->displayAnnonceSuccess($this->annonce->getTitre());
                }
                else
                {
                    $this->view->displayErreurNewAnnonce();
                    $this->view->displayNewAnnonce();
                }
            }
        }
        else
        {
            $this->view->displayNewAnnonce();
        }


    }

    private function is_string($value)
    {
        return (is_string($value)) ? $value : "";
    }

    private function is_id($value)
    {
        return (is_numeric($value)) ? $value : intval($this->model->getIdFromLogin("anonymous"));
    }

}