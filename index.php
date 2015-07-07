<?php
	session_start();
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Accueil</title>
	<meta name="description" content="Page d'accueil, le dressing de Cliff">
	<meta name="keywords" content="Page d'accueil, accueil dressing de cliff, dressing de cliff">
	<link rel="icon" type="image/png" href="image/logo.png" />
	<link rel="stylesheet" href="style.css" />
	<meta charset="utf-8">
	</head>
	
	<body>
		
		
		<img src="image/dressing.gif" alt="Dressing" usemap="#imagemap" border="0" name="dressing">
		<map id="imagemap" name="imagemap" onmouseover=style='border:1px;'>
		
		<area shape="rect" coords="394,0,601,143" href="presentation.php" title="Le dressing de Cliff" />
		
		<area shape="rect" coords="294,148,411,539" onmouseover="document.images['dressing'].src='image/femme.gif';" onmouseout="document.images['dressing'].src='image/dressing.gif';" href="femme.php" title="Prêt à porter femme"/>
		
		<area shape="rect" coords="592,148,709,538" onmouseover="document.images['dressing'].src='image/homme.gif';" onmouseout="document.images['dressing'].src='image/dressing.gif';" href="homme.php" title="Prêt à porter homme" />
		
		<area shape="rect" coords="416,512,587,607" onmouseover="document.images['dressing'].src='image/maroquinerie.gif';" onmouseout="document.images['dressing'].src='image/dressing.gif';" href="sac.php" title="Maroquinerie" /> 
		
		<area shape="rect" coords="282,642,721,787" onmouseover="document.images['dressing'].src='image/chaussures.gif';" onmouseout="document.images['dressing'].src='image/dressing.gif';" href="chaussure.php" title="Chaussures" /> 
		
		<area shape="rect" coords="416,865,601,916" href="presentation.php" title="Entrer" /> 
		</map>

	</body>
	
</html>