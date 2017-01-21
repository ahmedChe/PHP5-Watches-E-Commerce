<?php
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/Stock.php");
include ("../Classes/Commande.php");
include("../Include/db.php");
if (!empty($_SESSION['panier']))
{
    for ($i=0;$i<count($_SESSION['panier']['reference']);$i++)
    {
        Stock::DecreaseQte($db,$_SESSION['panier']['reference'][$i],$_SESSION['panier']['qte'][$i]);
        $c=new Commande($_SESSION['panier']['reference'][$i],$_SESSION['panier']['produit'][$i],$_SESSION['panier']['qte'][$i],$_SESSION['panier']['prix'][$i],$_SESSION['panier']['couleur'][$i]);
        $c->setCommande($db);
    }
    $session->detruirevariable('panier');
 }

header("location:index.php");
?>