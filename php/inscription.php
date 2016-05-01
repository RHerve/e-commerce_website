<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="../css/style-inscr.css">
	<meta charset="UTF-8">
</head>
<body>

	<!-- PARTIE HAUTE -->

	<?php include("../includes/entete_2.php");?>

    <?php include("../includes/menu_2.php");?>

	<!-- FIN PARTIE HAUTE -->

	<!-- FORMULAIRE INSCRIPTION -->

	<div class="conteneur">
		
			<h2 class="titre-user">Créer un compte</h2>
			<div class="formulaire">
				 <form action="action-regist.php" method="post">

				     <div class="gauche">
					    	<div class="gauche-under">
					 	 		<p class="label">Votre prénom<span>*</span></p>
						 		<input type="text" name="prenom" id="prénom" class="champ-petit" required>
						 	</div>

						 	<div class="droite-under">
						 		<p class="label">Votre pseudo<span>*</span></p>
						 		<input type="text" name="pseudo" id="pseudo" class="champ-petit" required>
						 	</div>

					 	 	<div class="gauche-under">
					 	 		<p class="label">Votre email<span>*</span></p>
						 		<input type="email" name="email" id="email" class="champ-petit" required>
						 	</div>

						 	<div class="droite-under">
						 		<p class="label">Confirmer email<span>*</span></p>
						 		<input type="email" name="confirm-email" id="confemail" class="champ-petit" required>
						 	</div>
				 	 </div>



				 	 <div class="droite">
						 	 <div class="pw">
					 	 		<p class="label">Votre mot de passe<span>*</span></p>
						 		<input type="password" name="pw" id="pw" class="champ-grand" required>
						 	</div>
						 	<div class="pw">
					 	 		<p class="label">Confirmer mot de passe<span>*</span></p>
						 		<input type="password" name="confirm-pw" id="pw" class="champ-grand" required>
						 	</div>
				 	 </div>

				 	 <div class="clear"></div>

				 	 <div class="check">
				 	 	<p>Vous possédez déjà un compte ? <a href="connexion.php">Connectez-vous !</a></p>
				 	 </div>

				 	 <div class="validation">
				 		<input class="but-form" type="submit" name="valider" value="Confirmer">
				 		<input class="but-form" type="reset" value="Annuler">
					 </div>

				 </form>

			</div>

		<!-- FIN FORMULAIRE INSCRIPTION -->

	</div>

</body>
</html>