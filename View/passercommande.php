<!DOCTYPE HTML>
<?php
include ("../Include/Session.php");
include ("../Include/db.php");
include ("../Classes/Produit.php");
include ("../Classes/Fournisseur.php");


$nom=$_GET['id'];
$session->inputSession('Nom',$nom);
$test=$session->verifexistence('Message');
if ($test)
{
    $msg=$session->outSession('Message');
    echo "<SCRIPT language='Javascript'>alert('".$msg."');</SCRIPT>";
    $session->detruirevariable('Message');
}
/******************************************Pagination************************************/

$messagesParPage=4;

$res=Produit::getNombreProduitsById($db,$nom);
$resultat= $res->fetch();
$total=$resultat->NOMBRE;
$nombreDePages=ceil($total/$messagesParPage);

if(isset($_GET['page']))
{
    $pageActuelle=intval($_GET['page']);

    if($pageActuelle>$nombreDePages)
    {
        $pageActuelle=$nombreDePages;
    }
}
else
{
    $pageActuelle=1;
}

$premiereEntree=($pageActuelle-1)*$messagesParPage;

/****************************************************************************************/

?>
<html>
<head>
    <title>SHARK E-COMMERCE | REQUEST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/style_login.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/gestion_fournisseurs.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../Web/css/passer_commande.css" rel="stylesheet" type="text/css" media="all" />
    <link href='../Web/css/googleapis.css' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../Web/js/jquery.min.js"></script>

    <!----------------------------------- FancyBox----------------------------------->
    <!-- Add jQuery library -->
    <script type="text/javascript" src="../Web/fancyapps-fancyBox/jquery-latest.min.js"></script>

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="../Web/fancyapps-fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="../Web/fancyapps-fancyBox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../Web/fancyapps-fancyBox/source/jquery.fancybox.pack.js"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="../Web/fancyapps-fancyBox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../Web/fancyapps-fancyBox/source/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="../Web/fancyapps-fancyBox/source/helpers/jquery.fancybox-media.js"></script>

    <link rel="stylesheet" href="../Web/fancyapps-fancyBox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../Web/fancyapps-fancyBox/source/helpers/jquery.fancybox-thumbs.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });
    </script>
    <!--------------------------------------------------------------------------------------->
    <script type="text/javascript">
        function Check(formobj) {
            var obj1 = formobj.elements["nombre"];
            var value1=obj1.value;
            var obj2 = formobj.elements["nombremax"];
            var val=obj2.value;
           var value2=parseInt(val);
            if ((value1=="")||(isNaN(value1))) {
                alert("Vous devez preciser la quantite demande.");
                return false;
            }
            else
            {
                if (value1 > value2)
                {
                    alert("La quantite demande n'est pas diponible...essayer plus tard !!");
                    return false;
                }
                    return true;
            }
        }
    </script>

    <style>
        #cboxOverlay{ background:#666666; }
    </style>

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
    <script language="JavaScript">
        <!--

        /***********************************************
         * Verification du contenu des zones des saisies
         ***********************************************/

        var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i

        function formCheck(formobj){
            // On met ici les noms des champs à contrôler
            var fieldRequired = Array("nom", "prenom","pays","ville","Adresse","mail","login","passwd","repasswd");
            // Description des zones de texte
            var fieldDescription = Array("Nom", "Prénom","Le pays","La ville","L'adresse","E-mail","Le login","Le mot de passe","Vérification de mot de passe");
            // Message de boite de dialogue
            var alertMsg = "Veuillez completer ces zones:\n";

            var l_Msg = alertMsg.length;

            for (var i = 0; i < fieldRequired.length; i++){
                var obj = formobj.elements[fieldRequired[i]];
                if (obj){
                    switch(obj.type){
                        case "select-one":
                            if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == ""){
                                alertMsg += " - " + fieldDescription[i] + "\n";
                            }
                            break;
                        case "select-multiple":
                            if (obj.selectedIndex == -1){
                                alertMsg += " - " + fieldDescription[i] + "\n";
                            }
                            break;
                        case "password":
                        case "text":
                        case "textarea":
                            if (obj.value == "" || obj.value == null){
                                alertMsg += " - " + fieldDescription[i] + "\n";
                            }
                            break;
                        default:
                    }
                    if (obj.type == undefined){
                        var blnchecked = false;
                        for (var j = 0; j < obj.length; j++){
                            if (obj[j].checked){
                                blnchecked = true;
                            }
                        }
                        if (!blnchecked){
                            alertMsg += " - " + fieldDescription[i] + "\n";
                        }
                    }
                }
            }


            /***********************************************
             * Validation de champ mail
             ***********************************************/
            var returnval=emailfilter.test(formobj.elements[fieldRequired[5]].value)
            if (returnval==false){
                alertMsg += " - " + "Le champs mail est invalide" + "\n";
                formobj.elements[fieldRequired[5]].select()
            }
            if ((formobj.elements[fieldRequired[7]].value)!=(formobj.elements[fieldRequired[8]].value)){
                alertMsg += " - " + "Mot de passe different " + "\n";
            }

            if (alertMsg.length == l_Msg){
                return true;
            }else{
                alert(alertMsg);
                return false;
            }
        }


        // -->
    </script>
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
            <a href="index.php"><img src="../Web/images/logo.png" alt=""/></a>
        </div>
        <div class="cssmenu">
            <?php $login=$session->outSession('Login'); ?>
            <ul class="admin">
                <li class="active"><a href="gestion_fournisseurs.php">Fournisseurs</a></li>
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
<body>
<div id=global>
    <?php
    echo '<table border-color="red" id="tableau" summary="La liste des produits Disponibles" style="margin-left: -10px">';
    echo "  <thead><tr><th>Reference</th><th>Marque</th><th>Modele</th><th>Couleur</th><th>Prix en Euro</th><th>Quantite</th><th></th><th style='text-align: center;'>Commande</th></tr></thead>";
    echo'<tfoot><tr><td colspan="9">La liste des produits Disponibles </td></tr></tfoot><tbody>';
    $res=Produit::getProduitsParPageById($db,$nom,$premiereEntree,$messagesParPage);
    while ($resultat = $res->fetch())
    {
        //$session->inputSession('img',$resultat->Echantillon);
        echo "<tr><td class='espace'>".$resultat->Reference."</td><td>".$resultat->Marque."</td><td>".$resultat->Modele."</td><td>".$resultat->Couleur."</td><td>".$resultat->Prix."</td><td>".$resultat->Quantite."</td><td>" ?><span id="vis"><div class="bouton" ><a href="<?php echo $resultat->Echantillon; ?>" class='fancybox'>Visualiser</a></div></span> <?php echo"</td><td>"?><form action="tete.php" method="post" onsubmit="return Check(this)"><input type="text" name="nombre" id="nombre"/><input type="hidden" value="<?php echo $resultat->Quantite ?>" name="nombremax" id="nombremax"/><input type="hidden" value="<?php echo $resultat->Reference ?>" name="reference" id="ref"/><span id="cmd"><input type="Submit" value="Commander" name="envoie" class="bouton"/></span></form> <?php echo "</td></tr>";
    }
    echo "</tbody></table>";
    /************************************* Pagination**********************************/

    echo '<div class="pagination"><div class="title">Page :</div> ';
    for($i=1; $i<=$nombreDePages; $i++)
    {
        if($i==$pageActuelle)
        {
            echo '<div class="page" style="font-weight: bolder;">'.$i.'</div>';
        }
        else
        {
            echo '<div class="page"><a href="passercommande.php?id='.$nom.'&page='.$i.'">'.$i.'</a></div>';
        }
    }
    echo '</p></div>';

    /**********************************************************************************/
    ?>
</div>
</body>
</html>