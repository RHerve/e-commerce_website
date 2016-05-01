<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="css/style-admin-membre.css">
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

				// SELECTION DE TOUS LES JEUX
				$membreListe = mysql_query("SELECT * FROM user");
				//$tableauListeJeu = mysql_fetch_assoc($requeteListe);


				//$requetePlateforme = mysql_query("SELECT * FROM plateforme, appartenir WHERE IdPlateforme");
				//$rqtPf = mysql_fetch_assoc($requetePlateforme);



			?>

				

			<h2 class="titre-body">Espace administration</h2>

			<div class="tabs">
				<div class="tab-button"><a href="admin_produit.php">Gestion des produits</a></div>
				<div class="tab-button" id="active"><a href="admin_membre.php">Gestion des membres</a></div>
			</div>

			<div class="clear"></div>

			<div class="contenu">

				<!-- PRODUITS LISTE -->


				<div class="membres">
				
					<div class="memb-liste">
						<table class="memb-liste-tab">
							<thead>
								<tr>

									<th>Prénom</th>
									<th>Pseudo</th>
									<th>Email</th>
									<th>Mdp</th>
									<th>Status</th>
									<th></th> <!-- Enlever produit -->
								</tr>
							</thead>
							<tbody>

							<?php
								

								// BOUCLE POUR AFFICHAGE DES PRODUITS

								while($ligneRequete=mysql_fetch_assoc($membreListe)) {

									//ID DU MEMBRE
									$idJeu = mysql_query("SELECT NumUser FROM user WHERE PrenomUser = '".$ligneRequete["PrenomUser"]."' ");
									$ligneIdJeu = mysql_fetch_array($idJeu);
									$lIdJeu = $ligneIdJeu['NumUser'];


									
									echo "<TR>";

												//Nom
												echo "<TD style=\"font-weight:bold\">".$ligneRequete["PrenomUser"]."</TD>";
												//PlateForme
												echo "<TD>".$ligneRequete["PseudoUser"]."</TD>";
												//Prix Unitaire
												echo "<TD>". $ligneRequete["EmailUser"]."</TD>";
												//Quantité
												echo "<TD>".$ligneRequete["MdpUser"]."</TD>";
												//Quantité
												echo "<TD>".$ligneRequete["TypeUser"]."</TD>";
												//Supprimer
												echo "<TD class=\"cross\">"
																		?>
																

																<a href="php/admin_membre_suppr.php?juser=<?php echo $ligneIdJeu['NumUser']; ?>">
																	<div class="img-cross"></div>
															   </a>

															
													  </TD>

											<?php echo "</TR>";

								}
							?>

							</tbody>
						</table>

					</div>

				</div>




		<?php
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