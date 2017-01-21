<?php 
class Fournisseur
{
	private $nom;
	private $adresse;
	private $siege;
	private $login;
	private $password;
	public function __construct($nom,$adresse,$siege,$login,$password)
	                            {	                            
									$this->nom=$nom;
									$this->adresse=$adresse;
                                    $this->siege=$siege;
                                    $this->login=$login;                                                                      
									$this->password=$password;
	                            }
public static function getAllFournisseur($bd)
	{

	$res=$bd->cnx->query("select * from fournisseur");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}
public static function getFournisseurById($bd,$nom){

$res=$bd->cnx->query("select * from fournisseur where Nom_societe='".$nom."'");
$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;

}
public static function deleteFournisseurById($bd,$nom){

$bd->cnx->query("delete from fournisseur where Nom_societe='".$nom."'");
}

public function setFournisseur($bd){

$bd->MAJQuery("INSERT INTO fournisseur VALUES ('$this->nom','$this->adresse','$this->siege','$this->login','$this->password')");

}
public function updateFournisseur($bd){

$bd->MAJQuery("UPDATE fournisseur set Adresse='$this->adresse',Siege='$this->siege',Login='$this->login' where  Nom_societe='$this->nom'");

}
}
?>


