<!DOCTYPE HTML>
<?php
include ("../Include/Session.php");
include ("../Include/db.php");
include ("../Classes/Fournisseur.php");
?>
<html>
<head>
<title>SHARK E-COMMERCE | SUPPLIER</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/style_login.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/gestion_fournisseurs.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
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
			$("#iframe").colorbox({iframe:true, fastIframe:false, width:"395px", height:"508px",background:"#e8edff",transition:"fade", scrolling   : false});
		});
	</script>


	<style>
		#cboxOverlay{ background:#666666; }
	</style>

	<!------------------------------------------------------------------------------------------------------>

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
	   <div id=global>
    <?php
	echo '<table border-color="red" id="tableau" style="margin-left: 10px;" summary="La liste des fournisseurs">';
		echo "  <thead><tr><th>Nom Societe</th><th>Adresse</th><th>Siege</th><th>Login</th><th colspan='2'>" ?><div id="ajouter" class="bouton"><a id='iframe' href="ajout.php">Ajouter un fournisseur</a></div> <?php "</th></tr></thead>";
	echo'<tfoot><tr><td colspan="8">La liste des fournisseurs conventionnés </td></tr></tfoot><tbody>';
	$res=Fournisseur::getAllFournisseur($db);
	while ($resultat = $res->fetch())
	{
		 echo "<tr><td>".$resultat->Nom_societe."</td><td>".$resultat->Adresse."</td><td>".$resultat->Siege."</td><td>".$resultat->Login."</td><td>" ?><div class="commande"> <div class="bouton" id="consulter"><a href="passercommande.php?id=<?php echo $resultat->Nom_societe ?>">Consulter les produits</a></div></div> <?php echo"</td><td>"?><div class="bouton"><a href="modifier.php?id=<?php echo $resultat->Nom_societe ?>">Modifier</a></div> <?php "</td><td>" ?> <div class="bouton"><a href="supp.php?id=<?php echo $resultat->Nom_societe; ?>">Supprimer</a></div> <?php "</td></tr>";
	}
	echo "</tbody></table>";
	?>
		</div>

</body>
</html>