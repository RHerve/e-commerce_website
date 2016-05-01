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

				// SELECTION DE TOUS LES JEUX
				$requeteListe = mysql_query("SELECT * FROM jeu");
				//$tableauListeJeu = mysql_fetch_assoc($requeteListe);


				//$requetePlateforme = mysql_query("SELECT * FROM plateforme, appartenir WHERE IdPlateforme");
				//$rqtPf = mysql_fetch_assoc($requetePlateforme);

				




			?>

				

			<h2 class="titre-body">Espace administration</h2>

			<div class="tabs">
				<div class="tab-button" id="active"><a href="">Gestion des produits</a></div>
				<div class="tab-button"><a href="admin_membre.php">Gestion des membres</a></div>
			</div>

			<div class="clear"></div>

			<div class="contenu">

				<!-- PRODUITS LISTE -->

				<div class="boutons-top">
					<div class="boutons-regl-a"><a href="ajout-prod.php">Ajouter un nouveau jeu</a></div>
					<div class="boutons-regl-a"><a href="ajout-pf.php">Ajouter une nouvelle plateforme</a></div>
				</div>

				<div class="produits">
				
					<div class="prod-liste">
						<table class="prod-liste-tab">
							<thead>
								<tr>

									<th>Jeu</th>
									<th>Plateforme</th>
									<th>Prix unitaire</th>
									<th>Quantité totale</th>
									<th></th> <!-- Enlever produit -->
								</tr>
							</thead>
							<tbody>

							

							<?php
								

								// BOUCLE POUR AFFICHAGE DES PRODUITS

								while($ligneRequete=mysql_fetch_assoc($requeteListe)) {


									//PLATEFORMES PAR JEU
									$requeteListePlatforme = mysql_query("SELECT NomPlateformeProd FROM plateformeprod, jeu WHERE plateformeprod.IdPlateformeProd = jeu.IdPlateformeProd AND NomJeu = '".$ligneRequete["NomJeu"]."' ");
									$ligneRequetePf = mysql_fetch_array($requeteListePlatforme);

									//PRIX PAR JEU
									$requeteListePrix = mysql_query("SELECT PrixJeuProd FROM plateformeprod, jeu WHERE plateformeprod.IdPlateformeProd = jeu.IdPlateformeProd AND NomJeu = '".$ligneRequete["NomJeu"]."' ");
									$ligneRequetePrix = mysql_fetch_array($requeteListePrix);

									//ID DU JEU
									$idJeu = mysql_query("SELECT IdJeu FROM jeu WHERE NomJeu = '".$ligneRequete["NomJeu"]."' ");
									$ligneIdJeu = mysql_fetch_array($idJeu);
									$lIdJeu = $ligneIdJeu['IdJeu'];
									

									//<a href=\"admin-produit.php?jid=  \">
																	//<div class=\"img-cross\"></div>
															   //</a>-->


									echo "<TR>";

												//Nom
												echo "<TD style=\"font-weight:bold\">".$ligneRequete["NomJeu"]."</TD>";
												//PlateForme
												echo "<TD>".$ligneRequetePf["NomPlateformeProd"]."</TD>";
												//Prix Unitaire
												echo "<TD>". $ligneRequetePrix["PrixJeuProd"].' €'."</TD>";
												//Quantité
												echo "<TD>".$ligneRequete["quantiteJeu"]."</TD>";
												//Supprimer
												echo "<TD class=\"cross\">"
																		?>
																

																<a href="php/admin_produit_suppr.php?jid=<?php echo $ligneIdJeu['IdJeu']; ?>">
																	<div class="img-cross"></div>
															   </a>

															
													  </TD>

											<?php echo "</TR>";
										
								}
							?>

							

							</tbody>
						</table>

					</div>
					<?php

							if(isset($_POST['valider'])) {
								$idDuJeu = $_POST['idJeuPf'];

								$suppr = "DELETE FROM jeu WHERE IdJeu = '$idDuJeu'";
								$reqSuppr = mysql_query($suppr) or die (mysql_error());
								
								if($reqSuppr){
									echo "<h2>"."Jeu supprimé avec succès"."</h2>"; 
								}
							} 
							else {
								echo "<h2>"."</h2>";
							}

					?>

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