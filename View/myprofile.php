<!DOCTYPE HTML>
<?php
include ("../Include/db.php");
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/Fournisseur.php");
include ("../Classes/User.php");
$compte=$session->outSession('Compte');
if ($compte=="fournisseur") {
    $nom = $session->outSession('Nom');
}
$login=$session->outSession('Login');
?>
<html>
<head>
    <title>SHARK E-COMMERCE | MY PROFILE </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
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

    <!----------------------------------------------Form-POPUP---------------------------------------------->

    <link rel="stylesheet" href="../Web/css/pop-up/colorbox.css" />
    <script src="../Web/js/popup/jquery.min.js"></script>
    <script src="../Web/js/popup/jquery.colorbox-min.js"></script>

    <script>
        $(document).ready(function(){
            $(".iframe").colorbox({iframe:true, fastIframe:false, width:"450px", height:"670px", transition:"fade", scrolling   : false});
        });
    </script>


    <style>
        #cboxOverlay{ background:#666666; }
    </style>


    <!------------------------------------------------------------------------------------------------------>

    <!-- start menu -->
    <link href="../Web/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="../Web/js/megamenu.js"></script>

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
            $login=$session->outSession('Login');
            ?>
            <?php
            $cpt=$session->outSession('Compte');
            // echo $cpt;
         if ($cpt=="fournisseur")
            {
                $login=$session->outSession('Nom');
                ?>
                <ul class="fournisseur">
                    <li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
                    <li class="active"><a href="produit.php">Produits</a></li>
                    <li><a href="myprofile.php">My Account</a></li>
                    <li class="active"><a href="deconnexion.php">LOG OUT</a></li>
                    <li STYLE='color:red;font-weight: bold;text-align:right;font-family: Helvetica;font-size: 1.22em;'><?php echo $login ?></li>
                </ul>
                <?php
            }
            else
            {	?>
            <ul class="user">
                <li><a href="Checkout.php">CheckOut</a></li>
                <li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
                <li class="active"><a href="myprofile.php">My Account</a></li>
                <li class="active"><a href="deconnexion.php">LOG OUT</a></li>
                <li STYLE='color:red;font-weight: bold;text-align:right;font-family: Helvetica;font-size: 1.22em;'><?php echo $login ?></li>
            </ul>
            <?php $panier=Panier::Somme();?>
            <div id="panier"><a href="panier.php"><img src="../Web/images/panier3.png"/></a><div class="prix"><?php echo $panier?>&nbsp;&euro;</div>

                <?php
                }
                }
                else
                {
                ?>
                <ul class="inconnu">
                    <li><a href="checkout.html">CheckOut</a></li>
                    <li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
                    <li class="active"><a href="register.php">Sign up & Save</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
                <?php $panier=Panier::Somme();?>
                <div id="panier"><a href="panier.php"><img src="../Web/images/panier3.png"/></a><div class="prix"><?php echo $panier?>&nbsp;&euro;</div>


                    <?php
                    }
                    ?>

                </div>
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
    if ($compte=='fournisseur')
    {
        $res=Fournisseur::getFournisseurById($db,$nom);
        while ($resultat = $res->fetch())
        {

            $adr=$resultat->Adresse;
            $siege=$resultat->Siege;
            $login=$resultat->Login;
            $password=$resultat->Password;
        }

        ?>
        <fieldset >
            <legend style="text-align: center">Modifier Votre profil </legend>
            <form action="modifierprofile.php" class="css">
                <div class="espace">
                    <label for="prenom">Nom societe:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $nom ?> " READONLY/>
                </div>
                <div class="espace">
                    <label for="pays">Adresse:</label>
                    <input type="text" name="adr"  id="adresse" value="<?php echo $adr ?> "READONLY />
                </div>
                <div class="espace">
                    <label for="ville">Siege:</label>
                    <input type="text" name="siege" id="siege" value="<?php echo $siege ?> "/>
                </div>
                <div class="espace">
                    <label for="login">login:</label>
                    <input type="text" name="login" id="login" value="<?php echo $login ?> "/>
                </div>
                <div class="espace">
                    <label for="passwd">Password:</label>
                    <input type="password" name="passwd" id="passwd" value="<?php echo $password ?> " />
                </div>
                <div class="btn1">
                    <input type="Submit" value="ENVOYER" name="envoie" >
                    <input type="Reset" value="ANNULER"  name="effacer" >
                </div>
            </form>
        </fieldset>
    <?php
    }
    else if ($compte=="user")
    {
        $res=User::getPersonneById($db,$login);
        $resultat = $res->fetch();
        $nom=$resultat->Nom;
        $prenom=$resultat->Prenom;
        $pays=$resultat->Pays;
        $ville=$resultat->Ville;
        $adresse=$resultat->Adresse;
        $email=$resultat->Email;
        $password=$resultat->Password;

        ?>
        <fieldset >
            <legend style="text-align: center">Modifier Votre profil </legend>
            <form action="modifierprofile.php" class="css" onsubmit="return formCheck(this);">
                <div class="espace">
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $nom ?> "/>
                </div>
                <div class="espace">
                    <label for="prenom">Pr&eacute;nom:</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $prenom ?> "/>
                </div>
                <div class="espace">
                    <label for="pays">Pays:</label>
                    <input type="text" name="pays"  id="pays" value="<?php echo $pays ?> "/>
                </div>
                <div class="espace">
                    <label for="ville">Ville:</label>
                    <input type="text" name="ville" id="ville" value="<?php echo $ville ?> "/>
                </div>
                <div class="espace">
                    <label for="Adresse">Adresse:</label>
                    <input type="text" name="adresse" id="Adresse" value="<?php echo $adresse ?> "/>
                </div>
                <div class="espace">
                    <label for="mail">Mail:</label>
                    <input type="text" name="mail" id="mail" value="<?php echo $email ?>"/>
                </div>
                <div class="espace">
                    <label for="login">login:</label>
                    <input type="text" name="login" id="login" value="<?php echo $login ?>" readonly />
                </div>
                <div class="espace">
                    <label for="passwd">Password:</label>
                    <input type="text" name="passwd" id="passwd" value="<?php echo $password ?>"/>
                </div>
                <div class="btn1">
                    <input type="Submit" value="ENVOYER" name="envoie1" >
                    <input type="Reset" value="ANNULER"  name="effacer" >
                </div>
            </form>
        </fieldset>
        <?php
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

