<!DOCTYPE HTML>
<?php
include ("../Include/db.php");
include ("../Classes/Fournisseur.php");
include ("../Include/Session.php");

$nom=$_GET['id'];
$res=Fournisseur::getFournisseurById($db,$nom);
while ($resultat = $res->fetch())
{

	$adr=$resultat->Adresse;
	$siege=$resultat->Siege;
	$login=$resultat->Login;
	$password=$resultat->Password;
}
/**/
?>
<html>
<head>
<title>SHARK E-COMMERCE | MODIFY SUPPLIER</title>
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
	   <div id=global>
    		  
				<fieldset>
				<legend STYLE="text-align: center">Modifier Le profil d'un fournisseur</legend>
					<form action="gestionf.php" class="css">
					<div class="espace" style="margin-top: 30px">
					<label for="prenom">Nom societe:</label>
					<input type="text" name="nom" id="nom" value="<?php echo $nom ?> "/>
					</div>
					<div class="espace">
					<label for="pays">Adresse:</label>
					<input type="text" name="adr"  id="adresse" value="<?php echo $adr ?> "/>
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

