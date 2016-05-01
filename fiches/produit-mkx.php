<?php
session_start();
header( 'content-type: text/html; charset=utf-8' );
$connexionServeur = mysql_connect("127.0.0.1","root","");
$connexionBDD = mysql_select_db("marchand");

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

		

	<div class="header">
			<div class="conteneur">
				<div class="logo"><h1 class="letter">e-</h1></div>
				<div class="logo-typo"><h1>Gaming</h1></div>
				<div class="right-user">
					<?php
						if(empty($_SESSION["TypeUser"])){

					?>

						<div class="welcome">
							<?php 
								echo 'Bienvenue '."<span class=\"user-pseudo\">".$_SESSION["PseudoUser"]."</span>";
							?>
						</div>
						<div class="user">
							<ul>
								<a href="../php/deconnexion.php"><li>DECONNEXION</li></a>
							</ul>
						</div>

					<?php
					}else {
					?>
						<div class="user">
								<ul>
									<a href="../admin_produit.php"><li>ADMINISTRATION</li></a>
									<a href="../php/deconnexion.php"><li>DECONNEXION</li></a>
								</ul>
						</div>
					<?php
					}
					?>
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
					    	<a href="../panier-liste.php">VOIR MON PANIER 
					    		<?php if((isset($_SESSION["PseudoUser"])) && (isset($_SESSION['panier'])) && (isset($_SESSION['total']))){
					    		?>
						    		<span>
						    			<?php echo array_sum($_SESSION['panier'])."&nbsp;&nbsp;(".($_SESSION['total'])." €)"; ?>
						    		</span>
						    	<?php }else { ?>
						    		<span>0&nbsp;&nbsp;(0,00 €)</span>
						    	<?php }?>
					    	</a>
					    </div>
			</div>
	</div>
	<!-- FIN PARTIE HAUTE -->











		<div class="conteneur">

				<h2 class="titre-body">Détails du produit</h2>
				<div class="fiche-prod">
					<div class="img-prod"><img src="../img/img-big/<?php echo $_GET['jid']; ?>.jpg"></div>
					<div class="desc-prod">


						
							<?PHP
									if(isset($_GET['jid']) && isset($_GET['pfid'])){

										// Vérifie si c'est une valeur numérique
										if(!is_numeric($_GET['jid']) && !is_numeric($_GET['pfd'])){ 
											$ref = $_GET['jid'];
											$error=true; 
											$errormsg=" Security, Serious error. Contact webmaster: bid enter: ".$_GET['jid']."";
											die("<h3>"."Produit introuvable."."</h3>");
										}else{ 


											$error=false;



											// JEU
											mysql_query("SET NAMES 'utf8'");
											$requeteJeu = "SELECT * FROM jeu WHERE IdJeu = '".$_GET['jid']."' ";
											$resultsJeu = mysql_query($requeteJeu); 

											// NOM PLATFORME
											$requetePlateformeJeu = "SELECT NomPlateformeProd FROM plateformeprod WHERE IdPlateformeProd = '".$_GET['pfid']."' ";
											$resultsPfJeu = mysql_query($requetePlateformeJeu); 

											// PRIX DU JEU
											$requetePrixJeu = "SELECT PrixJeuProd FROM plateformeprod WHERE IdPlateformeprod = '".$_GET['pfid']."' ";
											$resultsPrixJeu = mysql_query($requetePrixJeu); 

											// QUANTITE
											$requeteQte = "SELECT quantiteJeu FROM jeu WHERE IdJeu = '".$_GET['jid']."' ";
											$resultsQte = mysql_query($requeteQte); 




											//TEST DES REQUETES
											if($resultsJeu && $resultsPfJeu && $resultsPrixJeu && $resultsQte){ 
												//$num = mysql_num_rows($resultsJeu); 
												$row = mysql_fetch_assoc($resultsJeu); 
												$rowPfJeu = mysql_fetch_assoc($resultsPfJeu); 
												$rowPrixJeu = mysql_fetch_assoc($resultsPrixJeu);
												$rowQte = mysql_fetch_assoc($resultsQte);

											}else {
												//there's a query error 
												$error=true; 
												$errormsg .=mysql_error(); 
												echo "Erreur";
											}

										}
									}
							?>



					<form method="post" action="">
							<h3>
								<!-- Nom du jeu -->
								<input type="hidden" name="jeu" value="<?php echo $row['NomJeu'];?>">
								<input type="hidden" name="id" value="<?php echo $row['IdJeu'];?>">
								<input type="hidden" name="action" value="add">
								<?php echo $row['NomJeu'];?>
							</h3>


							<!-- DISPONIBILITE -->
							<p>
								<span class="highlight-desc">Disponibilité:</span>

								<?php if($rowQte['quantiteJeu'] > 0){ ?>
									<span class="highlight-green">En stock</span>
								<?php } else{ ?>
									<span class="highlight-red">Stock épuisé</span>
								<?php }?>

							</p>

							<!-- GENRE
							<p><span class="highlight-desc">Genre(s):</span> Combat</p> -->

							<!-- PLATEFORME -->
							<p><span class="highlight-desc">Plateforme:</span>
								<ul class="list-tri">		
									<li><a href="#"><?php echo $rowPfJeu['NomPlateformeProd'];?></a></li>
									
									<input type="hidden" name="plateforme" value="<?php echo $rowPfJeu['NomPlateformeProd'];?>">
								</ul>
							</p>

							<!-- DESCRIPTION -->
							<p class="desc-prod-prg">
								<span class="highlight-desc">Description:</span>  
								<?php echo $row['DescriptionJeu'];?>
							</p>





							<div class="clear"></div>

							<div class="commande">

							<!-- PRIX -->
								<input type="hidden" name="prix" value="<?php echo $rowPrixJeu['PrixJeuProd'];?>">

								<div class="prix-prod"><?php echo number_format($rowPrixJeu['PrixJeuProd'], 2);?> €</div>

							
								<div class="ajout-panier">
								<a href="../panier_ajout.php?id=<?php echo $row['IdJeu'];?>" class="but-commander" name="valider">Ajouter au panier</a>
									<!--<input class="but-commander" type="submit" name="valider" value="Ajouter au panier">-->
								</div>
							</div>
					</form>	

					</div>
				</div>
			</div>
		</div>



</body>
</html>