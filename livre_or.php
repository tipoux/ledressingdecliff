<?php
	session_start();
	
include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
	$lien = mysqli_connect($host,$user,$password,$bdd);
	
	if (!empty($_POST))
	{
		foreach($_POST as $key => $valeur)
		{
			$$key = $valeur;
		}
		
		if($pseudo == "" or $avis == "")
		{
			$erreur = '<font color = "red">Tous les champs sont obligatoires.</font>';
		}
		
		elseif (strlen($pseudo) > 30)
		{
			$erreur = '<font color = "red">Votre pseudo est trop long (30 caractères maximum).</font>';	
		}
		
		elseif (strlen($avis) > 300)
		{
			$erreur = '<font color = "red">Votre message est trop long (200 caractères maximum).</font>';
		}
		
		else
		{
			$sqlinsert = 'INSERT INTO avis VALUES ("", "'.$pseudo.'", "'.$avis.'", "'.date("Y-m-d H:i:s").'", "0") ';
			$sqlverifinsert = 'SELECT avis_message, avis_date, avis_pseudo FROM avis WHERE avis_message = "'.$avis.'" and avis_pseudo = "'.$pseudo.'" ' ;
			$queryverifinsert = mysqli_query($lien, $sqlverifinsert) or die ('ERREUR SQL ! '.$sqlverifinsert);
			
			if(mysqli_num_rows($queryverifinsert))
			{
				$erreur = '<font color="red">Message déjà enregistré.</font>' ;
			}
			else
			{
				mysqli_query($lien, $sqlinsert) or die ('ERREUR SQL ! '.$sqlinsert);
				$ok = 'Votre message a bien été enregistré et sera validé dans les plus bref délais.';
			}
		}
	}
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Livre d'or</title>
	<meta name="description" content="Livre d'or le dressing de Cliff">
	<meta name="keywords" content="livre or, livre d'or dressing de cliff, dressing de cliff">
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
			
			<h3>Livre d'or</h3>
			
			<br><br><br>
			
			<form action = 'livre_or.php' method = 'post' name = 'livre_or'>
			
			<?php
				if(isset($erreur) or isset($ok))
				{
					print ('<div align="center">'.$erreur.'</div>');
					print ('<div align="center">'.$ok.'</div><br>');
				}
			?>
			
			<table>
				<tr>
					<td>Votre pseudo : </td>
					<td><input type = 'text' name = 'pseudo' value = <?php print ($_POST["pseudo"]); ?>></td>
				</tr>
				<tr>
					<td>Votre message :</td>
					<td><textarea maxlength="300" name = 'avis' rows= '5' cols= '20'><?php print ($_POST["avis"]); ?></textarea></td>
				</tr>
				<tr>
					<td><input type = 'submit' value = 'Envoyer'></td>
				</tr>
			</table>	
			
			</form>
			
			<br><br>
			
			<?php
				$messagesParPage=10;
				
				$sql_total='SELECT COUNT(*) AS total FROM avis';
				$retour_total=mysqli_query($lien, $sql_total);
				$donnees_total=mysqli_fetch_assoc($retour_total);
				$total=$donnees_total['total'];
				
				$nombreDePages=ceil($total/$messagesParPage);
				
				if(isset($_GET['page']))
				{
     				$pageActuelle=intval($_GET['page']);
     
    		 		if($pageActuelle>$nombreDePages)
    	 			{
          				$pageActuelle=$nombreDePages;
     				}
				}
				else
				{
     				$pageActuelle= 1;   
				}
				
				$premiereEntree=($pageActuelle-1)*$messagesParPage;
			
				$sqlaffiche = 'SELECT * FROM avis WHERE avis_moderation = "1" ORDER BY id_avis DESC LIMIT '.$premiereEntree.', '.$messagesParPage.' ' ;
				$queryaffiche = mysqli_query ($lien, $sqlaffiche) or die ('EREUR SQL ! '.$sqlaffiche);
				if(!mysqli_num_rows($queryaffiche))
				{
					print('<div align="center">Pas d\'avis.</div>');
				}
				else
				{
					while($resultaffiche = mysqli_fetch_assoc($queryaffiche))
					{
						print ('<div align="center">'.$resultaffiche["avis_pseudo"]	.' le '.date("d-m-Y H:i:s",strtotime($resultaffiche["avis_date"])).'<br><br>'.$resultaffiche["avis_message"].'</div><br><br>');
					}
				}
				
				print('<p align="center">Page : ');
				for($i=1; $i<=$nombreDePages; $i++)
				{ 
     				if($i==$pageActuelle)
     				{
         				print(' [ '.$i.' ] '); 
     				}	
     				else 
     				{
          				print(' <a href="livre_or.php?page='.$i.'">'.$i.'</a> ');
     				}
				}
				print('</p>');
			?>
			
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