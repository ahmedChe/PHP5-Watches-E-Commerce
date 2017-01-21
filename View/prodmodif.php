<?php
/**
 * Created by PhpStorm.
 * User: !l-PazZ0
 * Date: 04/01/2016
 * Time: 03:30
 */
include ("../Include/db.php");
include ("../Include/Session.php");
include ("../Classes/Produit.php");
$url=$session->outSession('url');
$nom=$session->outSession('Nom');
if(isset($_POST['envoie']))
{
    $ref = $_POST['ref'];
    $marque = $_POST['mrq'];
    $model = $_POST['mdl'];
    $qte = $_POST['qte'];
    $couleur = $_POST['clr'];
    $prix = $_POST['pr'];
    if (!empty($_FILES['ech']['name'])) {
       // echo"ko";
        $name = $_FILES['ech']['name'];
        $type = $_FILES['ech']['type'];
        $size = $_FILES['ech']['size'];
        $temp = $_FILES['ech']['tmp_name'];
        $error = $_FILES['ech']['error'];
        $date = date("s-i-d-m-y");
        $image_nom = $nom . "_" . $date . ".jpg";
        move_uploaded_file($temp, "../Upload/" . $image_nom);
        $url = "../Upload/" . $image_nom;
        $f=new Produit($ref,$marque,$model,$url,$couleur,$prix,$qte,$nom);
        $f->updateProduit($db);
    }
    else {
        Produit::updateSomeProduit($db, $ref, $marque, $model, $couleur, $prix, $qte);
    }
    header("location:produit.php");
}