<?php
/**
 * Created by PhpStorm.
 * User: !l-PazZ0
 * Date: 14/01/2016
 * Time: 20:25
 */
class Panier
{
    public function __construct()
    {
    }
    public static function createPanier ()
    {
      /*  if (empty($_SESSION))
        {
            session_start();
        }
      */
        if (!isset($_SESSION['panier']))
        {
                $_SESSION['panier'] = array();
                $_SESSION['panier']['reference'] = array();
                $_SESSION['panier']['produit'] = array();
                $_SESSION['panier']['qte'] = array();
                $_SESSION['panier']['prix'] = array();
                $_SESSION['panier']['couleur'] = array();
        }
        return true;
    }
    public static  function  ajouterProduit ($ref,$prod,$qte,$prix,$couleur)
    {
        if (Panier::createPanier ())
        {
            $exist=array_search($ref,$_SESSION['panier']['reference']);
            if ($exist!==false)
            {
                $_SESSION['panier']['qte'][$exist]+=$qte;
            }
            else
            {
                array_push($_SESSION['panier']['reference'],$ref);
                array_push($_SESSION['panier']['produit'],$prod);
                array_push($_SESSION['panier']['qte'],$qte);
                array_push($_SESSION['panier']['prix'],$prix);
                array_push($_SESSION['panier']['couleur'],$couleur);

            }
        }
    }
    public Static function Somme ()
    {
        $value=0;
        if (!empty($_SESSION['panier']))
        {
            for ($i=0;$i<count($_SESSION['panier']['reference']);$i++)
            {
                $value+=(intval($_SESSION['panier']['prix'][$i]))*(intval($_SESSION['panier']['qte'][$i]));
            }
        }
        return $value;
    }
    public Static function Qte ()
    {
        $value=0;
        if (!empty($_SESSION['panier']))
        {
            for ($i=0;$i<count($_SESSION['panier']['qte']);$i++)
            {
                $value+=(intval($_SESSION['panier']['qte'][$i]));
            }
        }
        return $value;
    }
    public  static  function SupprimerProduit ($ref)
    {
            if (!empty($_SESSION['panier']['reference']))
            {
                $tmp=array();
                $tmp['reference'] = array();
                $tmp['produit'] = array();
                $tmp['qte'] = array();
                $tmp['prix'] = array();
                $tmp['couleur'] = array();
                for($i = 0; $i < count($_SESSION['panier']['reference']); $i++)
                {
                    if ($_SESSION['panier']['reference'][$i] !== $ref)
                    {
                        array_push( $tmp['reference'],$_SESSION['panier']['reference'][$i]);
                        array_push( $tmp['produit'],$_SESSION['panier']['produit'][$i]);
                        array_push( $tmp['qte'],$_SESSION['panier']['qte'][$i]);
                        array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
                        array_push( $tmp['couleur'],$_SESSION['panier']['couleur'][$i]);

                    }

                }
                $_SESSION['panier'] =  $tmp;
                unset($tmp);
            }
    }
}