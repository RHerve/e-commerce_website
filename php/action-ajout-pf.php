<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>e-Gaming</title>
	<link rel="stylesheet" type="text/css" href="../css/style-admin.css">
	<meta charset="UTF-8">
</head>
<body>

<?php
    mysql_connect("127.0.0.1","root","");
    mysql_select_db("marchand");

?>

	<!-- PARTIE HAUTE -->

    <?php include("../includes/entete_2.php");?>

    <?php include("../includes/menu_2.php");?>


			<!-- CORPS DE LA PAGE -->

		<div class="clear"></div>
		<div class="conteneur">

		<?php

			if(isset($_SESSION["PseudoUser"]) && isset($_SESSION["TypeUser"])){ 

			?>

				

			<h3 class="titre-body">Espace administration</h3>

			<div class="tabs">
				<div class="tab-button" id="active"><a href="admin_produit.php">Gestion des produits</a></div>
				<div class="tab-button"><a href="#">Gestion des membres</a></div>
			</div>

			<div class="clear"></div>

			<div class="contenu">

				<!-- FORMULAIRE -->
				

				<?php
				if(isset($_POST['valider'])) {

					$pfJeu = $_POST['jeu-pf'];
					$prixJeu = $_POST['prix-pf'];


					$insert = mysql_query("INSERT INTO plateformeprod (NomPlateformeProd,PrixJeuProd) VALUES ('$pfJeu','$prixJeu')");
						//$sql = "INSERT INTO jeu VALUES ('','$nomJeu','$descJeu',null,null,'$qte')";
					
					if($insert) {
						echo "<h2>". "Console ajoutée avec succès !" ."</h2>";
					} else {

						echo "<h2>"."Problème avec l'insertion de la console"."</h2>";
					}
					
				} 
				else {
					echo "Vous n'avez pas ajouté de jeu";
				}


				?>
				



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