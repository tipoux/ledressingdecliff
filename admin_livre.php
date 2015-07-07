<?php

	session_start();
	
	if($_SESSION['mod'] != "1")
	{
		header('Location: connexion.php');
	}
	
include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
	if (!empty($_POST))
	{
		
		if(isset($_POST["ok"]))
		{
			$machins = $_POST['id'];
			foreach ($machins as $machin) 
			{
				$sqlok = 'UPDATE avis SET avis_moderation =  "1" WHERE id_avis = "'.$machin.'" ';
				mysqli_query ($lien, $sqlok) or die ('ERREUR SQL ! '.$sqlok);
			}
		}
		
		if(isset($_POST["pasok"]))
		{
			$machins = $_POST['id'];
			foreach ($machins as $machin) 
			{
				$sqlpasok = 'DELETE avis FROM avis WHERE id_avis = "'.$machin.'" ';
				mysqli_query ($lien, $sqlpasok) or die('SQL ERREUR ! '.$sqlpasok);
			}
		}
	}
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Administration Livre d'or</title>
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
			
			<h2>Administration Livre d'or</h2>
			
			<br><br><br><br>
				
			<?php
				$sqlaffiche = 'SELECT * FROM avis WHERE avis_moderation = "0" ';
				$queryaffiche = mysqli_query($lien, $sqlaffiche) or die ('ERREUR SQL ! '.$sqlaffiche);
				if(!mysqli_num_rows($queryaffiche))
				{
					print('<div align="center">Pas d\'avis posté.</div>');
				}
				else
				{
					print('<form name="avis" method="post" action="admin_livre.php">');
					while($resultaffiche = mysqli_fetch_assoc($queryaffiche))
					{
						$id = $resultaffiche["id_avis"];
						print('<input type="checkbox" name="id[]" value='.$id.'> '.$resultaffiche["avis_pseudo"].' souhaite laisser ce message : <br><br>'.$resultaffiche["avis_message"].'<br><br>');
					}
					print('<input type="submit" value="Publier" name="ok">');
					print('<input type="submit" value="Supprimer" name="pasok">');
				}
			?>
				
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
						
			<footer>

			
			<?php include("bloc/pied.php") ?>
			
			</footer>
			
			</section></td>
		</tr>
		</table>
	</body>
	
</html>