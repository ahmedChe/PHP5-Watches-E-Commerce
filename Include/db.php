<?php
class Connexion{
	public $cnx=null;
	
	public function __construct($serveur,$aa,$login,$mp){
		
		try {
					$this->cnx = new PDO('mysql:host='.$serveur.';dbname='.$aa, $login, $mp);
					$this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			} 
					catch ( PDOException $e ) {
					echo "Connection à MySQL impossible : ", $e->getMessage();
					exit(); //ou die();
			}
		}

	public function MAJQuery($sql){   
					$nb = $this->cnx->exec($sql);
			}

	public function getall($sql){   
					return $this->cnx->query($sql)->fetchAll();
			}

}
include ("config.php");
$db=new Connexion($serveur,$base,$login,$mp);
?>