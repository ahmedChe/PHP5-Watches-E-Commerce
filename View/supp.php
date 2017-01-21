<?php
include ("../Include/db.php");
include ("../Classes/Fournisseur.php");
include ("../Classes/Produit.php");
$nom=$_GET['id'];
Fournisseur::deleteFournisseurById($db,$nom);
Produit::deleteProduitByCompany($db,$nom);
	header("location:gestion_fournisseurs.php");
?>