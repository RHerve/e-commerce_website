<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>e-Gaming</title>
    <link rel="stylesheet" type="text/css" href="../css/style-action-co.css">
    <meta charset="UTF-8">
</head>
<body>

<?php

	$_SESSION=array();
	unset($_SESSION);
	session_destroy();

	$testBool =  "Vous êtes déconnecté !";

?>

    <?php include("../includes/entete_2.php");?>

    <?php include("../includes/menu_2.php");?>

    <div class="conteneur">
        <div class="title-info"><?php echo $testBool; ?></div>
    </div>
    <!-- FIN PARTIE HAUTE -->


    <!-- FIN DU CORPS -->

</body>
</html>