<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 01/12/2018
 * Time: 10:19
 */

class User
{
    /**
     * @var
     */
    /**
     * @var
     */
    /**
     * @var
     */
    protected $login, $password, $email;

    /**
     * @var
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    //Return false si aucun champ n'est vide
    //Return true si un champ est vide

    /**
     * @return bool
     */
    public function emptyVerif()
    {
        if (empty($this->getLogin()) || empty($this->getPassword()) || empty($this->getEmail())) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return bool
     */
    public function emptyVerifLogin()
    {
        if (empty($this->getLogin()) || empty($this->getPassword())) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *
     */
    public function resetall()
    {
        $this->setId("");
        $this->setLogin("");
        $this->setEmail("");
        $this->setPassword("");
    }


}