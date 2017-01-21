<?php
class Stock
{
    private $reference;
    private $marque;
    private $modele;
    private $echantillon;
    private $quantite;
    private $couleur;
    private $prix;
    private $fournisseur;
    public function __construct($reference,$marque,$modele,$echantillon,$couleur,$prix,$quantite,$fournisseur)
    {
        $this->reference=$reference;
        $this->marque=$marque;
        $this->modele=$modele;
        $this->echantillon=$echantillon;
        $this->couleur=$couleur;
        $this->prix=$prix;
        $this->quantite=$quantite;
        $this->fournisseur=$fournisseur;
    }
    public static function getAllStock($bd)
    {

        $res=$bd->cnx->query("select * from Stock");
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;
    }
    public static function getStockById($bd,$nom){

        $res=$bd->cnx->query("select * from Stock where Fournisseur='".$nom."'");
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }
    public static function getdeStockById($bd,$fr){

        $res=$bd->cnx->query("select * from Stock where Reference='".$fr."'");
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }
    public static function NombredeStock($bd,$fr){

        $res=$bd->cnx->query("select count(*) as Nombre from Stock where Reference='".$fr."'");
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }
    public static function deleteStockById($bd,$ref){

        $bd->cnx->query("delete from Stock where Reference='".$ref."'");
    }

    public function setStock($bd){

        $bd->MAJQuery("INSERT INTO Stock VALUES ('$this->reference','$this->marque','$this->modele','$this->echantillon','$this->couleur','$this->prix','$this->quantite','$this->fournisseur')");

    }
    public function updateStock($bd){

        $bd->MAJQuery("UPDATE Stock set Marque='$this->marque',Modele='$this->modele',Echantillon='$this->echantillon',Couleur='$this->couleur',Prix='$this->prix',Quantite='$this->quantite' where Reference='$this->reference'");

    }
    public static function increaseQte($bd,$ref,$qte){

        $bd->MAJQuery("UPDATE Stock set Quantite=Quantite+'".$qte."' where Reference='".$ref."'");

    }
    public static function DecreaseQte($bd,$ref,$qte){

        $bd->MAJQuery("UPDATE Stock set Quantite=Quantite-'".$qte."' where Reference='".$ref."'");

    }
    public static function getProduitsParPageById($bd,$deb,$nbr){

        $res=$bd->cnx->query("select * from Stock LIMIT ".$deb.",".$nbr);
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }

    public static function getSomeProductsPerPage($bd,$deb,$nbr,$nom){

        $res=$bd->cnx->query("select * from Stock where Fournisseur='".$nom."' LIMIT ".$deb.",".$nbr);
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }

    public static function getNombreProduitsById($bd){

        $res=$bd->cnx->query("select COUNT(*) as NOMBRE from Stock ");
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }
    public static function getProductsNumberById($bd,$nom){

        $res=$bd->cnx->query("select COUNT(*) as NOMBRE from Stock where Fournisseur='".$nom."'");
        $res->setFetchMode(PDO::FETCH_OBJ);
        return $res;

    }
}
?>


