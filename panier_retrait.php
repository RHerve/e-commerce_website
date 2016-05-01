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
						$ref = $_GET['retrait'];	 
					

						$_SESSION['caddie'][$ref]--; //remove one from the quantity of the product with id $product_id 

							if($_SESSION['caddie'][$ref] == 0) {
								unset($_SESSION['caddie'][$ref]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise is will show zero, then -1, -2 etc when the user keeps removing items. 
							}


						header("Location: panier-liste.php");
						//}
						//else {
						//	echo "Erreur d'initialisation";
						//}


					



		}


					?>

		</div>

	</div>



</body>
</html>