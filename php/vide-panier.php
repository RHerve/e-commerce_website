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
    mysql_connect("127.0.0.1","root","");
    mysql_select_db("marchand");

?>

    <?php include("../includes/entete_2.php");?>

    <?php include("../includes/menu_2.php");?>


    <div class="conteneur">

        <div class="title-info">


        <?php 

       if(isset($_SESSION['caddie'])){
             unset($_SESSION['caddie']); 
        }


        header("Location: ../panier-liste.php");

        ?>

        </div>
    </div>
    <!-- FIN PARTIE HAUTE -->


    <!-- FIN DU CORPS -->

</body>
</html>