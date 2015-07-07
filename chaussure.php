<?php	
	session_start();

include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Chaussures</title>
	<meta name="description" content="Cliff le dressing de Cliff">
	<meta name="keywords" content="cliff, cliff dressing de cliff, dressing de cliff">
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
			
			<h3>Chaussures</h3>
			
			<br><br><br><br>
			
			<?php
				$sqlAffiche = 'SELECT * FROM chaussure' ; 
				$queryAffiche = mysqli_query($lien, $sqlAffiche) or die ('Erreur SQL ! '.$sqlAffiche);
				if(!mysqli_num_rows($queryAffiche))
				{
					print('<p align="center">Pas d\'article</p>');
				}
				else
				{
					$NbrCol = "2";
					$NbrLigne = "0";
					$j = "1";
					print("<table>");
					while($resultAffiche = mysqli_fetch_assoc($queryAffiche))
					{
						$chaussureimage = $resultAffiche["chaussure_image"];
						$repertoir = "image/vetements/chaussure/";
						if ($j%$NbrCol == "1") 
						{
							$NbrLigne++;
							$fintr = "0";
							print ("<tr border=1>");
						}
						print("<td><a href=vetement.php?vetement=".$resultAffiche["id_chaussure"]." target = _blank><img src='".$repertoir.$chaussureimage."' title='vetement'></a>".$resultAffiche["chaussure_nom"]."<br>T. ".$resultAffiche["chaussure_taille"]."<br>Référence : ".$resultAffiche["chaussure_reference"]."<br><span class='prix'>Prix : ".$resultAffiche["chaussure_prix"]."€</span>");
						if($resultAffiche["chaussure_dispo"]=="Disponible")
						{
							print("<br><p><font color='green'>".$resultAffiche["chaussure_dispo"]."</font></p></td>");
						}
						else
						{
							print("<br><p><font color='red'>".$resultAffiche["chaussure_dispo"]."</font></p></td>");
						}
						if ($j%$NbrCol == "0") 
						{
						$fintr = "1";
						print ("</tr>");
						}
						$j++;
					}
					if ($fintr!="1") 
					{
						print("</tr>");
					}
					print("</table>");
				}
			?>
			
			<br><br><br><br><br><br><br><br><br><br><br><br>
			
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