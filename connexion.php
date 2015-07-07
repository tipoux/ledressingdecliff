<?php
	
	session_start();
	
include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
	if (!empty($_POST))
	{
		foreach($_POST as $key => $valeur)
		{
			$$key = $valeur;
		}
		
		if($pseudo == "" or $pass == "")
		{
			$erreur = '<font color="red">Veuillez saisir un pseudo et un mot de passe.</font>';
		}
		
		else
		{
			$sqlConnexionAdmin = 'SELECT * FROM user WHERE user_pseudo = "'.$pseudo.'" and user_pass = "'.$pass.'" and user_moderation = "1" ';
			$queryConnexionAdmin = mysqli_query($lien, $sqlConnexionAdmin) or die ('ERREUR SQL ! '.$sqlConnexionAdmin);
			if(mysqli_num_rows($queryConnexionAdmin))
			{
				$resultConnexion = mysqli_fetch_assoc($queryConnexionAdmin) ;
				$_SESSION["mod"] = $resultConnexion["user_moderation"] ;
				$_SESSION["pseudo"] = $resultConnexion["user_pseudo"];
				header('Location: admin.php');
			}
			else
			{
				$erreur = '<font color="red">Pseudo et/ou mot de passe incorrect.</font>' ;
			}
		}
	}
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Connexion</title>
	<meta name="description" content="Connexion le dressing de Cliff">
	<meta name="keywords" content="connexion, connexion dressing de cliff, dressing de cliff">
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
			
			<h2>Le vide-dressing autrement…</h2>
			
			<br><br>
			
			<h3>Connexion</h3>
			
			<br><br><br>

			<form action="connexion.php" name="connexion" method="post">
			
			<?php
				if(isset($erreur))
				{
					print('<div align="center">'.$erreur.'</div>');	
				}
			?>
			
			<table>
				<tr>
					<td>Votre pseudo :</td>
					<td><input type="text" name="pseudo" value=<?php print($_POST["pseudo"]); ?>></td>
				</tr>
				<tr>
					<td>Votre mot de passe :</td>
					<td><input type="password" name="pass"></td>
				</tr>
			</table>
			<br>
			<div align="center"><input type="submit" value="Connexion"></div>
			
			</form>
					
			
			<br><br><br><br><br><br><br>
			
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