<?php

	session_start();
	
	if($_SESSION['mod'] != "1")
	{
		header('Location: connexion.php');
	}
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Administration</title>
	<meta name="description" content="Administration le dressing de Cliff">
	<meta name="keywords" content="administration, administration dressing de cliff, dressing de cliff">
	<link rel="stylesheet" href="style.css" href='http://fonts.googleapis.com/css?family=Droid+Sans' type='text/css'/>
	<link rel="icon" type="image/png" href="image/logo.png" />
	<meta charset="utf-8">
	</head>
	
	<body class="bg">
	
		<?php include ("bloc/menu.php") ?>
		
		<a href="https://www.facebook.com/LeDressingDeCliff" target="_blank"><img class="facebook" src="image/facebook.png" alt="facebook" title="facebook"></a>
		
		<td><section>
			<div id="haut"></div>
			<a href="index.php"><img src="image/logo.png" alt="logo" title="Le dressing de Cliff" name="logo" /><a/>
			
			<br><br>
			
			<h2>Administration</h2>
			
			<br><br><br><br><br><br>

			<div id="menuAdmin">
				<ul>
					<li><a href="admin_livre.php">Livre d'or</a></li>
					<li><a href="admin_homme.php">Vêtement homme</a></li>
					<li><a href="admin_femme.php">Vêtement femme</a></li>
					<li><a href="admin_chaussure.php">Chaussures</a></li>
					<li><a href="admin_sac.php">Sacs</a></li>
				</ul>
			</div>
			
			<br><br><br><br><br><br><br><br><br><br><br>
			
			<a href="#haut"><img class="haut" src="image/haut.png" title="haut" name="haut"></a>
			
			<br><br>
						
			<footer>

			
			<?php include("bloc/pied.php") ?>
			
			</footer>
			
			</section></td>
		</tr>
		</table>
	</body>
	
</html>