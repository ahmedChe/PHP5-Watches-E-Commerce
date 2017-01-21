<?php 
class User
{
	private $nom;
	private $prenom;
	private $pays;
	private $ville;
	private $adresse;
	private $email;
	private $login;
	private $password;
	public function __construct($nom,$prenom,$pays,$ville,$adresse,$email,$login,$password)
	                            {	                            
                                    $this->nom=$nom;
									$this->prenom=$prenom;
									$this->pays=$pays;
									$this->ville=$ville;
									$this->adresse=$adresse;
                                    $this->email=$email;
                                    $this->login=$login;                                                                      
									$this->password=$password;
	                            }
public static function getAllPersonne($bd)
	{

	$res=$bd->cnx->query("select * from User");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}
public static function getAllAdmin($bd)
	{

	$res=$bd->cnx->query("select * from admin");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}
public static function getPersonneById($bd,$login){

$res=$bd->cnx->query("select * from User where Login='".$login."'");
$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}


public function setPersonne($bd){

$bd->MAJQuery("INSERT INTO user VALUES ('$this->nom','$this->prenom','$this->pays','$this->ville','$this->adresse','$this->email','$this->login','$this->password')");

}
public function updateProfile($bd)
{

	$bd->MAJQuery("UPDATE User set Nom='$this->nom',Prenom='$this->prenom',Pays='$this->pays',Ville='$this->ville',Adresse='$this->adresse',Email='$this->email',Password='$this->password' where Login='$this->login'");

}
}
?>



