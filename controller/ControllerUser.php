<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 01/12/2018
 * Time: 10:17
 */

include "view/ViewUser.php";
include "model/ModelUser.php";
include "objet/User.php";

class ControllerUser
{
    protected $model;

    protected $view;

    protected $user;

    /**
     * ControllerUser constructor.
     */
    public function __construct()
    {
        $this->model = new ModelUser();
        $this->view = new ViewUser();
        $this->user = new User();
    }



    public function traitementNewUser()
    {
        if(isset($_POST['login']))
        {
            $this->user->setLogin($this->is_string($_POST['login']));
            $this->user->setPassword($this->is_password($_POST['password']));
            $this->user->setEmail($this->is_email($_POST['email']));
            if ($this->user->emptyVerif() == false)
            {
                $this->view->displayEmptyNewUser();
                $this->view->displayNewUser();
            }
            else
            {
                if($this->model->checkIfUserExist($this->user->getLogin()) == false)
                {
                    $testResultat = $this->model->saveUser($this->user);
                    if ($testResultat == true)
                    {
                        $this->view->displayNewUserSuccess($this->user->getLogin());
                    }
                    else
                    {
                        $this->view->displayErreurNewUser();
                        $this->view->displayNewUser();
                    }
                }
                else
                {
                    $this->view->displayExistingNewUser();
                    $this->view->displayNewUser();
                }
            }
        }
        else
        {
            $this->view->displayNewUser();
        }
    }

    public function traitementLogin()
    {
        if(isset($_POST['login']))
        {
            $this->user->setLogin($this->is_string($_POST['login']));
            $this->user->setPassword($this->is_password($_POST['password']));
            if ($this->user->emptyVerifLogin() == false)
            {
                $this->view->displayEmptyLogin();
                $this->view->displayLogin();
            }
            else
            {
                if($user = $this->model->verifyPassword($this->user)->getLogin() != "")
                {
                    session_unset();
                    $_SESSION['user'] = $this->user;
                    $this->view->displayNewAnnonce();
                }
                else
                {
                    $this->view->displayIncorectLogin();
                    $this->view->displayLogin();
                }
            }
        }
        else
        {
            $this->view->displayLogin();
        }
    }

    public function displayNewUser()
    {
        $this->view->displayNewUser();
    }

    public function displayLogin()
    {
        $this->view->displayLogin();
    }


    public function displayUserList()
    {
        $this->view->diplayListUser();
    }

    private function is_string($value)
    {
        return (is_string($value)) ? $value : "";
    }

    private function is_email($value)
    {
        return (filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : "");
    }

    private function is_password($value)
    {
        //IMPOSIBLE D'UTILISER PASSWORD HASH A CAUSE DE LA LIMITE DE 40 CARACTERE EN BDD
        return (is_string($value) AND strlen($value) <= 40) ? $value : "";
    }

}