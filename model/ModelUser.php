<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 01/12/2018
 * Time: 10:19
 */

class ModelUser
{

    protected $db;
    /**
     * ModelUser constructor.
     */
    public function __construct()
    {
        try
        {
            $this->db = new PDO('mysql:host=localhost;dbname=phptd', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch(Exception $e)
        {
            echo 'Echec de la connexion à la base de données';
            exit();
        }
    }

    public function saveUser(User $user)
    {
        try{
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare('INSERT INTO utilisateur(login, password, email) VALUES (?,?,?)');

            $testErreur = $requete_prepare->execute(array($user->getLogin(),$user->getPassword(),$user->getEmail()));

            $this->db->commit();

            return $testErreur;

        }
        catch (Exception $e)
        {
            return false;
        }
    }

    public function checkIfUserExist($login)
    {
        try
        {
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare( "SELECT COUNT(*) AS NbUser FROM utilisateur WHERE login=?");

            $requete_prepare->execute(array($login));

            $resultat = $requete_prepare->fetch(PDO::FETCH_ASSOC);


            $this->db->commit();
            if ($resultat['NbUser'] >= 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    public function verifyPassword(User $user)
    {
        try
        {
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare( "SELECT id, email FROM utilisateur WHERE login=? AND password =? ");

            $requete_prepare->execute(array($user->getLogin(), $user->getPassword()));

            $requete_result = $requete_prepare->fetch(PDO::FETCH_ASSOC);


            $this->db->commit();
            if($requete_prepare->rowCount() === 1)
            {
                $user->setEmail($requete_result['email']);
                $user->setId($requete_result['id']);
                return $user;
            }
            else
            {
                $user->resetall();
                return $user;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}