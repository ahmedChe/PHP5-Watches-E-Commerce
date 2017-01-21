<?php 
class Produit
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
public static function getAllProduit($bd)
	{

	$res=$bd->cnx->query("select * from Produit");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}
public static function getProduitsById($bd,$nom){

	$res=$bd->cnx->query("select * from Produit where Fournisseur='".$nom."'");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;

}
	public static function getProduitsParPageById($bd,$nom,$deb,$nbr){

		$res=$bd->cnx->query("select * from Produit where Fournisseur='".$nom."' ORDER BY Reference DESC LIMIT ".$deb.",".$nbr);
		$res->setFetchMode(PDO::FETCH_OBJ);
		return $res;

	}
public static function getNombreProduitsById($bd,$nom){

		$res=$bd->cnx->query("select COUNT(*) as NOMBRE from Produit where Fournisseur='".$nom."'");
		$res->setFetchMode(PDO::FETCH_OBJ);
		return $res;

	}
public static function getProduitById($bd,$fr){

		$res=$bd->cnx->query("select * from Produit where Reference='".$fr."'");
		$res->setFetchMode(PDO::FETCH_OBJ);
		return $res;

}
public static function deleteProduitById($bd,$ref){

$bd->cnx->query("delete from Produit where Reference='".$ref."'");
}
	public static function deleteProduitByCompany($bd,$cmp){

		$bd->cnx->query("delete from Produit where Fournisseur='".$cmp."'");
	}
public function setProduit($bd){

$bd->MAJQuery("INSERT INTO Produit VALUES ('$this->reference','$this->marque','$this->modele','$this->echantillon','$this->couleur','$this->prix','$this->quantite','$this->fournisseur')");

}
public function updateProduit($bd){

$bd->MAJQuery("UPDATE Produit set Marque='$this->marque',Modele='$this->modele',Echantillon='$this->echantillon',Couleur='$this->couleur',Prix='$this->prix',Quantite='$this->quantite' where Reference='$this->reference'");

}
	public static function updateSomeProduit($bd,$ref,$mrq,$mdl,$clr,$prix,$qte){

		$bd->MAJQuery("UPDATE Produit set Marque='".$mrq."',Modele='".$mdl."',Couleur='".$clr."',Prix='".$prix."',Quantite='".$qte."' where Reference='".$ref."'");

	}
	public static function ReduceQte($bd,$ref,$qte){

		$bd->MAJQuery("UPDATE Produit set Quantite=Quantite-'".$qte."' where Reference='".$ref."'");

	}
}
?>


