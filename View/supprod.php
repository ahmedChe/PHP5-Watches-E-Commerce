<?php
include ("../Include/db.php");
include ("../Classes/Produit.php");
$ref=$_GET['id'];
Produit::deleteProduitById($db,$ref);
header("location:produit.php");
?>