<!DOCTYPE HTML>
<?php
include ("../Include/Session.php");
include ("../Include/Panier.php");
include("../Include/db.php");
include ("../Classes/Stock.php");
include ("../Classes/Fournisseur.php");
/******************************************Pagination************************************/

$messagesParPage=6;

$res=Stock::getNombreProduitsById($db);
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
/*--------------------------------------------------Recuperer Couleur et QTE-------------*/

	if (isset($_GET['envoie']))
	{
		$ref=$_GET['ref'];
		$qte=$_GET['qte'];
		$res=Stock::getdeStockById($db,$ref);
		$resultat=$res->fetch();
		$prix=$resultat->Prix;
		if ($session->verifexistence('Login'))
		{
			$prix=$resultat->Prix;
		}
		else
		{
			$prix=$resultat->Prix+($resultat->Prix*0.08);
		}
		$nom=$resultat->Fournisseur." ".$resultat->Marque." ".$resultat->Modele;
		$couleur=$_GET['couleur'];
		Panier::ajouterProduit($ref,$nom,$qte,$prix,$couleur);
		//print_r($_SESSION['panier']);
	}


/****************************************************************************************/

?>

<html>
<head>
<title>SHARK E-COMMERCE | HOME </title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/style_index.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/scrollbar.css" rel="stylesheet" type="text/css" media="all" />
<link href='../Web/css/googleapis.css' rel='stylesheet' type='text/css'>

	<!----------------------------------------------SLIDE---------------------------------------------->
	<script type="text/javascript" src="../Web/js/Slide/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="../Web/js/Slide/jssor.slider.mini.js"></script>

	<script>
		jQuery(document).ready(function ($) {

			var jssor_1_SlideoTransitions = [
				[{b:0.0,d:800.0,y:-290.0,e:{y:27.0}}],
				[{b:0.0,d:1000.0,y:185.0},{b:1000.0,d:500.0,o:-1.0},{b:1500.0,d:500.0,o:1.0},{b:2000.0,d:1500.0,r:360.0},{b:3500.0,d:1000.0,rX:30.0},{b:4500.0,d:500.0,rX:-30.0},{b:5000.0,d:1000.0,rY:30.0},{b:6000.0,d:500.0,rY:-30.0},{b:6500.0,d:500.0,sX:1.0},{b:7000.0,d:500.0,sX:-1.0},{b:7500.0,d:500.0,sY:1.0},{b:8000.0,d:500.0,sY:-1.0},{b:8500.0,d:500.0,kX:30.0},{b:9000.0,d:500.0,kX:-30.0},{b:9500.0,d:500.0,kY:30.0},{b:10000.0,d:500.0,kY:-30.0},{b:10500.0,d:500.0,c:{x:87.50,t:-87.50}},{b:11000.0,d:500.0,c:{x:-87.50,t:87.50}}],
				[{b:0.0,d:800.0,x:410.0,e:{x:27.0}}],
				[{b:-1.0,d:1.0,o:-1.0},{b:0.0,d:800.0,o:1.0,e:{o:5.0}}],
				[{b:-1.0,d:1.0,c:{x:175.0,t:-175.0}},{b:0.0,d:800.0,c:{x:-175.0,t:175.0},e:{c:{x:7.0,t:7.0}}}],
				[{b:-1.0,d:1.0,o:-1.0},{b:0.0,d:800.0,x:-570.0,o:1.0,e:{x:6.0}}],
				[{b:-1.0,d:1.0,o:-1.0,r:-180.0},{b:0.0,d:800.0,o:1.0,r:180.0,e:{r:7.0}}],
				[{b:0.0,d:1000.0,y:80.0,e:{y:24.0}},{b:1000.0,d:1100.0,x:570.0,y:170.0,o:-1.0,r:30.0,sX:9.0,sY:9.0,e:{x:2.0,y:6.0,r:1.0,sX:5.0,sY:5.0}}],
				[{b:2000.0,d:800.0,rY:30.0}],
				[{b:0.0,d:500.0,x:-105.0},{b:500.0,d:500.0,x:230.0},{b:1000.0,d:500.0,y:-120.0},{b:1500.0,d:500.0,x:-70.0,y:120.0},{b:2600.0,d:500.0,y:-80.0},{b:3100.0,d:900.0,y:160.0,e:{y:24.0}}],
				[{b:0.0,d:1000.0,o:-0.4,rX:2.0,rY:1.0},{b:1000.0,d:1000.0,rY:1.0},{b:2000.0,d:1000.0,rX:-1.0},{b:3000.0,d:1000.0,rY:-1.0},{b:4000.0,d:1000.0,o:0.4,rX:-1.0,rY:-1.0}]
			];

			var jssor_1_options = {
				$AutoPlay: true,
				$Idle: 2000,

				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$
				},
				$BulletNavigatorOptions: {
					$Class: $JssorBulletNavigator$
				}
			};

			var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

			//responsive code begin
			//you can remove responsive code if you don't want the slider scales while window resizing
			function ScaleSlider() {
				var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
				if (refSize) {
					refSize = Math.min(refSize, 800);
					jssor_1_slider.$ScaleWidth(refSize);
				}
				else {
					window.setTimeout(ScaleSlider, 30);
				}
			}
			ScaleSlider();
			$(window).bind("load", ScaleSlider);
			$(window).bind("resize", ScaleSlider);
			$(window).bind("orientationchange", ScaleSlider);
			//responsive code end
		});
	</script>
	<script>
		jQuery(document).ready(function ($) {

			var jssor_2_SlideoTransitions = [
				[{b:0.0,d:800.0,y:-290.0,e:{y:27.0}}],
				[{b:0.0,d:1000.0,y:185.0},{b:1000.0,d:500.0,o:-1.0},{b:1500.0,d:500.0,o:1.0},{b:2000.0,d:1500.0,r:360.0},{b:3500.0,d:1000.0,rX:30.0},{b:4500.0,d:500.0,rX:-30.0},{b:5000.0,d:1000.0,rY:30.0},{b:6000.0,d:500.0,rY:-30.0},{b:6500.0,d:500.0,sX:1.0},{b:7000.0,d:500.0,sX:-1.0},{b:7500.0,d:500.0,sY:1.0},{b:8000.0,d:500.0,sY:-1.0},{b:8500.0,d:500.0,kX:30.0},{b:9000.0,d:500.0,kX:-30.0},{b:9500.0,d:500.0,kY:30.0},{b:10000.0,d:500.0,kY:-30.0},{b:10500.0,d:500.0,c:{x:87.50,t:-87.50}},{b:11000.0,d:500.0,c:{x:-87.50,t:87.50}}],
				[{b:0.0,d:800.0,x:410.0,e:{x:27.0}}],
				[{b:-1.0,d:1.0,o:-1.0},{b:0.0,d:800.0,o:1.0,e:{o:5.0}}],
				[{b:-1.0,d:1.0,c:{x:175.0,t:-175.0}},{b:0.0,d:800.0,c:{x:-175.0,t:175.0},e:{c:{x:7.0,t:7.0}}}],
				[{b:-1.0,d:1.0,o:-1.0},{b:0.0,d:800.0,x:-570.0,o:1.0,e:{x:6.0}}],
				[{b:-1.0,d:1.0,o:-1.0,r:-180.0},{b:0.0,d:800.0,o:1.0,r:180.0,e:{r:7.0}}],
				[{b:0.0,d:1000.0,y:80.0,e:{y:24.0}},{b:1000.0,d:1100.0,x:570.0,y:170.0,o:-1.0,r:30.0,sX:9.0,sY:9.0,e:{x:2.0,y:6.0,r:1.0,sX:5.0,sY:5.0}}],
				[{b:2000.0,d:800.0,rY:30.0}],
				[{b:0.0,d:500.0,x:-105.0},{b:500.0,d:500.0,x:230.0},{b:1000.0,d:500.0,y:-120.0},{b:1500.0,d:500.0,x:-70.0,y:120.0},{b:2600.0,d:500.0,y:-80.0},{b:3100.0,d:900.0,y:160.0,e:{y:24.0}}],
				[{b:0.0,d:1000.0,o:-0.4,rX:2.0,rY:1.0},{b:1000.0,d:1000.0,rY:1.0},{b:2000.0,d:1000.0,rX:-1.0},{b:3000.0,d:1000.0,rY:-1.0},{b:4000.0,d:1000.0,o:0.4,rX:-1.0,rY:-1.0}]
			];

			var jssor_2_options = {
				$AutoPlay: true,
				$Idle: 2000,

				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$
				},
				$BulletNavigatorOptions: {
					$Class: $JssorBulletNavigator$
				}
			};

			var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

			//responsive code begin
			//you can remove responsive code if you don't want the slider scales while window resizing
			function ScaleSlider() {
				var refSize = jssor_2_slider.$Elmt.parentNode.clientWidth;
				if (refSize) {
					refSize = Math.min(refSize, 800);
					jssor_2_slider.$ScaleWidth(refSize);
				}
				else {
					window.setTimeout(ScaleSlider, 30);
				}
			}
			ScaleSlider();
			$(window).bind("load", ScaleSlider);
			$(window).bind("resize", ScaleSlider);
			$(window).bind("orientationchange", ScaleSlider);
			//responsive code end
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
<script type="text/javascript" src="js/megamenu.js"></script>

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
				   $login=$session->outSession('Login');
				  ?>
			   <?php
				   $cpt=$session->outSession('Compte');
				  // echo $cpt;
				   if ($cpt=="admin")
				   {
					   ?>
					   <ul class="admin">
						   <li class="active"><a href="gestion_fournisseurs.php">Fournisseurs</a></li>
						   <li class="active"><a href="deconnexion.php">LOG OUT</a></li>
						   <li STYLE='color:red;font-weight: bold;text-align:right;font-family: Helvetica;font-size: 1.22em;'><?php echo $login ?></li>

					   </ul>
					   <?php
				   }
				   elseif ($cpt=="fournisseur")
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
						</div>
				<?php
				   }
			   }
			  else
			  {
				?>
					<ul class="inconnu">
						<li><a href="checkout.php">CheckOut</a></li>
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
		<div class="clear"></div>
		</div>
   </div>
	  <?php
	  if(empty($_SESSION['Login'])) {
		  echo '<div id="decalage" style="height: 14px"></div>';
	  }
	  ?>
	  <div class="header-bottom" >
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
		<div id=Content>

			<div class="banniere">
					<div class="div1">
						<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 270px; overflow: hidden; visibility: hidden;">
							<!-- Loading Screen -->
							<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
								<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
								<div style="position:absolute;display:block;background:url('../Web/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
							</div>
							<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 270px; overflow: hidden;">
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/images25.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/f16881_3.png" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/602x442_1388680970.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/cartier-calibre-cadran-1.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/images564.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/71898086_large.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/rolex-watch.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/24833.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/7d1c07cc277d351fa6964ad2215528ba_large.jpeg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/EZF.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/image-top.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/imagesreg.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/imagesZE.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/indexgre.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/iwc-ingenieur-calendrier-perpetuel-digital-date-et-mois-1.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/montre-Omega-Seamaster-Aqua-Terra-GMT.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/Omega_focus.jpg" />
								</div>
								<div data-p="112.50" style="display: none;">
									<img data-u="image" src="../Web/images/bann1/omega-seamaster-aqua-terra-gmt-1.jpg" />
								</div>
							</div>
							<!-- Bullet Navigator -->
								<div data-u="navigator" class="jssorb01" style="bottom:15px;right:16px;">
									<div data-u="prototype" style="width:12px;height:12px;"></div>
								</div>

						</div>
					</div>
			<div class="div2">
				<div id="jssor_2" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 200px; height: 119px; overflow: hidden; visibility: hidden;">
					<!-- Loading Screen -->
					<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
						<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
						<div style="position:absolute;display:block;background:url('../Web/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
					</div>
					<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 200px; height: 119px; overflow: hidden;">
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/rolex-logo.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/festina.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/s2.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/580105.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/OMEGA.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/iwc.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/Breitling_logo.png" />
						</div>
						<div data-p="112.50" style="display: none;">
							<img data-u="image" src="../Web/images/banniere/zenith-logo.png" />
						</div>
					</div>
				</div>
			</div>
		</div>
			<div id="barre">
				<div id="present"><img src="../Web/images/ph.png"/><div class="title">About Us</div></div>
				<div id="seemore"><p>SHARK E-COMMERCE is a free farm which present services for severals kind of poeple from all over the world..<a href="AboutAs.php">SeeMore>></a> </p></div>
				</div>
			<div id="product">
				<?php
				$res=Stock::getProduitsParPageById($db,$premiereEntree,$messagesParPage);
				while ($resultat = $res->fetch())
				{
					echo"<div class='prod'><form action='index.php' method='get'><input type='hidden' value='".$resultat->Reference."' name='ref'><a href='Consulterprod.php?id=".$resultat->Reference."'><img src='".$resultat->Echantillon."'/></a><div class='title'>".$resultat->Fournisseur."</div><div class='modele'><div class='titre'>Gamme : </div>".$resultat->Marque."</div><div class='Marque'><div class='titre'>Modele : </div>".$resultat->Modele."</div><div class='clr'><div class='titre'>Couleur Disponible : </div>";
					$verifier=substr_count($resultat->Couleur,',');
					if ($verifier)
					{
						$couleurs=explode(',',$resultat->Couleur);
						$nombre=sizeof($couleurs);
						echo "<select name='couleur'>";
						for ($i=0;$i<$nombre;$i++)
						{
							echo "<option value'".strtoupper($couleurs[$i])."'>".strtoupper($couleurs[$i])."</option>";
						}
						echo "</select></div>";
					}
					else
					{
						echo "<input type='text' id='couleur' name='couleur' value='".strtoupper($resultat->Couleur)."'readonly></div>";
					}
					echo"<div class='Price'><div class='titre'> Prix : </div>".$resultat->Prix." &euro;</div>";
					$max=$resultat->Quantite;
					echo "<div class='qte'><div class='titre'>Quantite :</div><select name='qte'>";
					for ($i=1;$i<$max;$i++)
					{
						echo "<option value='".$i."'>".$i."</option>";
					}
					echo "</select></div>";
					echo"<input type='submit' class='bouton' value='Ajouter aux panier' name='envoie'></form></div>";
				}
				echo '<div class="clear"></div>';
				/************************************* Pagination**********************************/

				echo '<div class="pagination" STYLE="margin-left: -220px;"><div class="title">Page :</div> ';
				for($i=1; $i<=$nombreDePages; $i++)
				{
					if($i==$pageActuelle)
					{
						echo '<div class="page" style="font-weight: bolder;">'.$i.'</div>';
					}
					else
					{
						echo '<div class="page"><a href="index.php?page='.$i.'">'.$i.'</a></div>';
					}
				}
				echo '</div>';

				/**********************************************************************************/
				?>
			</div>
		</div>
	  <script>
	  </script>
	<style>

	</style>

</body>
</html>