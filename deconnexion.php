<?php
	session_start();
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
			
			
			<br><br><br><br><br><br><br><br>

			<?php

				echo '<h1 align="center">Déconnexion effectuée !</h1>';
				echo '<p><center> Vous avez bien été déconnecté.';
				echo '<br>Vous allez être redirigé vers la page d\'accueil de notre site.';
				echo '<br><a href="index.php" title="Page d\'accueil">Cliquez ici si la redirection n\'a pas fonctionné.</a>';
				echo '</p>';

				unset($_SESSION["pseudo"]);
				unset($_SESSION["mod"]);


				?>
				
				
				<script type="text/javascript">
				<!--

				setTimeout('document.location.href = "index.php"', 2000);
				//-->

				</script>

			
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			
			
			<footer>

			
			<?php include("bloc/pied.php") ?>
			
			</footer>
			
			
			</section></td>
		</tr>
		</table>
	</body>
	
</html>