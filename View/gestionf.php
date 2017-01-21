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
	$f=new Fournisseur ($nom,$adresse,$siege,$login,$password);
	$f->updateFournisseur($db);
	header("location:gestion_fournisseurs.php");
}
?>