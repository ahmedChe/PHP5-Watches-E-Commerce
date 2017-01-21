<?
	require "config.php";
	require "connect_db.php";
	require "functions.php";
        //Récupération de variable
	//$profile_id = GetUserProfile(); // Verification du profil utilisateur
        $nom = $_REQUEST["nom"];
        $prenom = $_REQUEST["prenom"];
	
	$mail = $_REQUEST["mail"];
        $login = $_REQUEST["login"];
        $password = $_REQUEST["passwd"];
	$repassword = $_REQUEST["repasswd"];
        $rue = $_REQUEST["rue"];
        $codep = $_REQUEST["codep"];
        $ville = $_REQUEST["ville"];
        $pays = $_REQUEST["pays"];
?>
<html>

<head>

   <title>Espace Inscription Client</title>

    <link href="../Web/css/style_inscrit_val.css" type="text/css" rel="stylesheet">

</head>

<body>

<DIV id=global>

<?
 	 
        
     echo "<form action=\"\" class=\"css\">";
     echo  "<fieldset>";
     echo   "<legend>Inscription de  :". $login."</legend>";
     echo   "<label for=\"nom\">Nom:". $nom."</label>";
    
     echo  "<br/>";
     echO   "<label for=\"prenom\">Prénom:".$prenom."</label>";
    
     echo  "<br />";
     echo  "<label for=\"adresse\">Adresse:".$rue."<br /> ".$codep." ".$ville." ".$pays."</label>";
     
     echo  "<br />";
     echo   "<label for=\"mail\">E-mail:".$mail."</label>";
     echo  "<br />";
     echo   "<label for=\"login\">Login:".$login."</label>";
     echo  "<br />";
     echo   "<label for=\"password\">Pass:".$password."</label>";
   
     echo  "</fieldset>";
     echo "</form>";

     //Insertion de client

      $sql= "INSERT INTO `data_users` VALUES ('".$login."','".$nom."','".$prenom."',2,'".$mail."','".$password."',0,0,NULL);";
 
      $result = db_query($database_name,$sql);
    
     //Insertion de son adresse

      $sqlbis= "INSERT INTO `adresse` VALUES ('".$login."','".$rue."',".$codep.",'".$ville."','".$pays."');";
 
      $resultbis = db_query($database_name,$sqlbis);
   



     if($result)
       echo "<H1>Client Inscrit avec succès </H1>";
     else
      echo "<H1>Inscription échoué </H1>";
  
?>

<A href="index.php">[Accueil]</A>
</DIV>  
</body>

</html>

