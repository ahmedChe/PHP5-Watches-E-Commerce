<!DOCTYPE HTML>
<?php
include ("../Include/db.php");
include ("../Include/Session.php");
include ("../Classes/Produit.php");
include ("../Classes/Fournisseur.php");
$login=$session->outSession('Login');
$ref=$_GET['id'];
$res=Produit::getProduitById($db,$ref);
while ($resultat = $res->fetch())
{

    $mrq=$resultat->Marque;
    $mdl=$resultat->Modele;
    $clr=$resultat->Couleur;
    $prix=$resultat->Prix;
    $qte=$resultat->Quantite;
    $frs=$resultat->Fournisseur;
    $session->inputSession('url',$resultat->Echantillon);
}

?>
<html>
<head>
    <title>Free Adidas Website Template | Register :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_register.css" rel="stylesheet" type="text/css" media="all" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../Web/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });

    </script>
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
            $cpt=$session->outSession('Compte');
            ?>
            <ul class="fournisseur">
                <li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
                <li class="active"><a href="produit.php">Produits</a></li>
                <li><a href="myprofile.php">My Account</a></li>
                <li class="active"><a href="deconnexion.php">LOG OUT</a></li>
                <li STYLE='color:red;font-weight: bold;text-align:right;font-family: Helvetica;font-size: 1.22em;'><?php echo $login ?></li>
            </ul>
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

    <fieldset>
        <legend>Modifier Un produit</legend>
        <form action="prodmodif.php" class="css" method="post" enctype="multipart/form-data">
            <div class="espace">
                <label for="reference">Reference:</label>
                <input type="text" name="ref" id="ref" readonly value="<?php echo $ref ?> "/>
            </div>
            <div class="espace">
                <label for="marque">Marque:</label>
                <input type="text" name="mrq"  id="mrq" value="<?php echo $mrq ?> "/>
            </div>
            <div class="espace">
                <label for="modele">Modele:</label>
                <input type="text" name="mdl" id="mdl" value="<?php echo $mdl ?> "/>
            </div>
            <div class="espace">
                <label for="echantillon">Echantillon:</label>
                <input type="file" name="ech" id="ech" />
            </div>
            <div class="espace">
                <label for="couleur">Couleur :</label>
                <input type="text" name="clr" id="clr" value="<?php echo $clr ?> "/>
            </div>
            <div class="espace">
                <label for="prix">Prix:</label>
                <input type="text" name="pr" id="pr" value="<?php echo $prix ?> " />
            </div>
            <div class="espace">
                <label for="quantite">Quantite:</label>
                <input type="text" name="qte" id="qte" value="<?php echo $qte ?> " />
            </div>
            <div class="espace">
                <label for="fournisseur">Fournisseur:</label>
                <input type="text" name="frs" id="frs" readonly value="<?php echo $frs ?> " />
            </div>
            <div class="btn1">
                <input type="Submit" value="ENVOYER" name="envoie" >
                <input type="Reset" value="ANNULER"  name="effacer" >
            </div>
        </form>
    </fieldset>

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

