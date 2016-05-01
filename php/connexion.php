<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="../css/style-co.css">
	<meta charset="UTF-8">
</head>
<body>

	<!-- PARTIE HAUTE -->

	<?php include("../includes/entete_2.php");?>

	<?php include("../includes/menu_2.php");?>

	<!-- FIN PARTIE HAUTE -->

	<!-- DEBUT DU CORPS -->

	<div class="conteneur">
		
			<h2 class="titre-user">Connexion</h2>
			<div class="formulaire">
				 <form action="action-co.php" method="post">

				     <div class="gauche">
				     		<h3>Nouveaux membres</h3>
				     		<div class="desc">
				 	 			<p>En créant un compte sur notre boutique, vous serez en mesure de vous déplacer à travers le processus de paiement plus rapidement, stocker des adresses d'expédition multiples, consulter et suivre vos commandes dans votre compte et plus encore.</p>
				 			 </div>

				 			 <div class="clear-left"></div>
				 			 <a href="inscription.php"><div class="but-new-inscr">S'INSCRIRE MAINTENANT</div></a>

				 	 </div>

				 	 <div class="mid"></div>


				 	 <div class="droite">
				 			 <h3>Membres enregistrés</h3>
						 	 <div class="pw">
					 	 		<p class="label">Pseudo</p>
						 		<input type="text" name="pseudo-user" class="champ-grand" required>
						 	</div>
						 	<div class="pw">
					 	 		<p class="label">Mot de passe</p>
						 		<input type="password" name="pw-user" class="champ-grand" required>
						 	</div>

						 	 <div class="validation">
						 		<input class="but-form" type="submit" name="valider" value="Connexion">
				 				<input class="but-form" type="reset" value="Annuler">
							 </div>

					 </div>

				 </form>

			</div>
	</div>



	<!-- FIN DU CORPS -->

</body>
</html>