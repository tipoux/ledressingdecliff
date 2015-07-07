<?php	
	session_start();

include ("bloc/connexion_bdd.php");

$lien = mysqli_connect($host,$user,$password,$bdd);
	
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Vêtements hommes</title>
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
			
			<h3>Vêtements homme</h3>
			
			<br><br><br><br>
			
			<?php
				$sqlAffiche = 'SELECT * FROM homme' ; 
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
						$hommeimage = $resultAffiche["homme_image"];
						$repertoir = "image/vetements/homme/";
						if ($j%$NbrCol == "1") 
						{
							$NbrLigne++;
							$fintr = "0";
							print ("<tr border=1>");
						}
						print("<td><a href=vetement.php?vetement=".$resultAffiche["id_homme"]." target = _blank><img src='".$repertoir.$hommeimage."' title='vetement'></a>".$resultAffiche["homme_nom"]."<br>T. ".$resultAffiche["homme_taille"]."<br>Référence : ".$resultAffiche["homme_reference"]."<br><span class='prix'>Prix : ".$resultAffiche["homme_prix"]."€</span>");
						if($resultAffiche["homme_dispo"]=="Disponible")
						{
							print("<br><p><font color='green'>".$resultAffiche["homme_dispo"]."</font></p></td>");
						}
						else
						{
							print("<br><p><font color='red'>".$resultAffiche["homme_dispo"]."</font></p></td>");
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