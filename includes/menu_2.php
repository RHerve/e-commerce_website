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
					    		<?php 

					    		// SI ON EST CONNECTE
					    		if((isset($_SESSION["PseudoUser"])) && (isset($_SESSION['caddie'])) && (isset($_SESSION['total']))){
					    		//if((isset($_SESSION["PseudoUser"])){
					    		?>
						    		<span>
						    			<?php 
						    				echo array_sum($_SESSION['caddie'])."&nbsp;&nbsp;(".(number_format($_SESSION['total'], 2))." €)"; 
						    			?>
						    		</span>

						    	<?php }
						    	// OU ALORS AFFICHE 0€
						    	else { ?>
						    		<span>0&nbsp;&nbsp;(0,00 €)</span>
						    	<?php }?>

					    	</a>
					    </div>
			</div>
		
</div>