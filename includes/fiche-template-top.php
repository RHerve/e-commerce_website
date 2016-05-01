<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="../css/style-fiche-prod.css">
	<meta charset="UTF-8">
</head>
<body>

	<!-- PARTIE HAUTE -->

	<?php
	if(isset($_SESSION["PseudoUser"])){
	/*
	session_start();
	$_SESSION=array();
	unset($_SESSION);
	session_destroy();*/
	?>

		<?php 
			$connexionServeur = mysql_connect("127.0.0.1","root","");
			$connexionBDD = mysql_select_db("marchand");
		?>

	<div class="header">
			<div class="conteneur">
				<div class="logo"><h1 class="letter">e-</h1></div>
				<div class="logo-typo"><h1>Gaming</h1></div>
				<div class="right-user">
					<div class="welcome">
						<?php 
							echo 'Bienvenue '."<span class=\"user-pseudo\">".$_SESSION["PseudoUser"]."</span>";
						?>
					</div>
					<div class="user">
						<ul>
							<a href="php/deconnexion.php"><li>DECONNEXION</li></a>
						</ul>
					</div>
				</div>

			</div>
	</div>
	<div class="clear"></div>
	<?PHP
	}else{
	?>
	<div class="header">
			<div class="conteneur">
				<div class="logo"><h1 class="letter">e-</h1></div>
				<div class="logo-typo"><h1>Gaming</h1></div>
				<div class="user">
					<ul>
						<a href="../php/inscription.php"><li>INSCRIPTION</li></a>
						<a href="../php/connexion.php"><li>CONNEXION</li></a>
					</ul>
				</div>

			</div>
	</div>
	<div class="clear"></div>
	<?PHP
	}
	?>

	<!-- FIN PARTIE ENTETE -->



	<div class="line">
			<div class="conteneur">
					    <ul class="top-menu">
					        <a href="../index.php"><li>ACCUEIL</li></a>
					       <!-- <a href="#"><li>PRODUITS</li></a>-->
					        <a href="#"><li>A PROPOS</li></a>
					        <a href="#"><li>CONTACT</li></a>
					    </ul>

					    <div class="panier">
					    	<a href="saisie-produit.php">VOIR MON PANIER <span>0</span></a>
					    </div>
			</div>
	</div>
	<!-- FIN PARTIE HAUTE -->

		<div class="conteneur">

				<h2 class="titre-body">Fiche du produit</h2>
				<div class="fiche-prod">
					<div class="img-prod"></div>
					<div class="desc-prod">


						<form method="post" action="../saisie-produit.php">

