<?php
include ("../Include/Session.php");
include ("../Include/db.php");
include ("../Classes/Produit.php");
include ("../Classes/Stock.php");
$qte=$_POST['nombre'];
$qtem=$_POST['nombremax'];
$ref=$_POST['reference'];
$res=Stock::NombredeStock($db,$ref);
$resultat = $res->fetch();
    if ($resultat->Nombre!=0)
    {
        $nbr=$resultat->Nombre;
    }
    else
    {
        $nbr=0;
    }
if ($nbr==0)
{
    $res=Produit::getProduitById($db,$ref);
    $resultat = $res->fetch();
    $prixachat=$resultat->Prix;
    $prix=+$prixachat+($prixachat*0.05);
    $stk = new Stock($resultat->Reference,$resultat->Marque,$resultat->Modele,$resultat->Echantillon,$resultat->Couleur,$prix,$qte,$resultat->Fournisseur);
    $stk->setStock($db);
}
else
{
    Stock::increaseQte($db,$ref,$qte);
}
$res=Produit::ReduceQte($db,$ref,$qte);
$nom=$session->outSession('Nom');
$session->inputSession('Message',"Ajout avec Succes");
header("location:passercommande.php?id=".$nom);

?>