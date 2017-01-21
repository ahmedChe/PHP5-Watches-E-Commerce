<!DOCTYPE HTML>
<?php
include ("../Include/db.php");
include ("../Include/Session.php");
include ("../Include/Panier.php");
include ("../Classes/User.php");
include ("../Classes/fournisseur.php");
if(isset($_GET['envoie3']))
{
	$login=$_GET['login'];
	$password=$_GET['passwd'];
	$res=Fournisseur::getAllFournisseur($db);
	$test=false;
	while (($resultat = $res->fetch())&& ($test==false))
	{
		if  (($resultat->Login==$login)&& ($resultat->Password==$password))
		{
			$test=true;
			$nom=$resultat->Nom_societe;
		}
	}
	if ($test)
	{
		$session->inputSession('Nom',$nom);
		$session->inputSession('Login',$login);
		$session->inputSession('Compte','fournisseur');
		header("location:produit.php");
	}
	else
	{	
		?>
		<script language="javascript">alert("Invalid Password or Inexistant Login")</script>
		<?php

	}
}
if(isset($_GET['envoie2']))
{
	$login=$_GET['login'];
	$password=$_GET['passwd'];
	$res=User::getAllPersonne($db);
	$test=false;
	while (($resultat = $res->fetch())&& ($test==false))
	{
		if  (($resultat->Login==$login)&& ($resultat->Password==$password))
		{
			$test=true;
		}
	}
	if ($test)
	{
		$session->inputSession('Login',$login);
		$session->inputSession('Compte','user');
		header("location:index.php");
	}
	else
	{	
		?>
		<script language="javascript">alert("Invalid Password or Inexistant Login")</script>
		<?php

	}
}
if(isset($_GET['envoie1']))
{
	$login=$_GET['login'];
	$password=$_GET['passwd'];
	$res=User::getAllAdmin($db);
	$test=false;
	while (($resultat = $res->fetch())&& ($test==false))
	{
		if  (($resultat->Login==$login)&& ($resultat->pass==$password))
		{
			$test=true;
		}
	}
	if ($test)
	{
		header("location:index.php");
		$session->inputSession('Login',$login);
		$session->inputSession('Compte','admin');
	}
	else
	{	
		?>
		<script language="javascript">alert("Invalid Password or Inexistant Login")</script>
		<?php

	}
}
?>
<html>
<head>
<title>SHARK E-COMMERCE | LOG IN </title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../Web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Web/css/style_login.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../Web/js/jquery.min.js"></script>
	<style>
		#panier img
		{
			height: 70px;
			width: 90px;
			padding-top: 0px;
		}
		#panier .prix
		{
			float: right;
			line-height: 90px;
			font-weight: bold;
			margin-left: -5px;
			padding-right: 10px;
			font-size: 1.3em;
		}
		#panier
		{
			width:190px;
			height: 65px;
			float: right;
			margin-top: -70px;
		}
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
			<div id="panier"><a href="panier.php"><img src="../Web/images/panier3.png"/></a><div class="prix"><?php echo $panier?>&nbsp;&euro;</div>
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
		<fieldset>
		<legend>Administrateur</legend>
		<img src="../web/images/admin.png">  		  
				<fieldset class="field">
					<legend>Connexion</legend>
					<form action="login.php" method="get">
					<div class="espace">
					<label for="login">Login:</label>
					<input type="text" name="login" id="login" />
					</div>
					<div class="espace">
					 <label for="passwd">Password:</label>
					<input type="password" name="passwd" id="passwd" />
					</div>
					<div class="bouton">
					 <input type="Submit" name="envoie1" value="Login">
					</div>
					</form> 
				</fieldset>
		</fieldset>
		<fieldset>
		<legend>User</legend>
		<img src="../web/images/users.png">
			<fieldset class="field">
					<legend>Connexion</legend>
					<form action="login.php" method="get">
					<div class="espace">
					<label for="login">Login:</label>
					<input type="text" name="login" id="login" />
					</div>
					<div class="espace">
					 <label for="passwd">Password:</label>
					<input type="password" name="passwd" id="passwd" />
					</div>
					<div class="bouton">
					 <input type="Submit" name="envoie2" value="Login">
					</div>
					</form> 
				</fieldset>
		</fieldset>
		<fieldset>
		<legend>Supplier</legend>
		<img src="../web/images/staff.png">
			<fieldset class="field">
					<legend>Connexion</legend>
					<form action="login.php" method="get">
					<div class="espace">
					<label for="login">Login:</label>
					<input type="text" name="login" id="login" />
					</div>
					<div class="espace">
					 <label for="passwd">Password:</label>
					<input type="password" name="passwd" id="passwd" />
					</div>
					<div class="bouton">
					 <input type="Submit" name="envoie3" value="Login">
					</div>
					</form> 
				</fieldset>
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