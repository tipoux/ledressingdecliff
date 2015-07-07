<?php
	session_start();
	
	if($_SESSION['mod'] != "1")
	{
		header('Location: connexion.php');
	}
	
include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
	$dossier = 'image/vetements/chaussure/';
	$fichier = basename($_FILES['imagechaussure']['name']);
	$extensions = array('.png', '.jpeg');
	$extension = strrchr($_FILES['imagechaussure']['name'], '.');
	
	$nomchaussure = "";
	$taillechaussure = "";
	$referencechaussure = "";
	$prixchaussure = "";
	$dispochaussure = "";
	$imagechaussure = "";
	
	if (!empty($_POST))
	{
		foreach($_POST as $key => $valeur)
		{
			$$key = $valeur;
		}
		
		if(isset($_POST["ajouter"]))
		{
			if(($nomchaussure=="") or ($taillechaussure=="") or ($referencechaussure=="") or ($prixchaussure=="") or ($dispochaussure==""))
			{
				$erreur = "<font color='red'>Tous les champs sont obligatoires.</font>";
			}
			
			elseif(!in_array($extension, $extensions))
			{
     			$erreur = '<font color="red">Vous devez télécharger un fichier de type png ou jpeg.</font>';
			}
			
			else
			{	
				$sqlExistAjout = 'SELECT chaussure_nom, chaussure_taille, chaussure_reference, chaussure_prix, chaussure_dispo, chaussure_image FROM chaussure WHERE chaussure_nom = "'.$nomchaussure.'" and chaussure_taille = "'.$taillechaussure.'" and chaussure_reference = "'.$referencechaussure.'" and chaussure_prix = "'.$prixchaussure.'" and chaussure_dispo = "'.$dispochaussure.'" and chaussure_image = "'.$imagechaussure.'" ' ;
				$sqlQueryExistAjout = mysqli_query($lien, $sqlExistAjout) or die ("SQL erreur ! ".$sqlExistAjout);
				if(mysqli_num_rows($sqlQueryExistAjout) > 0)
				{
					$erreur = "<font color='red'>Vêtement déjà enregistré</font>" ;
				}
				else
				{
					move_uploaded_file($_FILES['imagechaussure']['tmp_name'], $dossier . $fichier);
				
					$sqlAjout = "INSERT INTO chaussure VALUES ('', '".$nomchaussure."', '".$taillechaussure."', '".$referencechaussure."', '".$prixchaussure."', '".$dispochaussure."', '".$_FILES["imagechaussure"]["name"]."')";
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
				$sqlpasok = 'DELETE chaussure FROM chaussure WHERE id_chaussure = "'.$machin.'" ';
				mysqli_query ($lien, $sqlpasok) or die('SQL ERREUR ! '.$sqlpasok);
			}
		}	
	}
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Administration Chaussures</title>
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
			
			<h2>Administration chaussures</h2>
			
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
			<h4>Ajouter une paire de chaussure</h4>
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
			<form method="post" action="admin_chaussure.php" name="ajout_chaussure" enctype="multipart/form-data">
		
			<table class="ajout">
				<tr>
					<td>Nom :</td>
					<td><input type="text" name="nomchaussure" value="<?php echo $nomchaussure; ?>"></td>
				</tr>
			
				<tr>
					<td>Taille :</td>
					<td><input type="text" name="taillechaussure" value="<?php echo $taillechaussure; ?>"></td>
				</tr>
				
				<tr>
					<td>Référence :</td>
					<td><input type="text" name="referencechaussure" value="<?php echo $referencechaussure; ?>"></td>
				</tr>
				
				<tr>
					<td>Prix :</td>
					<td><input type="text" name="prixchaussure" value="<?php echo $prixchaussure; ?>"></td>
				</tr>
				
				<tr>
					<td>Disponibilité</td>
					<td><input type="radio" name="dispochaussure" value="Disponible" id="disponible" />Disponible<br>
					<input type="radio" name="dispochaussure" value="Indisponible" id="indisponible" />Indisponible</td>
				</tr>
				
				<tr>
					<td>Image :</td>
					<td><input type="file" name="imagechaussure"></td>
				</tr>
				
				<tr>
					<td><input type="submit" value="Ajouter" name="ajouter"></td>
				</tr>
			</table>
			</div>
			
			<div id="supp">
				<h4>Supprimer une paire de chaussure</h4>
				
				<?php
				$sqlaffiche = 'SELECT * FROM chaussure';
				$queryaffiche = mysqli_query($lien, $sqlaffiche) or die ('ERREUR SQL ! '.$sqlaffiche);
				if(!mysqli_num_rows($queryaffiche))
				{
					print('<div align="center">Pas d\'article.</div>');
				}
				else
				{
					while($resultaffiche = mysqli_fetch_assoc($queryaffiche))
					{
						$id = $resultaffiche["id_chaussure"];
						print('<input type="checkbox" name="id[]" value='.$id.'> '.$resultaffiche["chaussure_nom"].' '.$result["chaussure_reference"].'<br>');
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