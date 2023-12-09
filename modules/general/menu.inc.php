<?php

?>

	<div id="navigation">
		<div class="container-fluid">
			<ul class='main-nav'>
				<li class='active'><a href="dashboard.php"><span>Accueil</span></a></li>

				<?php
					if ($_SESSION['email']=="azami@brahim.ma" or $_SESSION['email']=="brahim@gsm.com")
					{
				?>
						<li><a href="categories.php"><span>Catég</span></a></li>
						<!--<li><a href="vendeurs.php"><span>Vendeur</span></a></li>-->
						<li><a href="marques.php"><span>Marques</span></a></li>
						<li><a href="coleurs.php"><span>Coleurs</span></a></li>
						<li><a href="paiement.php"><span>Paiement</span></a></li>
						<li><a href="compte.php"><span>Compte</span></a></li>
						<li><a href="produits.php"><span>Produits</span></a></li>
				<?php
				}
				?>


				<?php
                    if ($_SESSION['email']=="caissier@gsm.com")
                    {
                ?>
				        <li><a href="caissier.php"><span>Caissier</span></a></li>
				<?php
                }
                    else {
                ?>
                        <li><a href="client.php"><span>Client</span></a></li>
                        <li><a href="caisse.php"><span>Caisse</span></a></li>
												<li><a href="sortiestock.php"><span>Sortie Stock</span></a></li>
                        <li><a href="logout.php"><span>Sortir</span></a></li>

                <?php
                }
                ?>

                
			</ul>


			<div class="user"><ul class="icon-nav"></ul></div>
		</div>
	</div>
