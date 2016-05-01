<?php
if (empty($_SESSION['panier']))
  {

  //On construit notre panier avec l'id de l'article choisi et la quantité 
  $_SESSION['panier'][$id]=$qte;

  //requete sur la table avec un seul id
  $requete = mysql_query("SELECT * FROM table WHERE id = '$id'");
  }

//Il faudra ensuite mettre en forme (tableau html) le résultat de cette requête

//si panier déjà rempli===================================>
else
  {
    //suppression d'un article (on a cliqué sur un bouton supprimer) 
        if(isset($_POST['supprimer']))
        { 
        unset($_SESSION['panier'][$id]);

        //requete si le panier n'est toujours pas vide malgré la suppression
                  if(!empty($_SESSION['panier']))
                    {
                    // on "extrait" les id du panier 
                    $id_liste=implode(',',array_keys($_SESSION['panier'])); 
                    $requete = mysql_query("SELECT * FROM table WHERE id IN ($id_liste)");
                    }

        }

        else
        {
        //Ajout d'un nouvel id et une nouvelle quantité ou modification de la quantité d'un article 
        $_SESSION['panier'][$id] = $qte;

        // on "extrait" les id du panier 
        $id_liste=implode(',',array_keys($_SESSION['panier'])); 

        //requete sur la table avec tous les id présents dans $id_liste 
        $requete = mysql_query("SELECT * FROM table WHERE id IN ($id_liste)");
        }
  }




  // TEST POUR CUMULER LA QUANTITE 

 if()


  ?>




