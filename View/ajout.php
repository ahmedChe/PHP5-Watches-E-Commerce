<?php
include ("../Include/db.php");
include ("../Classes/Fournisseur.php");
if(isset($_GET['envoie']))
{
	$nom=$_GET['nom'];
	$adresse=$_GET['adr'];
	$siege=$_GET['siege'];
	$login=$_GET['login'];
	$password=$_GET['passwd'];
	$f=new Fournisseur($nom,$adresse,$siege,$login,$password);
	$f->setFournisseur($db);
	?>
	<script langugage="javascript">
		parent.jQuery.fn.colorbox.close();
		parent.location.reload();
	</script>
	<?php
}
?>
<html>
<head>
<link href="../Web/css/ajout.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<fieldset>
					<legend>Inscription</legend>
					<form action="ajout.php" method="get" class="css" >
					<div class="espace" id="premiere">
					<label for="prenom">Nom societe:</label>
					<input type="text" name="nom" id="nom" />
					</div>
					<div class="espace">
					<label for="pays">Adresse:</label>
					<input type="text" name="adr"  id="adresse" />
					</div>
					<div class="espace">
					<label for="ville">Siege:</label>
					<input type="text" name="siege" id="siege" />
					</div>
					<div class="espace">
					<label for="login">Login:</label>
					<input type="text" name="login" id="login" />
					</div>
					<div class="espace">
					 <label for="passwd">Password:</label>
					<input type="password" name="passwd" id="passwd" />
					</div>
					<div class="btn1">
					<input type="Submit" value="Ajouter" name="envoie" >
					<input type="reset" value="Annuler" name="annuler" >
					</div>
					</form> 
				</fieldset>
</body>
<?php
if(isset($_GET['envoie']))
{
	$nom=$_GET['nom'];
	$adresse=$_GET['adr'];
	$siege=$_GET['siege'];
	$login=$_GET['login'];
	$password=$_GET['passwd'];
	$f=new Fournisseur($nom,$adresse,$siege,$login,$password);
	$f->setFournisseur($db);
	?>
	<script langugage="javascript">
	window.opener.location = "gestion_fournisseurs.php";
	window.self.close();
	</script>
	<?php
}
?>
</html>