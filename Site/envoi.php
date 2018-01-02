<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Style.css" />
    <link rel="icon" type="image/png" href="images/protein-icon.png" />
    <title>Contact Us</title>
  </head>

  <body>
	<h1>E.see</h1>
	<figure>
		<img src="images/protein-icon_128.png" alt="Logo E.see" />
	</figure>

	<div id="menu">
		<ul id="onglets">
		  <li><a href="Page_principale.html"> Home </a></li>
		  <li><a href="Requetes.html"> About Enzymes </a></li>
		  <li><a href="Visualisation.html"> Visualize Metabolic Network </a></li>
		  <li class="active"><a href="Contacts.html"> Contact Us </a></li>
		</ul>
	</div>


<?php
$nom=$_POST['nom'];
$mail=$_POST['mail'];
$objet=$_POST['objet'];
$message=$_POST['message'];
$destinataire="e.see.gd@gmail.com";

////ici on détermine l'expediteur et l'adresse de réponse
$headers = "From: <".$mail.">" . "\r\n";

if (mail($destinataire,$objet,$message)) 
{
	mail($destinataire,$objet,$message);
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

</p>
<p align="center">
	<a href="Page_principale.html">Go to home page</a>
</p>
