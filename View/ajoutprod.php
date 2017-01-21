<!DOCTYPE HTML>
<?php
include ("../Include/db.php");
include ("../Include/Session.php");
include ("../Classes/Produit.php");
include ("../Classes/Fournisseur.php");
 $nom=$session->outSession('Nom');
$login=$session->outSession('Login');

if(isset($_POST['envoie']))
{
	$ref=$_POST['ref'];
	$marque=$_POST['marque'];
	$typeprod=$_POST['modele'];
	$qte=$_POST['qte'];
	$soc=$_POST['soc'];
	$couleur=$_POST['couleur'];
	$prix=$_POST['prix'];
	if(isset($_FILES['ech']))
	{
		$name=$_FILES['ech']['name'];
		$type=$_FILES['ech']['type'];
		$size=$_FILES['ech']['size'];
		$temp=$_FILES['ech']['tmp_name'];
		$error=$_FILES['ech']['error'];
		$date=date("s-i-d-m-y");
		$image_nom=$nom."_".$date.".jpg";
		move_uploaded_file($temp,"../Upload/".$image_nom);
		$ech="../Upload/".$image_nom;
	}
	else
	{
		$ech='';
	}
	$f=new Produit($ref,$marque,$typeprod,$ech,$couleur,$prix,$qte,$nom);
	$f->setProduit($db);
	header("location:produit.php");
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


	<link rel="stylesheet" href="http://www.formmail-maker.com/var/demo/jquery-popup-form/colorbox.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://www.formmail-maker.com/var/demo/jquery-popup-form/jquery.colorbox-min.js"></script>

	<script>
		$(document).ready(function(){
			$(".iframe").colorbox({iframe:true, fastIframe:false, width:"450px", height:"700px", transition:"fade", scrolling   : false});
		});
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
	<style>
		#global
		{
			margin-top: -150px;
		}
		input
		{
			margin-left:40px;
			border-radius:5px;
			height:21px;
			width:173px;
		}

		label
		{
			line-height:30px;
		}
		input#echantillon
		{
			width:280px;
		}
		.espace
		{
			margin-top: 10px;
		}
		#premier
		{
			margin-top: 40px;
		}
		.ech
		{
			margin-left: 150px;
			margin-top: 10px;
		}
		.btn1 input
		{
			height:22px;
			width:95px;
		}
	</style>
<!-- start menu -->     
<link href="../Web/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../Web/js/megamenu.js"></script>

</head>
<body>
  <div class="header-top">
	 <div class="wrap"> 
		<div class="logo">
			<a href="index.html"><img src="../Web/images/logo.png" alt=""/></a>
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
				<fieldset style="height: 440px">
					<legend style="text-align:center;">Ajout d'un produit</legend>
					<form action="" class="css" onsubmit="return formCheck(this);" method="post" enctype="multipart/form-data">
						<div id="premier"><div class="espace">
						<label for="nom">Reference:</label>
						<input type="text" name="ref" id="ref" />
					</div></div>
					<div class="espace">
					<label for="marque">Marque:</label>
					<input type="text" name="marque" id="marque" />
					</div>
					<div class="espace">
					<label for="modele">Modele:</label>
					<input type="text" name="modele"  id="modele" />
					</div>
					<div class="ech">
					<label for="echantillon">Echantillon:</label>
					<input type="file" name="ech" id="ech" style="width:320px" />
					</div>
					<div class="espace">
					<label for="couleur">Couleur:</label>
					<input type="text" name="couleur" id="couleur" />
					</div>
					<div class="espace">
					<label for="prix">Prix:</label>
					<input type="text" name="prix" id="prix" />
					</div>
					<div class="espace">
					<label for="quantite">Quantite:</label>
					<input type="text" name="qte" id="qte" />
					</div>
					<div class="espace">
					<label for="societe">Societe:</label>
					<input type="text" name="soc" id="soc" value="<?php echo $nom ?>" readonly />
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

</html>
</body>
</html>