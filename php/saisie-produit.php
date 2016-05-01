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
			
				$prix = $_POST['prix'];
				$plateforme = $_POST['plateforme'];

				//recupération des données
				if(isset($_POST['jeu']) && isset($_POST['quantite'])) {
					$id = $_POST['jeu'];
					$qte = $_POST['quantite'];
					


					//si le panier est vide====================================>
					if (empty($_SESSION['panier'])){				
						//On construit notre panier (tableau indicé) avec l'id de l'article choisi et la quantité correspondante
						$_SESSION['panier'][$id]=$qte;
						

								//requete sur la table avec un seul id
						 $requete = mysql_query("SELECT * FROM jeu WHERE IdJeu = '$id'");
					}
					//si panier déjà rempli===================================>
					else
						{

						  //On ajoute un nouvel id et une nouvelle quantité 
						  $_SESSION['panier'][$id] = $qte;

						  // on "extrait" les id du panier 
						  // $id_liste=implode(',',array_keys($_SESSION['panier'])); 
						  //$id_liste = mysql_fetch_assoc($_SESSION['panier'][$id]);
						  //requete sur la table avec tous les id présents dans $id_liste 
						  $requete = mysql_query("SELECT * FROM jeu WHERE IdJeu = '$id'");
					}


				}

				

				var_dump($_POST['prix']);

				// SUPPRESSION PRODUIT
				if (isset($_SESSION['del'])) {
					unset($_SESSION['panier'][$idProduit]);
				}


		?>

		<pre> 
		<?php
		/* Affichons maintenant le contenu du panier : */  
		var_dump($_SESSION['panier']); 

		?> 
		</pre>



			
		<!-- LISTE DES PRODUITS -->

			<h2 class="titre-body">Mon panier</h2>

			<div class="produits">
				<!--<form method="post" action="tab-prod.php">-->
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

							
							// AFFICHAGE DU PANIER AVEC UNE BOUCLE
								$prixTotal = 0;

								foreach ($_SESSION['panier'] as $idProduit => $quantiteProduit) {
									//PLATEFORMES PAR JEU
									//$requeteListePlatformeProd = mysql_query("SELECT NomPlateformeProd FROM plateformeprod, jeu WHERE plateformeprod.IdPlateformeProd = jeu.IdPlateformeProd AND NomJeu = $idProduit ");
									//$ligneRequetePf = mysql_fetch_array($requeteListePlatformeProd);

									if($quantiteProduit != null){
										echo "<TR>";

											//Nom
											echo "<TD style=\"font-weight:bold\">".$idProduit."</TD>";
											//PlateForme
											echo "<TD>". $plateforme."</TD>";
											//Prix Unitaire
											echo "<TD>". number_format($prix, 2).' €'."</TD>";
											//Quantité
											echo "<TD>". $quantiteProduit ."</TD>";
											//Prix total
											echo "<TD>". number_format($prix*$quantiteProduit, 2).' €'."</TD>";
											//Supprimer
											echo "<TD class=\"cross\">
															<a href=\"saisie-produit.php?del=<?php echo $idProduit ?>\">
																<div class=\"img-cross\"></div>
														   </a>
												  </TD>";

										"</TR>";

										// PRIX TOTAL
										$prixTotal = $prix*$quantiteProduit + $prixTotal;
									}
								}

								$_SESSION['total'] = $prixTotal;








								?>
							</tbody>
							<!--
							<div class="cross">
											<div class="img-cross"></div>
										</div>-->
							<tfoot>
								<tr>
									<!-- BOUTONS -->
									<td colspan="7" class="set-boutons">
										<form method="post" action="php/vide-panier.php">

											<button type="submit" class="boutons-regl" name="clear-panier"><span>Vider le panier</span></button>

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
											<!-- BOUTONS 
						<div class="set-boutons">
							<button class="boutons-regl">Poursuivre les achats</button>
							<button class="boutons-regl" name="clear-panier"><span>Vider le panier</span></button>
						</div>-->
					</div>

				<!--</form>-->
				<div class="clear"></div>
				<div class="bot-panier">


					<!-- PRIX TOTAL -->
					<div class="total">
						<p>Total</p>
						<p>
							<?php 
							echo number_format($prixTotal, 2). " €";
							?>

						</p>
						<div class="clear"></div>
						<button name="valid-panier" class="but-valider">Obtenir la facture</button>
					</div>
				</div>
			</div>




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