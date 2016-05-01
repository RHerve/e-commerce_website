<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="css/style-admin.css">
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

		<!-- TEST SI L'UTILISATEUR EST CONNECTE EN TANT QU'ADMIN -->
		<?php

			if(isset($_SESSION["PseudoUser"]) && isset($_SESSION["TypeUser"])){ 

			?>

				

			<h3 class="titre-body">Espace administration</h3>

			<div class="tabs">
				<div class="tab-button" id="active"><a href="admin_produit.php">Gestion des produits</a></div>
				<div class="tab-button"><a href="admin_membre.php">Gestion des membres</a></div>
			</div>

			<div class="clear"></div>

			<div class="contenu">

				<!-- FORMULAIRE -->
				<h2>Ajouter un jeu</h2>
				
				<div class="formulaire">
					<form method="post" action="php/action-ajout-prod.php">
						
						<div class="gauche-top">
						 	 	<p class="label">Nom du jeu<span> *</span></p>
							 	<input type="text" name="jeu" id="jeu" class="champ-petit" required>
						</div>

						<div class="droite-top">

								<?php 
								// PLATEFORME
								$listePlateforme = mysql_query("SELECT NomPlateformeProd FROM plateformeprod");
								//$ligneRequetePf = mysql_fetch_assoc($listePlateforme);

								?>
								<p class="label">Plateforme<span> *</span></p>
								<select name="plateforme">
									<?php while($ligneRequete=mysql_fetch_assoc($listePlateforme)) {
									?>
										<option value="<?php echo $ligneRequete['NomPlateformeProd']; ?>"><?php echo $ligneRequete['NomPlateformeProd'] ;?></option>
									<?php
									} 
									?>
								</select>
						</div>

						<div class="droite">
							<p class="label">Quantité<span> *</span></p>
							<input name="quantite" class="quantite" type="number" min="0" required>
						</div>


						<div class="clear"></div>

						<div class="desc">
							<p class="label">Description<span> (500 caractères max.)*</span></p>
							<textarea name="description" required></textarea>
						</div>

						<div class="thumb_gauche">
							<p class="label">Jaquette du jeu<span> (350*360px)</span></p>
							<input type="file"  value="">
						</div>
						<div class="thumb_droite">
							<p class="label">Vignette du jeu<span> (248*200px)</span></p>
							<input type="file"  value="">
						</div>

						<div class="clear"></div>

						<div class="validation">
				 			<input class="but-form" type="submit" name="valider" value="Ajouter">
				 			<input class="but-form" type="reset" value="Annuler">
					 	</div>

					 	<div class="clear"></div>




					</form>
				</div>
			<?php
				// RECUPERATION VARIABLES

				
				
			?>


			<?php
				//var_dump($pfJeu);
				}
				else {
			?>

			<!-- SI IL N'EST PAS CONNECTE EN TANT QU'ADMIN -->
				<div class="title-info">Erreur, vous devez être connecté en tant qu'administrateur pour accéder à cette page.</div>

					<?php
				}
			?>


			</div> <!-- FIN CONTENEUR -->



</body>
</html>