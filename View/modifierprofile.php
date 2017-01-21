<?php
include ("../Include/db.php");
include ("../Classes/Fournisseur.php");
include ("../Classes/User.php");
if(isset($_GET['envoie1']))
{
    $nom=$_GET['nom'];
    $prenom=$_GET['prenom'];
    $pays=$_GET['pays'];
    $ville=$_GET['ville'];
    $adresse=$_GET['adresse'];
    $email=$_GET['mail'];
    $login=$_GET['login'];
    $password=$_GET['passwd'];
    $u=new User ($nom,$prenom,$pays,$ville,$adresse,$email,$login,$password);
    $u->updateProfile($db);
    header("location:myprofile.php");
}
if(isset($_GET['envoie']))
{
    $nom=$_GET['nom'];
    $adresse=$_GET['adr'];
    $siege=$_GET['siege'];
    $login=$_GET['login'];
    $password=$_GET['passwd'];
    $f=new Fournisseur ($nom,$adresse,$siege,$login,$password);
    $f->updateFournisseur($db);
    header("location:myprofile.php");
}
?>