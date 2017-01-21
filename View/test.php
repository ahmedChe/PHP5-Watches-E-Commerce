table
	  {
		  margin-top: 15px;
		  margin-left: 32%;
		  
	  }
	  table, th, td
	  {
		border: 2px solid black;
		vertical-align:middle;
		text-align:center;
	  }
	  th
	  {
		  font-color:white;
		  font-weight: bold;
	  }
	.bouton 
	{
		width:150px;
		height:35px;
		background-image:radial-gradient(black,#A2A9A8);
		border: 1px solid #656565;
		color:white;
		text-align:center;
		border-radius:10px;
	}
.bouton a 
{
	color:white;
}
th .bouton
{
	height:35px;
	width:300px;
}
.commande .bouton 
{
	height:65px;
	font-family:times, serif;
	 font-size:115%;
}
.commande .bouton a
{
	vertical-align:middle;

	
}
 <?php
	include ("../Include/db.php");
	include ("../Classes/Fournisseur.php");
	
	echo '<table border-color="red">';
	echo "<tr><th>Matricule Fiscale</th><th>Nom Societe</th><th>Adresse</th><th>Siege</th><th>Specialite</th><th>Login</th><th colspan='2'>" ?><div class="bouton"><a href="#" onclick="window.open('ajout.php','Modifier Livre','height=445,width=300,resizable=no,left=300,top=200')">Ajouter un nouveau Fournisseur</a></div> <?php "</th></tr>";
	$res=Fournisseur::getAllFournisseur($db);
	while ($resultat = $res->fetch())
	{
		 echo "<tr><td>".$resultat->Matricule_fiscale."</td><td>".$resultat->Nom_societe."</td><td>".$resultat->Adresse."</td><td>".$resultat->Siege."</td><td>".$resultat->Specialite."</td><td>".$resultat->Login."</td><td>" ?><div class="commande"> <div class="bouton"><a href="supp.php?id=<?php echo $resultat->Matricule_fiscale; ?> ">Passer une nouvelle commande</a></div></div> <?php echo"</td><td>"?><div class="bouton"><a href="modifier.php?id=<?php echo $resultat->Matricule_fiscale; ?>">Modifier</a></div> <?php "</td><td>" ?> <div class="bouton"><a href="supp.php?id=<?php echo $resultat->Matricule_fiscale; ?>">Supprimer</a></div> <?php "</td></tr>";
	}
	echo "</table>";
	?>	