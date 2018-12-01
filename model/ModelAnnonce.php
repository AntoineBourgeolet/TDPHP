<?php
/**
 * Created by PhpStorm.
 * User: abour
 * Date: 30/11/2018
 * Time: 18:48
 */

class ModelAnnonce
{


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

            $requete_prepare = $this->db->prepare('INSERT INTO annonce (title, content, date) VALUES (?,?,NOW())');

            $testErreur = $requete_prepare->execute(array($annonce->getTitre(),$annonce->getContenu()));

            $this->db->commit();

            return $testErreur;

        }
        catch (Exception $e)
        {
            return false;
        }
    }
}