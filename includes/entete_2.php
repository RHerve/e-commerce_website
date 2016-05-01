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