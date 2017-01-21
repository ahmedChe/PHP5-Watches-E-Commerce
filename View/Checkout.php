<!DOCTYPE HTML>
<?php
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/Fournisseur.php");
include ("../Classes/Stock.php");
include ("../Classes/Commande.php");
include("../Include/db.php");
?>
<html>
<head>
    <title>SHARK E-COMMERCE | PANIER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_login.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/Checkout/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href='../Web/css/googleapis.css' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../Web/js/jquery.min.js"></script>

    <!----------------------------------------------Form-POPUP---------------------------------------------->

    <link rel="stylesheet" href="../Web/css/pop-up/colorbox.css" />
    <script src="../Web/js/popup/jquery.min.js"></script>
    <script src="../Web/js/popup/jquery.colorbox-min.js"></script>

    <script>
        $(document).ready(function(){
            $(".iframe").colorbox({iframe:true, fastIframe:false, width:"450px", height:"670px", transition:"fade", scrolling   : false});
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#iframe").colorbox({iframe:true, fastIframe:false, width:"315px", height:"420px", transition:"fade", scrolling   : false});
        });
    </script>


    <style>
        #cboxOverlay{ background:#666666; }
    </style>



    <!-- start menu -->
    <link href="../Web/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="../Web/js/megamenu.js"></script>
    <!-- end menu -->

</head>
<body>
<div class="header-top">
    <div class="wrap">
        <div class="logo">
            <a href="index.php"><img src="../Web/images/logo.png" alt=""/></a>
        </div>
        <div class="cssmenu">

            <?php
            if(!empty($_SESSION['Login']))
            {
            $login = $session->outSession('Login');
            ?>
            <ul class="user">
                <li><a href="Checkout.php">CheckOut</a></li>
                <li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
                <li class="active"><a href="myprofile.php">My Account</a></li>
                <li class="active"><a href="deconnexion.php">LOG OUT</a></li>
                <li STYLE='color:red;font-weight: bold;text-align:right;font-family: Helvetica;font-size: 1.22em;'><?php echo $login ?></li>
            </ul>
            <?php $panier = Panier::Somme(); ?>
            <div id="panier"><a href="panier.php"><img src="../Web/images/panier3.png"/></a>

                <div class="prix"><?php echo $panier ?>&nbsp;&euro;</div>
                <?php
                }
                else
                {
                    ?>
                    <ul class="inconnu">
                        <li><a href="Checkout.php">CheckOut</a></li>
                        <li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
                        <li class="active"><a href="register.php">Sign up & Save</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                    <?php $panier=Panier::Somme();?>
                    <div id="panier"><a href="panier.php"><img src="../Web/images/panier3.png"/></a><div class="prix"><?php echo $panier?>&nbsp;&euro;</div> </div>

                    <?php
                }
                ?>


            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="wrap">
            <!-- start header menu -->
            <ul class="megamenu skyblue">
                <ul class="megamenu skyblue">
                    <li><a class="color1" href="index.php">Home</a></li>
                    <?php
                    $cpt=2;
                    $res=Fournisseur::getAllFournisseur($db);
                    while ($resultat=$res->fetch())
                    {
                        echo "<li class='grid'><a class='color" . $cpt . "' href='Categorie.php?id=".$resultat->Nom_societe."'>" . $resultat->Nom_societe . "</a></li>";
                        $cpt++;
                    }
                    ?>
                </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div id=global style="margin-left: 10px;margin-top: -170px;">
        <div class="cart">
            <div class="cart-top">
                <h2 class="cart-top-title">CHECKOUT</h2>
                <?php $qte=Panier::Qte(); ?>
                <div class="cart-top-info"><?php echo $qte?>&nbsp;Items</div>
            </div>

            <ul>
                <?php
                if (!empty($_SESSION['panier']))
                {
                    for ($i = 0; $i < count($_SESSION['panier']['reference']); $i++)
                    {
                        echo '<li class="cart-item">';
                        echo '<span class="cart-item-pic">';
                        $res=Stock::getdeStockById($db,$_SESSION['panier']['reference'][$i]);
                        $resultat=$res->fetch();
                        echo '<img src="'.$resultat->Echantillon.'">';
                        echo '</span>';
                        echo '<span class="cart-item-title">'.$_SESSION['panier']['produit'][$i].'</span>';
                        echo '<span class="cart-item-desc" >Prix unitaire :&nbsp;&nbsp;'. $_SESSION['panier']['prix'][$i].'&nbsp;&euro;</span >';
                        echo '<span class="cart-item-price" >'. intval($_SESSION['panier']['prix'][$i])*intval($_SESSION['panier']['qte'][$i]).'&nbsp;&euro;</span >';
                        echo '<span class="cart-item-desc" > Quantite demande :&nbsp;&nbsp;'. $_SESSION['panier']['qte'][$i].'</span >';
                        echo '<span class="cart-item-desc" > Couleur :&nbsp;&nbsp;'. $_SESSION['panier']['couleur'][$i].'</span >';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
            <div class="clear"></div>
            <div class="cart-bottom">
                <?php $panier=Panier::Somme();
                ?>
                <span class ='total'><input type="text" name="total" value="Totale =&nbsp;<?php echo $panier?>&nbsp;&euro;" readonly></span>
                    <span class='purchase'>
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <input name="amount" type="hidden" value="<?php echo $panier?>" />
                            <input name="currency_code" type="hidden" value="EUR" />
                            <input name="shipping" type="hidden" value="0.00" />
                            <input name="tax" type="hidden" value="0.00" />
                            <input name="return" type="hidden" value="http://localhost:8080/projects/E-Commerce/View/RefreshDB.php" />
                            <input name="cancel_return" type="hidden" value="http://localhost:8080/projects/E-Commerce/View/Checkout.php" />
                            <input name="cmd" type="hidden" value="_xclick" />
                            <input name="business" type="hidden" value="seller22127@hotmail.fr" />
                            <input name="item_name" type="hidden" value="Shark Products" />
                            <input name="no_note" type="hidden" value="1" />
                            <input name="lc" type="hidden" value="FR" />
                            <input class="acheter" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée" name="submit" src="https://www.paypal.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" type="image" /><img src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
                        </form>


                    </span>
            </div>
        </div>


    </div>
    <style>
        .clear
        {
            clear: both;
            width: 0px;
            height: 0px;
            background-color: red;
        }
        #rmq
        {
            padding-top: 17px;
            font-weight: bolder;
            padding-left: 90px;
        }
        #rmq2
        {
            padding-top: 35px;
            font-weight: bolder;
            margin-left: 170px;
            padding-left: 45px;
        }
        #rmq .rq
        {
            color: red;
            padding-right: 20px;
        }
    </style>

    <style>
        th{
            font-weight: bold;


        }
        th img
        {
            height:25px;
            width:45px;
            float:right;
            padding-top: 5px;
        }

    </style>
</body>
</html>