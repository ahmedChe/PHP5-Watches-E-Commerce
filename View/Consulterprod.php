<!DOCTYPE HTML>
<?php
include ("../Include/db.php");
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/Produit.php");
include ("../Classes/Fournisseur.php");
$login=$session->outSession('Login');
?>
<html>
<head>
    <title>SHARK E-COMMERCE | DIGGING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_register.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/Consulterprod.css" rel="stylesheet" type="text/css" media="all" />
    <script src='../Web/js/zoom/jquery-1.8.3.min.js'></script>
    <script src='../Web/js/zoom/jquery.elevatezoom.js'></script>
    <!-- start menu -->
    <link href="../Web/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="../Web/js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <!-- end menu -->
    <!-- top scrolling -->
    <script type="text/javascript" src="../Web/js/move-top.js"></script>
    <script type="text/javascript" src="../Web/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
            });
        });
    </script>
</head>
<body>
<div class="header-top">
    <div class="wrap">
        <div class="logo">
            <a href="index.php"><img src="../Web/images/logo.png" style="width: 225px;height: 100px" alt=""/></a>
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
<div id=Menu>
    <?php
        $ref=$_GET['id'];
        $res=Produit::getProduitById($db,$ref);
        $resultat = $res->fetch();
        $marque=$resultat->Marque;
        $modele=$resultat->Modele;
        $echantillon=$resultat->Echantillon;
        $couleur=$resultat->Couleur;
        $prix=$resultat->Prix;
        $qte=$resultat->Quantite;
        $fournisseur=$resultat->Fournisseur;

        ?>
        <fieldset>
            <legend><?php echo $fournisseur." " .$marque." ". $modele; ?></legend>
                <div class="produit">
                    <div class="ech">
                        <img src='<?php ECHO $echantillon ?>' id="zoom" data-zoom-image='<?php ECHO $echantillon ?>' />
                    </div>
                    <div class ="info">
                        <div class ="details"><div class="titre"> Founisseur : </div> <?php echo $fournisseur ?></div>
                        <div class ="details"><div class='titre'>Gamme : </div> <?php echo $marque ?></div>
                        <div class ="details"><div class='titre'>Modele : </div><?php echo $modele?></div>
                        <div class ="details"><div class='titre'>Couleur Disponible : </div> <?php echo $couleur ?></div>
                        <div class ="details"><div class='titre'> Prix : </div><?php echo $prix ?> &euro;</div>
                        <?php
                        echo "<div class='details'><div class='titre'>Quantite :</div><select>";
                        for ($i=1;$i<$qte;$i++)
                        {
                            echo "<option value'".$i."'>".$i."</option>";
                        }
                        ?>
                    </select></div></div>
                    <div id="bouton">
                    <div class='bouton' id="precedent"><a href="javascript:window.history.go(-1)"><< Retour</a></div>
                    <div class='bouton'>Ajouter Aux Panier</div>
                        </div>
                </div>

        </fieldset>
</div>

<script>
   $("#zoom").elevateZoom({constrainType:"height", constrainSize:274, zoomType: "lens", containLensZoom: true, cursor: 'pointer'});

</script>
</body>
</html>

