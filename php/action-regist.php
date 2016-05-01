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

session_start();

$connexionServeur = mysql_connect("127.0.0.1","root","");


// TEST SI ON EST CONNECTE A LA BDD
if (!$connexionServeur) {
	echo "Erreur lors de la connexion au serveur!";
}

else {
	/*echo "Connecté a la BDD!";*/

    $connexionBDD = mysql_select_db("marchand");
        if (!$connexionBDD) {
        /*    $display = "</br>"."Erreur lors de la Selection de la base de données";*/
        }
        else {

            /*$display = "</br>"."BDD selectionnée avec succès";*/
            // TEST SI ON VALIDE
            if(isset($_POST['valider'])){

            	

                /*$display = "</br>"."Champs saisis correctement";*/

                // TEST SI TOUS LES CHAMPS SONT REMPLIS
                if((!empty($_POST['prenom'])) && (!empty($_POST['pseudo'])) && (!empty($_POST['email'])) && (!empty($_POST['confirm-email'])) && (!empty($_POST['pw'])) && (!empty($_POST['confirm-pw']))) {

                    $prenom = $_POST['prenom'];
                    $pseudo = $_POST['pseudo'];
                    $email = $_POST['email'];
                    $confirmemail = $_POST['confirm-email'];
                    $pw = $_POST['pw'];
                    $confirmpw = $_POST['confirm-pw'];
                // TEST SI LA CONFIRMATION DU MOT DE PASSE ET DU MAIL SONT CORRECTES
                if($email == $confirmemail AND $pw == $confirmpw) {
                	/*$display = "</br>"."Email et mot de passe valides";*/

                	// TEST SI LE NOM DE COMPTE EST != DU MDP
                	if($_POST["pseudo"] != $_POST["pw"]){

                		// ON VERIFIE SI LE PSEUDO EST DEJA PRIS 
                		$sql = "SELECT PseudoUser FROM User WHERE PseudoUser = '".$_POST["pseudo"]."' ";
                		$sqlPseudo = mysql_query($sql);
                		$sqlVerif = mysql_num_rows($sqlPseudo);

                        // PUIS ON VERIFIE SI L'EMAIL EST DEJA PRIS 
                        $sqlEmail = "SELECT EmailUser FROM User WHERE EmailUser = '".$_POST["email"]."' ";
                        $sqlEmailVerif = mysql_query($sqlEmail);
                        $sqlEmailVerifFinal = mysql_num_rows($sqlEmailVerif);

            
                		//TEST s'il n'y a pas de nom de compte avec la valeur tapé par l'utilisateur
                		if($sqlVerif == 0 AND $sqlEmailVerifFinal == 0){
                			/*$display = "</br>"."Pseudo libre";*/
                			//SI OUI ON L'INSCRIT DANS LA BDD
                			 $sqlInsert = "INSERT INTO User(PrenomUser, PseudoUser, EmailUser, MdpUser) VALUES ('$prenom','$pseudo','$email','$pw')";
                             $sqlUser = mysql_query($sqlInsert);

                             //SI LA REQUETE EST OK
                             if($sqlUser){
                             	$display = "</br>"."Inscription réussie ! Vous êtes maintenant membre du site.";

                                //Test variables de session
                                $_SESSION["prenom"] = $prenom;
                                $_SESSION["PseudoUser"] = $pseudo;
                                $_SESSION["email"] = $email;
                                $_SESSION["pw"] = $pw;

                               // echo $_SESSION["prenom"]; */
                             }
                             else {
                             	$display = "</br>"."Erreur lors de l'inscription";
                             }
                		}

                        elseif ($sqlEmailVerifFinal > 0 AND $sqlVerif > 0) {
                            $display = "</br>"."Email et pseudo déjà pris";
                        }
                		elseif ($sqlVerif > 0) {
                			$display = "</br>"."Pseudo déjà pris";
                		}
                        elseif ($sqlEmailVerifFinal > 0) {
                            $display = "</br>"."Email déjà pris";
                        }
                        // FIN DES TESTS DE PSEUDO ET EMAIL PRIS

            
                	}
                	else {
                		$display = "</br>"."Le pseudo doit être différent du mot de passe.";
                	}

                }
                else {
                	$display = "</br>"."Email ou/et mot de passe non-valides.";
                }

              
              }else {
                $display = "</br>"."Tous les champs ne sont pas remplis.";
              }



            }




    }



}

?>

 <?php
            if(isset($_SESSION["EmailUser"])){
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
                                                        <a href="deconnexion.php"><li>DECONNEXION</li></a>
                                                    </ul>
                                                </div>

                                            <?php
                                            }else {
                                            ?>
                                                <div class="user">
                                                        <ul>
                                                            <a href="../admin_produit.php"><li>ADMINISTRATION</li></a>
                                                            <a href="deconnexion.php"><li>DECONNEXION</li></a>
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
                                                    <a href="inscription.php"><li>INSCRIPTION</li></a>
                                                    <a href="connexion.php"><li>CONNEXION</li></a>
                                                </ul>
                                            </div>

                                        </div>
                                </div>
                                <div class="clear"></div>
                                <?PHP
                                }
                                ?>


    <div class="line">
            <div class="conteneur">
                        <ul class="top-menu">
                            <a href="../index.php"><li>ACCUEIL</li></a>
                           <!-- <a href="#"><li>PRODUITS</li></a>-->
                            <a href="#"><li>A PROPOS</li></a>
                            <a href="#"><li>CONTACT</li></a>
                        </ul>

                        <div class="panier">
                            <a href="saisie-produit.php">VOIR MON PANIER 
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

    <div class="conteneur">
        <div class="title-info"><?php echo $display; ?></div>
    </div>
    <!-- FIN PARTIE HAUTE -->


    <!-- FIN DU CORPS -->

</body>
</html>