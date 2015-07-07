<?php
	session_start();
	
	$nom = "";
	$emailutilisateur = "";
	$objet = "";
	$comments = "";
	
	define('MAIL_DESTINATAIRE','contact@ledressingdecliff.com');
	define('MAIL_SUJET','Message du formulaire Dressing de Cliff');
	
	//Entête du mail:
	$mail_entete  = "MIME-Version: 1.0"."\r\n";
	$mail_entete .= "From: {$_POST['nom']} "."<{$_POST['emailutilisateur']}>"."\r\n";
	$mail_entete .= 'Reply-To: '.$_POST['emailutilisateur']."\r\n";
	$mail_entete .= 'Content-Type: text/plain; charset="iso-8859-1"';
	$mail_entete .= "\r\nContent-Transfer-Encoding: 8bit"."\r\n";
	$mail_entete .= 'X-Mailer:PHP/' . phpversion()."\r\n";
 
	// Corps du mail
	$mail_corps  = "Message de : ".$_POST['nom']."\n";
	$mail_corps .= "Sujet : ".$_POST['objet']."\n";
	$mail_corps .= "Message :"."\n\n".$_POST['comments'];

	
	if (!empty($_POST))
	{
		foreach($_POST as $key => $valeur)
		{
			$$key = $valeur;
		}
	
		// Contrôle d'intégrité
	
		if ($nom == "" or $emailutilisateur == "" or $objet == "" or $comments == "")
		{
			$erreur = "<div align='center'><font color='red'>Tous les champs sont obligatoires.</font></div>";
		}
		
		elseif (!filter_var($emailutilisateur,FILTER_VALIDATE_EMAIL))
		{
			$erreur_email = "<div align='center'><font color='red'>L'adresse E-mail n'est pas valide.</font></div>";			
		}
		
		elseif(mail(MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$mail_entete))
		{
			$message_ok = "<div align='center'>Votre demande a bien été prise en compte.<br/><br/><a href='index.php'>Retour</a></div>";
			$succes = 1;
		}
		
		else
		{
			$message_pasok = "<div align='center'><font color='red'>Votre e-mail n'a pas pus être envoyé, veuillez réessayer plus tard.</font></div><br/><br/>";
		}
	}
	
	
?>

<!DOCTYPE html>

<html>
	
	<head>
	<title>Contact</title>
	<meta name="contact" content="Page de contact du dressing de Cliff">
	<meta name="keywords" content="contact, contact dressing de cliff, dressing de cliff">
	<link rel="stylesheet" href="style.css" href='http://fonts.googleapis.com/css?family=Droid+Sans' type='text/css'/>
	<link rel="icon" type="image/png" href="image/logo.png" />
	<meta charset="utf-8">
	</head>
	
	<body class="bg">
	
	<?php include ("bloc/menu.php") ?>
	
	<a href="https://www.facebook.com/LeDressingDeCliff" target="_blank"><img class="facebook" src="image/facebook.png" alt="facebook" title="facebook"></a>
	
		
		<td><section>
			<div id="haut"></div>
			
			<a href="index.php"><img src="image/logo.png" alt="logo" title="Le dressing de Cliff" name="logo" /></a>			<h2>Le vide-dressing autrement…</h2>
			
			<fieldset>
				<legend>Contact</legend>
				
				<p>Pour toute question, veuillez nous contacter :</p>
				<ul>
					<li>au <b>06.40.44.01.04</b></li>
					<li>par e-mail : contact@ledressingdecliff.com</li>
				</ul>
					
					
					<?php
						echo $erreur_email;
						echo $erreur;
						echo $message_ok;
						echo $message_pasok;
						if (!isset($succes))
						{

					?>
					
					<form name="envoyer" method="post" action="contact.php">
					<input type="hidden" name="subject" value="email">
					
					<label for="nom">Votre nom :</label>
					<br />
					<input type="text" name="nom" id="nom" value="<?php echo $nom; ?>">
					<br /><br />
					<label for="emailutilisateur">Votre Email :</label>
					<br />
					<input type="email" name="emailutilisateur" id="emailutilisateur" value="<?php echo $emailutilisateur; ?>">
					<br /><br />
					<label for="objet">Sujet :</label>
					<br />
					<input type="text" name="objet" id="objet" value="<?php echo $objet; ?>">
					<br /><br />
					<label for="message">Votre message :</label>
					<br />
					<textarea name="comments" id="message"><?php echo $comments;?></textarea>
					<br /><br />
					<input type="submit" value="Envoyer">
					</form>
					<?php
						}
					?>
			</fieldset>
			
			<br><br><br><br><br>
			
			<a href="#haut"><img class="haut" src="image/haut.png" title="haut" name="haut"></a>
			
			<br><br><br><br><br><br><br>
			
			<?php include("bloc/pied.php") ?>
			
		</section></td>
		</tr>
		</table>
		
	</body>
	
</html>