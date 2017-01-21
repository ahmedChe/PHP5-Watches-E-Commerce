<?php
/**
 * Created by PhpStorm.
 * User: !l-PazZ0
 * Date: 16/01/2016
 * Time: 03:06
 */
class Commande
{
    private $ref;
    private $nom;
    private $qte;
    private $prix;
    private $couleur;

    public function __construct($ref,$nom,$qte,$prix,$couleur)
    {
        $this->ref=$ref;
        $this->nom=$nom;
        $this->qte=$qte;
        $this->prix=$prix;
        $this->couleur=$couleur;
    }
    public function setCommande($bd){

        $bd->MAJQuery("INSERT INTO Commande VALUES ('$this->ref','$this->nom','$this->qte','$this->prix','$this->couleur')");

    }
}
?>