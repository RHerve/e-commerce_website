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
			if(isset($_SESSION["PseudoUser"]))
			{
				
		?>


			<!-- PRODUITS  -->

			<h2 class="titre-body">Mon panier</h2>

			<div class="produits">
				<!--<form method="post" action="tab-prod.php">-->
				<!-- AFFICHAGE DU TABLEAU OU NON -->
				<?php


				if(isset($_SESSION['caddie'])){
					/*
					if($_SESSION['caddie']){ //si le caddie n'est pas vide
					*/
				?>
					<div class="prod-liste">
						<table class="prod-liste-tab">
							<thead>
								<tr>

									<th>Nom du produit</th>
									<th>Plateforme</th>
									<th>Prix unitaire</th>
									<th>Qté</th>
									<th>Prix total</th>
									<th></th> <!-- Enlever produit -->
								</tr>
							</thead>
							<tbody>

							<?php

									
							
										$total = 0; // variable prix total
											
										

										// BOUCLE AFFICHAGE
										
										foreach($_SESSION['caddie'] as $product_id => $quantity) {
										
											
											/////// REQUETES 
											// NOM JEU
											$getNom = mysql_query("SELECT NomJeu, IdPlateformeProd FROM jeu WHERE IdJeu = $product_id");
											$row_nomProd = mysql_fetch_assoc($getNom);

											// ID PLATFORME
											$resultsPfId = mysql_query("SELECT IdPlateformeProd FROM jeu WHERE IdJeu = $product_id");
											$row_IdPf = mysql_fetch_assoc($resultsPfId);
											

											// PRIX et PLATEFORME JEU
											$requetePrixJeu = "SELECT NomPlateformeProd, PrixJeuProd FROM plateformeprod WHERE IdPlateformeProd = '".$row_nomProd['IdPlateformeProd']."' ";
											$resultsPrixPf = mysql_query($requetePrixJeu) or die(mysql_error());
											$row_Pf = mysql_fetch_assoc($resultsPrixPf);
											
											//printf($resultsPrixPf);
												//list($price, $platform) = mysql_num_rows($resultsPrixPf);

												$line_cost = $row_Pf['PrixJeuProd'] * $quantity;		//COUT POUR UN PRODUIT
												$total = $total + $line_cost;			//add to the total cost

											// TABLEAU

											if($row_Pf['PrixJeuProd'] > 0){

												echo "<TR>";

												//Nom
												echo "<TD style=\"font-weight:bold\">". $row_nomProd['NomJeu'] ."</TD>";
												//PlateForme
												echo "<TD>". $row_Pf['NomPlateformeProd'] ."</TD>";
												//Prix Unitaire
												echo "<TD>". number_format($row_Pf['PrixJeuProd'], 2).' €'."</TD>";
												//Quantité
												echo "<TD>". $quantity ."</TD>";
												//Prix total
												echo "<TD>". number_format($line_cost, 2).' €'."</TD>";
												//Supprimer
												echo "<TD class=\"cross\">
																<a href=\"panier_retrait.php?retrait=$product_id\">
																	<div class=\"img-cross\"></div>
															   </a>
													  </TD>";

												"</TR>";
											}


										}					
									
							
										// CREATION VARIABLE DE SESSION POUR LE PRIX TOTAL
										$_SESSION['total'] = $total;


							?>

							</tbody>

							<tfoot>
								<tr>
									<!-- BOUTONS -->
									<td colspan="7" class="set-boutons">
										<form method="post" action="php/vide-panier.php">

											<button type="submit" class="boutons-regl" name="supprimer[]"><span>Vider le panier</span></button>

											<?php /*
												if(isset($_POST['clear-panier'])){
													unset($_SESSION['panier']); 

   													 echo "Le panier est désormais vide.";
												}
											*/
												 
														
											?>

										</form>
										<div class="boutons-regl-a"><a href="index.php">Poursuivre les achats</a></div>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>

				<!--</form>-->
				<div class="clear"></div>
				<div class="bot-panier">


					<!-- PRIX TOTAL -->
					<div class="total">
						<p>Total</p>
						<p>
							<?php 
							echo number_format($total, 2). " €";
							?>

						</p>
						<div class="clear"></div>
						<button name="valid-panier" class="but-valider">Obtenir la facture</button>
					</div>
				</div>
			</div>
				<?php
				/*
					}
					else {
						echo "<h2>Votre panier est vide. </h2>";
					}
				*/
				}
				else {
					echo "<h2>Votre panier est vide. </h2>";
				}

				?>



			<?php

			}
			else {
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
		


</body>
</html>