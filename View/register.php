<!DOCTYPE HTML>
<?php
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/Fournisseur.php");
include("../Include/db.php");
?>
<html>
<head>
<title>SHARK E-COMMERCE | REGISTER</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/style_register.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
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

</head>
<body>
  <div class="header-top">
	 <div class="wrap"> 
		<div class="logo">
			<a href="index.php"><img src="../Web/images/logo.png" alt=""/></a>
	    </div>
	    <div class="cssmenu">
			<ul class="inconnu">
				<li><a href="Checkout.php">CheckOut</a></li>
				<li><a class='iframe' href="../Include/form.php">Contact Us</a></li>
				<li class="active"><a href="register.php">Sign up & Save</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
			<?php $panier=Panier::Somme();?>
			<div id="panier"><a href="panier.php"><img src="../Web/images/panier3.png"/></a><div class="prix"><?php echo $panier?>&nbsp;&euro;</div> </div>

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
  <div id=global style="margin-top:-145px">
    		  
				<fieldset style="text-align: center">
					<legend>Inscription</legend>
					<form action="Inscription.php" class="css" onsubmit="return formCheck(this);">
					<div style="padding-top: 20px" class="espace">
						<label for="nom">Nom:</label>
						<input type="text" name="nom" id="nom" />
					</div>
					<div class="espace">
					<label for="prenom">Prénom:</label>
					<input type="text" name="prenom" id="prenom" />
					</div>
					<div class="espace">
					<label for="pays">Pays:</label>
					<input type="text" name="pays"  id="pays" />
					</div>
					<div class="espace">
					<label for="ville">Ville:</label>
					<input type="text" name="ville" id="ville" />
					</div>
					<div class="espace">
					<label for="Adresse">Adresse:</label>
					<input type="text" name="adresse" id="Adresse" />
					</div>
					<div class="espace">
					<label for="mail">Mail:</label>
					<input type="text" name="mail" id="mail" />
					</div>
					<div class="espace">
					<label for="login">login:</label>
					<input type="text" name="login" id="login" />
					</div>
					<div class="espace">
					 <label for="passwd">Password:</label>
					<input type="password" name="passwd" id="passwd" />
					</div>
					<div class="espace">
					<label for="repasswd">Retype Password:</label>
					<input type="password" name="repasswd" id="repasswd" />
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