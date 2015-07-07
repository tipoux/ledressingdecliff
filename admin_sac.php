<?php
	session_start();
	
	if($_SESSION['mod'] != "1")
	{
		header('Location: connexion.php');
	}
	
include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
	$dossier = 'image/vetements/sac/';
	$fichier = basename($_FILES['imagesac']['name']);
	$extensions = array('.png', '.jpeg');
	$extension = strrchr($_FILES['imagesac']['name'], '.');
	
	$nomsac = "";
	$referencesac = "";
	$prixsac = "";
	$disposac = "";
	$imagesac = "";
	
	if (!empty($_POST))
	{
		foreach($_POST as $key => $valeur)
		{
			$$key = $valeur;
		}
		
		if(isset($_POST["ajouter"]))
		{
			if(($nomsac=="") or ($referencesac=="") or ($prixsac=="") or ($disposac==""))
			{
				$erreur = "<font color='red'>Tous les champs sont obligatoires.</font>";
			}
			
			elseif(!in_array($extension, $extensions))
			{
     			$erreur = '<font color="red">Vous devez télécharger un fichier de type png ou jpeg.</font>';
			}
			
			else
			{	
				$sqlExistAjout = 'SELECT sac_nom, sac_reference, sac_prix, sac_dispo, sac_image FROM sac WHERE sac_nom = "'.$nomsac.'" and sac_reference = "'.$referencesac.'" and sac_prix = "'.$prixsac.'" and sac_dispo = "'.$disposac.'" and sac_image = "'.$imagesac.'" ' ;
				$sqlQueryExistAjout = mysqli_query($lien, $sqlExistAjout) or die ("SQL erreur ! ".$sqlExistAjout);
				if(mysqli_num_rows($sqlQueryExistAjout) > 0)
				{
					$erreur = "<font color='red'>Vêtement déjà enregistré</font>" ;
				}
				else
				{
					move_uploaded_file($_FILES['imagesac']['tmp_name'], $dossier . $fichier);
				
					$sqlAjout = "INSERT INTO sac VALUES ('', '".$nomsac."', '".$referencesac."', '".$prixsac."', '".$disposac."', '".$_FILES["imagesac"]["name"]."')";
					mysqli_query($lien, $sqlAjout) or die ("SQL Erreur ! ".$sqlAjout);
				
					$ok = "T'es un winner !" ;
				}
			}
		}
		
		if(isset($_POST["supprimer"]))
		{
			$machins = $_POST['id'];
			foreach ($machins as $machin) 
			{
				$sqlpasok = 'DELETE sac FROM sac WHERE id_sac = "'.$machin.'" ';
				mysqli_query ($lien, $sqlpasok) or die('SQL ERREUR ! '.$sqlpasok);
			}
		}	
	}
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Administration Sacs</title>
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
			
			<h2>Administration Sacs</h2>
			
			<br><br><br>
			
			<div id="menuAdmin">
				<ul>
					<li><a href="admin_livre.php">Livre d'or</a></li>
					<li><a href="admin_homme.php">Vêtement homme</a></li>
					<li><a href="admin_femme.php">Vêtement femme</a></li>
					<li><a href="admin_chaussure.php">Chaussures</a></li>
					<li><a href="admin_sac.php">Sacs</a></li>
				</ul>
			</div>
			
			<br>
			
			<div id="ajout">
			<h4>Ajouter un Sac</h4>
			<?php
				if(isset($erreur))
				{
					print($erreur);
				}
				
				if(isset($ok))
				{
					print($ok);
				}
			?>
			<form method="post" action="admin_sac.php" name="ajout_sac" enctype="multipart/form-data">
		
			<table class="ajout">
				<tr>
					<td>Nom :</td>
					<td><input type="text" name="nomsac" value="<?php echo $nomsac; ?>"></td>
				</tr>
				
				<tr>
					<td>Référence :</td>
					<td><input type="text" name="referencesac" value="<?php echo $referencesac; ?>"></td>
				</tr>
				
				<tr>
					<td>Prix :</td>
					<td><input type="text" name="prixsac" value="<?php echo $prixsac; ?>"></td>
				</tr>
				
				<tr>
					<td>Disponibilité</td>
					<td><input type="radio" name="disposac" value="Disponible" id="disponible" />Disponible<br>
					<input type="radio" name="disposac" value="Indisponible" id="indisponible" />Indisponible</td>
				</tr>
				
				<tr>
					<td>Image :</td>
					<td><input type="file" name="imagesac"></td>
				</tr>
				
				<tr>
					<td><input type="submit" value="Ajouter" name="ajouter"></td>
				</tr>
			</table>
			</div>
			
			<div id="supp">
				<h4>Supprimer un Sac</h4>
				
				<?php
				$sqlaffiche = 'SELECT * FROM sac';
				$queryaffiche = mysqli_query($lien, $sqlaffiche) or die ('ERREUR SQL ! '.$sqlaffiche);
				if(!mysqli_num_rows($queryaffiche))
				{
					print('<div align="center">Pas d\'article.</div>');
				}
				else
				{
					while($resultaffiche = mysqli_fetch_assoc($queryaffiche))
					{
						$id = $resultaffiche["id_sac"];
						print('<input type="checkbox" name="id[]" value='.$id.'> '.$resultaffiche["sac_nom"].' '.$result["sac_reference"].'<br>');
					}
					print('<input type="submit" value="Supprimer" name="supprimer">');
				}
			?>
			</div>
			
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
						
			<footer>

			<?php include("bloc/pied.php") ?>
			
			</footer>
			
			</section></td>
		</tr>
		</table>
	</body>
	
</html>