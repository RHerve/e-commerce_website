<!DOCTYPE html>
<html>
<head>
    <title>e-Gaming</title>
    <link rel="stylesheet" type="text/css" href="../css/style-action-co.css">
    <meta charset="UTF-8">
</head>
<body>


<?php

header('Content-Type: text/html; charset=utf-8');



$connexionServeur = mysql_connect("127.0.0.1","root","");


// TEST SI ON EST CONNECTE A LA BDD
if (!$connexionServeur) {
	/*echo "Erreur lors de la connexion au serveur!";*/
}

else {
	/*echo "Connecté a la BDD!";*/

    $connexionBDD = mysql_select_db("marchand");
        if (!$connexionBDD) {
            /*echo "</br>"."Erreur lors de la Selection de la base de données";*/
        }
        else {

           /* echo "</br>"."BDD selectionnée avec succès";*/
            // TEST SI ON VALIDE
            if(isset($_POST['valider'])){
                $pseudoCo = $_POST['pseudo-user'];
                $pwCo = $_POST['pw-user'];

               /* echo "</br>"."Champs saisis correctement";*/


                // Vérifie si le compte existe
                $sqlLogin = "SELECT PseudoUser FROM user WHERE PseudoUser = '".$_POST['pseudo-user']."' ";
                $req = mysql_query($sqlLogin);


                // Vérifie si c'est l'administrateur
                $sqlAdmin = "SELECT TypeUser FROM user WHERE PseudoUser = '".$_POST['pseudo-user']."' ";
                $reqAdmin = mysql_query($sqlAdmin);
                $typeAdmin = mysql_fetch_assoc($reqAdmin);


                if($sqlLogin){
         
                     // On sélectionne toute les données de l'utilisateur dans la base de données.   
                    $sqlLogin = "SELECT * FROM user WHERE PseudoUser = '".$_POST["pseudo-user"]."' ";
                    $req = mysql_query($sqlLogin);

                    if($sqlLogin){
                        // On récupère toute les données de l'utilisateur dans la base de données.
                         $donnees = mysql_fetch_assoc($req);

                          // Si le mot de passe entré à la même valeur que celui de la base de données, on l'autorise a se connecter...         

                          if($pwCo == $donnees["MdpUser"]){

                                $bool = "Connexion validée !";
                                session_start();

                                $_SESSION["PseudoUser"] = $_POST['pseudo-user'];
                                $_SESSION["MdpUser"] = $_POST["pw-user"];

                                if($typeAdmin["TypeUser"] == ("Administrateur")){

                                    $bool = "Connecté en tant qu'administrateur !";
                                    $_SESSION["TypeUser"] = $_POST['pseudo-user'];

                                }

                                /* Si le panier n'a pas été créé*/

                                /* PARTIE HAUTE */
                              ?>
                             
                                <?php

                          }
                          else {
                                $bool = "Pseudo ou mot de passe incorrect";
                          }
                    }
                }

            }

        }






}


?>



        <!-- ENTETE ET MENU -->


     <?php include("../includes/entete_2.php");?>

    <?php include("../includes/menu_2.php");?>


    <div class="conteneur">
        <div class="title-info"><?php echo $bool; ?></div>
    </div>
    <!-- FIN PARTIE HAUTE -->


    <!-- FIN DU CORPS -->

</body>
</html>