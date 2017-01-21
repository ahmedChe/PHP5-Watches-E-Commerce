<!DOCTYPE HTML>
<?php
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/Fournisseur.php");
include("../Include/db.php");
?>
<html>
<head>
    <title>SHARK E-COMMERCE | PANIER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_login.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/gestion_fournisseurs.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/Panier.css" rel="stylesheet" type="text/css" media="all" />
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
<div id=global>
    <?php
    if (!$session->verifexistence('Login')) {
        echo '<table border-color="red" id="tableau" style="margin-left: 50px;" summary="Votre Panier">';
    }
    else
    {
        echo '<table border-color="red" id="tableau" style="margin-left: 80px;" summary="Votre Panier">';
    }
    echo "  <thead><tr><th>Reference</th><th>Produit</th><th>Quantite</th><th>prix</th><th>Couleur</th><th>"?><a href="Gestionpanier.php?supprimer=tout" onclick="return confirm('Etes vous sure de vouloir detruire votre panier ?');"><img src='../Web/images/DeleteRed.png'/></a><?php echo "</th></tr></thead>";
    echo'<tfoot><tr><td colspan="5">Votre Panier</td><td><a href="Checkout.php">ORDER NOW</a></td></tr></tfoot><tbody>';
    if (!empty($_SESSION['panier']))
    {
        for ($i = 0; $i < count($_SESSION['panier']['reference']); $i++) {
            echo "<tr><td>" . $_SESSION['panier']['reference'][$i] . "</td><td>" . $_SESSION['panier']['produit'][$i] . "</td><td>" . $_SESSION['panier']['qte'][$i] . "</td><td>" . $_SESSION['panier']['prix'][$i] . "</td><td>" . $_SESSION['panier']['couleur'][$i] . "</td><td><a href='Gestionpanier.php?supprimer=".$_SESSION['panier']['reference'][$i]."'> <img src='../Web/images/DeleteRed.png' style='height:25px;width:30px;float: right'></a></td></tr>";
        }
    }
    echo "</tbody></table>";
    echo'<div class="clear"></div>';
    if (!$session->verifexistence('Login'))
    {
        echo "<div id='rmq'> <span class='rq'>RemarQue:</span>Les membres sont b&#233;n&#233;ficier de 8% de r&#233;duction sur la plupart de nos produits...ne ratez pas l'ocassion de s'inscrire !!</div>";
    }
    else
    {
        echo "<div id='rmq2'>C'est votre jour de chance d'avoir une r&#233;duction de 8% sur la plupart des produits</div>";

    }
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
        };


        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>

</body>
</html>