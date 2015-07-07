<table>
<tr>
<td valign="top"><nav>
	<h1><a href="http://dressingdecliff.com/shop/catalog/browse?sessid=HTOuA6Fg8wE48Lldn9pgb4Vxgs08SFnvPQ0fBK91lFgszGikfYBY3nyEdQse62Tf&shop_param=">E-DRESSING</a></h1>
	<ol>
		<li><a href="femme.php">Vêtements Femme</a></li>
		<li><a href="homme.php">Vêtements Homme</></li>
		<li><a href="chaussure.php">Chaussures</a></li>
		<li><a href="sac.php">Sacs</a></li>
		<br>
		<li><a href="vendre.php">VENDRE</a></li>
		<br>
		<li><a href="index.php">Accueil</a></li>
		<li><a href="contact.php">Contact</a></li>
		<li><a href="cliff.php">Cliff</a></li>
		<li><a href="livre_or.php">Livre d'or</a></li>
		<br>
		<li><a href="https://ssl.1and1.fr/dressingdecliff.com/shop/service/subscribe?sessid=HTOuA6Fg8wE48Lldn9pgb4Vxgs08SFnvPQ0fBK91lFgszGikfYBY3nyEdQse62Tf&shop_param=">S'inscrire</a></li>
		<br>
		<li><a href="admin.php">Administration</a></li>
		<?php
			if(isset($_SESSION["pseudo"]))
			{
				print('<li><a href="deconnexion.php">Se déconnecter</a></li>');
			}
		?>
		
	</ol>
</nav></td>