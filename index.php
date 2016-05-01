<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<meta charset="UTF-8">

	<!-- SLIDER -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="sss/sss.min.js"></script>
	<link rel="stylesheet" href="sss/sss.css" type="text/css" media="all">

	<script>
	jQuery(function($) {
	$('.slider').sss();
	});
	</script>



</head>
<body>
	<!-- PARTIE HAUTE -->
		<?php include("includes/entete.php");?>

		<?php include("includes/menu.php");?>

		<!-- FIN PARTIE HAUTE -->

		<!-- CORPS DE LA PAGE -->

		<div class="clear"></div>
		<div class="conteneur">

			<!-- SLIDER -->

			<?php 
			$connexionServeur = mysql_connect("127.0.0.1","root","");
			$connexionBDD = mysql_select_db("marchand");
			?>


			<!-- DIALOG BOX -->

			<div id="dialogoverlay"></div>
			<div id="dialogbox">
			  <div>
			    <div id="dialogboxbody" class="title-popup"></div>
			    <div id="dialogboxfoot"></div>
			  </div>
			</div>

			<!-- SLIDER -->

			<h2 class="titre-body">Jeux à venir</h2>

			<div class="slider">
				<div>
					<img src="img/img-slider/6.jpg" /><div class="bg_caption"><span class="caption"><h2>Deus Ex: Mankind Divided</h2></span></div>
				</div>
				<div>
					<img src="img/img-slider/7.jpg" /><div class="bg_caption"><span class="caption"><h2>Assassin's Creed Syndicate</h2></span></div>
				</div>
				<div>
					<img src="img/img-slider/8.jpg" /><div class="bg_caption"><span class="caption"><h2>The Legend of Zelda Wii U</h2></span></div>
				</div>
				<div>
					<img src="img/img-slider/9.jpg" /><div class="bg_caption"><span class="caption"><h2>Star Citizen</h2></span></div>
				</div>
			</div>

			<div class="clear"></div>


			<!-- PRODUITS RECENTS -->

			<h2 class="titre-body">Nos récents jeux</h2>


			<?php
				// SELECTION DE TOUS LES JEUX
				$requeteListeJeux = mysql_query("SELECT * FROM jeu ORDER BY IdJeu DESC");

				// TOUS LES JEUX
				$tousLesJeux = mysql_query("SELECT SUM(quantiteJeu) AS jeux_total FROM jeu");
				$resultAll = mysql_fetch_assoc($tousLesJeux);


				////// QUANTITE PAR PLATEFORME

					// XBOX
					$xboxJeu = mysql_query("SELECT SUM(quantiteJeu) AS xbox_plateforme FROM jeu WHERE IdPlateformeProd = 2");
					$xboxResult = mysql_fetch_assoc($xboxJeu);

					// PS4
					$ps4Jeu = mysql_query("SELECT SUM(quantiteJeu) AS ps4_plateforme FROM jeu WHERE IdPlateformeProd = 1");
					$ps4Result = mysql_fetch_assoc($ps4Jeu);

					// PC
					$pcJeu = mysql_query("SELECT SUM(quantiteJeu) AS pc_plateforme FROM jeu WHERE IdPlateformeProd = 3");
					$pcResult = mysql_fetch_assoc($pcJeu);

					// WII U
					$wiiJeu = mysql_query("SELECT SUM(quantiteJeu) AS wii_plateforme FROM jeu WHERE IdPlateformeProd = 4");
					$wiiResult = mysql_fetch_assoc($wiiJeu);



				// DEBUT DU TITRE DU JEU
				function recupererDebutTexte($origine, $longueurAGarder) {
				        if (strlen ($origine) <= $longueurAGarder)
				            return $origine;
				         
				        $debut = substr ($origine, 0, $longueurAGarder);
				        $debut = substr ($debut, 0, strrpos ($debut, ' ')) . '...';
				         
				        return $debut;
				}

				

				// REQUETE ID MAX
				$maxId = mysql_query("SELECT MAX(IdJeu) FROM jeu");
				$ligneMaxId = mysql_fetch_array($maxId);

				$nouveauProdCompteur = $ligneMaxId;

				$compteur = 0;


			?>

			<div class="produits">

					<!-- DEBUT DE LA LISTE -->

					<?php 
						while(($ligneRequeteJeux=mysql_fetch_assoc($requeteListeJeux)) && $compteur < 4) {

							$compteur++;
							
							//PLATEFORMES PAR JEU
							$requeteListePlatforme = mysql_query("SELECT NomPlateformeProd FROM plateformeprod, jeu WHERE plateformeprod.IdPlateformeProd = jeu.IdPlateformeProd AND NomJeu = '".$ligneRequeteJeux["NomJeu"]."' ");
							$ligneRequetePf = mysql_fetch_array($requeteListePlatforme);

							//ID PLATEFORMES PAR JEU
							$requeteIdPlateforme = mysql_query("SELECT IdPlateformeProd FROM jeu WHERE NomJeu = '".$ligneRequeteJeux["NomJeu"]."' ");
							$ligneRequetePfId = mysql_fetch_array($requeteIdPlateforme);

							//PRIX PAR JEU
							$requeteListePrix = mysql_query("SELECT PrixJeuProd FROM plateformeprod, jeu WHERE plateformeprod.IdPlateformeProd = jeu.IdPlateformeProd AND NomJeu = '".$ligneRequeteJeux["NomJeu"]."' ");
							$ligneRequetePrix = mysql_fetch_array($requeteListePrix);




					?>

					<div class="produit-gauche">




							<div class="pict">
								<a href="fiches/produit-mkx.php?jid=<?PHP ECHO $ligneRequeteJeux['IdJeu']; ?>&pfid=<?PHP ECHO $ligneRequetePfId['IdPlateformeProd']; ?>">
									<span class="pict_console"><?php echo $ligneRequetePf['NomPlateformeProd'];?></span>
									<img src="img/img/<?php echo $ligneRequeteJeux['IdJeu']; ?>.jpg">
								</a>
							</div>

							<div class="desc">
								<div class="desc-titre">
									<div class="produit-titre">
										<a href="fiches/produit-mkx.php?jid=<?PHP ECHO $ligneRequeteJeux['IdJeu']; ?>&pfid=<?PHP ECHO $ligneRequetePfId['IdPlateformeProd']; ?>">
											<!-- Affichage nom du jeu -->
											<?php 
												echo recupererDebutTexte($ligneRequeteJeux["NomJeu"], 30);
											?>
										</a>
									</div>
									

									<!-- Affichage prix du jeu -->
									<div class="produit-prix">
										<?php 

											//$sql = "SELECT PrixJeu FROM Plateforme WHERE PrixJeu = 50"; 
											
											echo $ligneRequetePrix["PrixJeuProd"]." €";
										?>
									</div>
								</div>


									<!-- POPUP CLIC AJOUT PANIER -->
									<!--

									<?php 
									if(isset($_SESSION["PseudoUser"])){
									?>

										<div id="textPopup" onclick="Alert.ajoutProd('Produit ajouté dans le panier.')" class="panier-produit">
												<div class="icon-panier"></div>
										</div>
									<?php 
									}else {
									?>
										<div id="textPopup" onclick="Alert.ajoutProd('Vous devez être connecté pour ajouter un produit.')" class="panier-produit">
												<div class="icon-panier"></div>
										</div>
									<?php 
									}
									?>
									-->

						</div>

					</div>

					<!-- FIN LISTE PRODUITS -->

					<?php

					}

					?>

			</div>

		<!-- FIN PRODUITS RECENTS -->

		<!-- PARTIE TOUS LES PRODUITS-->

		<div class="conteneur">

			<h2 class="titre-body">Tous les jeux (<?php echo $resultAll['jeux_total'];?>)</h2>
			

			<div class="produits-all">

			<!-- RANGEE 1 -->

				<div class="tri-all">
					<p>Trier par plateforme</p>
					<ul class="list-tri">
						<li><a href="#">tous (<?php echo $resultAll['jeux_total'];?>)</a></li>
						<li><a href="#">xbox one (<?php echo $xboxResult['xbox_plateforme'];?>)</a></li>
						<li><a href="#">ps4 (<?php echo $ps4Result['ps4_plateforme'];?>)</a></li>
						<li><a href="#">pc (<?php echo $pcResult['pc_plateforme'];?>)</a></li>
						<li><a href="#">wii u (<?php echo $wiiResult['wii_plateforme'];?>)</a></li>
					</ul>

				</div>
				<div class="rangee">


					<!-- PRODUITS 1 -->
					<div class="produit-droite">
						
					</div>

					<!-- PRODUITS 2 -->
					<div class="produit-droite">
						
					</div>

					<!-- PRODUITS 3 -->
					<div class="produit-gauche-all">

							<div class="pict">
								<a href="#"><!--<img src="#">--></a>
							</div>

							<div clas="desc">
								<div class="desc-titre">
									<div class="produit-titre"><a href="#">Nom du jeu</a></div>
									<div class="produit-prix">70€</div>
								</div>
									<a href="page-produit.php">
										<div class="panier-produit">
											<div class="icon-panier"></div>
										</div>
									</a>
							</div>

					</div>

				</div>

					<div class="clear"></div>

			<!-- RANGEE 2 -->

				<!-- PRODUITS 1 -->
				<div class="rangee">
					<div class="produit-gauche">

							<div class="pict">
								<a href="#"><!--<img src="#">--></a>
							</div>

							<div clas="desc">
								<div class="desc-titre">
									<div class="produit-titre"><a href="#">Nom du jeu</a></div>
									<div class="produit-prix">70€</div>
								</div>
									<a href="page-produit.php">
										<div class="panier-produit">
											<div class="icon-panier"></div>
										</div>
									</a>
							</div>

					</div>

					<!-- PRODUITS 2 -->
					<div class="produit-gauche">
						
					</div>

					<!-- PRODUITS 3 -->
					<div class="produit-droite">
						
					</div>

					<!-- PRODUITS 4 -->
					<div class="produit-droite">
						
					</div>
				</div>

			</div>

		</div>

		</div>


<!--
	<div class="conteneur">
		<div class="clear"></div>
		
		<div>
			<h2 class="title">COMMANDEZ VOS JEUX PREFERES</h2>
			<h3 class="subtitle">SUR VOTRE SITE FRANCOPHONE</h2>
		</div>
		<a href="#"><div class="bouton">CONTINUER SUR LE SITE</div></a>



	</div>
-->
</body>

<script>
	function CustomAlert(){

	    this.ajoutProd = function(dialog){
	        var winW = window.innerWidth;
	        var winH = window.innerHeight;
	        var dialogoverlay = document.getElementById('dialogoverlay');
	        var dialogbox = document.getElementById('dialogbox');
	        dialogoverlay.style.display = "block";
	        dialogoverlay.style.height = winH+"px";
	        dialogbox.style.display = "block";
	        dialogbox.style.border = "20px";
	        document.getElementById("textPopup").style.lineHeight = "20px";
	        //dialogboxbody.style.color = "#FFB03B";

	        document.getElementById('dialogboxbody').innerHTML = dialog;
	        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
	    }
		this.ok = function(){
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";
		}
	}

	var Alert = new CustomAlert();
</script>


</html>