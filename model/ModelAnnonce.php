<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 30/11/2018
 * Time: 18:48
 */

class ModelAnnonce
{

    protected $db;
    /**
     * ModelAnnonce constructor.
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

    public function saveAnnonce(Annonce $annonce)
    {
        try{
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare('INSERT INTO annonce (title, content, date, author_id) VALUES (?,?,NOW(),?)');

            $testErreur = $requete_prepare->execute(array($annonce->getTitre(),$annonce->getContenu(),$annonce->getIdAuthor() ));

            $this->db->commit();

            return $testErreur;

        }
        catch (Exception $e)
        {
            return false;
        }
    }

    public function getAnnonce()
    {
        try{
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare('SELECT * FROM annonce');

            $requete_prepare->execute();

            $annonceAll = array();

            for($i=0; $i < $requete_prepare->rowCount(); $i++)
            {
                $annonce = new Annonce();
                $requete_result = $requete_prepare->fetch();
                $annonce->setId($requete_result[0]);
                $annonce->setTitre($requete_result[1]);
                $annonce->setContenu($requete_result[2]);
                $annonce->setDate($requete_result[3]);
                $annonceAll[$i] = $annonce;
            }

            $this->db->commit();

            return $annonceAll;

        }
        catch (Exception $e)
        {
            return $e;
        }
    }

    public function getIdFromLogin(string $login)
    {
        try{
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare('SELECT id FROM utilisateur WHERE login=? ');

            $requete_prepare->execute(array($login));

            $this->db->commit();

            return $requete_prepare->fetch()[0];

        }
        catch (Exception $e)
        {
            return 0;
        }
    }

    public function getAnnonceFromUser($iduser)
    {
        try{
            $this->db->beginTransaction();

            $requete_prepare = $this->db->prepare('SELECT * FROM annonce WHERE author_id = ?');

            $requete_prepare->execute(array($iduser));

            $annonceAll = array();

            for($i=0; $i < $requete_prepare->rowCount(); $i++)
            {
                $annonce = new Annonce();
                $requete_result = $requete_prepare->fetch();
                $annonce->setId($requete_result[0]);
                $annonce->setTitre($requete_result[1]);
                $annonce->setContenu($requete_result[2]);
                $annonce->setDate($requete_result[3]);
                $annonceAll[$i] = $annonce;
            }

            $this->db->commit();

            return $annonceAll;

        }
        catch (Exception $e)
        {
            return $e;
        }
    }
}