<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="css/style-action-co.css">
	<meta charset="UTF-8">
</head>
<body>
	<!-- PARTIE HAUTE -->
		<?php include("includes/entete.php");?>

		<?php include("includes/menu.php");?>

		<!-- FIN PARTIE HAUTE -->

		<!-- CORPS DE LA PAGE -->

		<div class="clear"></div>
		<div class="conteneur">


		<?php 
			$connexionServeur = mysql_connect("127.0.0.1","root","");
			$connexionBDD = mysql_select_db("marchand");
		?>

		<!-- TEST SI L'UTILISATEUR EST CONNECTE -->
		<?php
			if(isset($_SESSION["PseudoUser"])){
		?>


			<!-- PRODUITS  -->

			<h2 class="titre-body">Mon panier</h2>

			<div class="produits">


			<?php

					
						// VARIABLE POUR LES VALEURS
						$ref = $_GET['id'];	 //the product id from the URL 
						echo "Id de la référence:". $ref;

						if(isset($ref)){

							if (!isset($_SESSION['caddie'])) {
								$_SESSION['caddie'] = array();
							}

							if(isset($_SESSION['caddie'][$ref])) {
								$_SESSION['caddie'][$ref]++;
							} else {
								$_SESSION['caddie'][$ref] = 1;
							}

						}

						


						//if((isset($row['NomJeu'])) && (isset($rowPfJeu['NomPlateformeProd'])) && (isset($rowQte['quantiteJeu']))){




						header("Location: panier-liste.php");
						//}
						//else {
						//	echo "Erreur d'initialisation";
						//}


					



		} else {

			?>
				<!-- SI IL N'EST PAS CONNECTE -->
				<div class="title-info">Erreur, vous devez être connecté pour poursuivre cette étape.</div>

				<div class="formulaire">
				 <form action="php/action-co.php" method="post">

				     <div class="gauche">
				     		<h3>Nouveaux membres</h3>
				     		<div class="desc">
				 	 			<p>En créant un compte sur notre boutique, vous serez en mesure de vous déplacer à travers le processus de paiement plus rapidement, stocker des adresses d'expédition multiples, consulter et suivre vos commandes dans votre compte et plus encore.</p>
				 			 </div>

				 			 <div class="clear-left"></div>
				 			 <a href="php/inscription.php"><div class="but-new-inscr">S'INSCRIRE MAINTENANT</div></a>

				 	 </div>

				 	 <div class="mid"></div>


				 	 <div class="droite">
				 			 <h3>Membres enregistrés</h3>
						 	 <div class="pw">
					 	 		<p class="label">Pseudo</p>
						 		<input type="text" name="pseudo-user" class="champ-grand" required>
						 	</div>
						 	<div class="pw">
					 	 		<p class="label">Mot de passe<span>*</span></p>
						 		<input type="password" name="pw-user" class="champ-grand" required>
						 	</div>

						 	 <div class="validation">
						 		<input class="but-form" type="submit" name="valider" value="Connexion">
				 				<input class="but-form" type="reset" value="Annuler">
							 </div>

					 </div>

				 </form>

			</div>

				<?php

		}


					?>

		</div>

	</div>



</body>
</html>