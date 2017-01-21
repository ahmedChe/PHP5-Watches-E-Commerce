<?php
include ("../Include/Session.php");
include ("../Include/Panier.php");
$nombre=$_GET['supprimer'];
 if ($nombre=='tout') {
     $session->detruirevariable('panier');
     header("location:index.php");
 }
else
{
    Panier::SupprimerProduit($nombre);
    header("location:panier.php");
}

?>