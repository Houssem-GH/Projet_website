<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="Style.css">
		<link rel="icon" type="image/png" href="images/protein-icon.png" />
		<title>Contact</title>
	</head>

	<body>
		
		<div id = "logo_titre">
			<h1>E.see</h1>
			<img id = "logo" src="images/protein-icon_128.png" alt="Logo E.see" />
		</div>
					
		<div id="menu">
			<ul id="onglets">
				<li id ="onglets_li">
					<a href="Page_principale.html"> Home </a>
				</li>
				<li id ="onglets_li">
					<a href="Requetes.html"> About Enzymes </a>
				</li>
				<li id ="onglets_li">
					<a href="Visualisation.html"> Statistics About Enzymes </a>
				</li>
				<li id ="onglets_li" class="active" style="float:right">
					<a href="Contacts.html"> Contact</a>
				</li>
			</ul>
		</div>


		<?php
			$nom=$_POST['nom'];
			$mail=$_POST['mail'];
			$objet=$_POST['objet'];
			$message=$_POST['message'];
			$destinataire="e.see.gd@gmail.com";

			////ici on détermine l'expediteur et l'adresse de réponse
			$headers .= "From: <".$mail.">" . "\r\n";
			if (mail($destinataire,$objet,$message)) 
			{
			mail($destinataire,$objet,$message,$headers);
		?>
			<br/><p align="center"> Your email was sent, thank you <br/><br/> </p>
		<?php
			} 
			else
			{
		?>
			<br/><p align="center"> Error in mail sending <br/><br/> </p>
		<?php
			}
		?>
			<p align="center">
			<a href="Page_principale.html">Go to home page</a>
			</p>
	</body>
</html>
