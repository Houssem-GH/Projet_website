<? php header('Content-Type: text/html; charset=utf-8'); ?>
<html>
	<title>Exemple de requete sur la table enzyme</title>
	<body>
		<?php
			try
			{
				$bdd = new PDO('pgsql:dbname=Prog_Web host=localhost','postgres','robinhoussem');
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
			$VALEUR= "EC ".$_POST["field1"].".".$_POST["field2"].".".$_POST["field3"].".".$_POST["field4"];
			
			if (!preg_match("/^[0-9]+$/",$_POST["field1"]) || 
				!preg_match("/^[0-9]+$/",$_POST["field2"]) || 
				!preg_match("/^[0-9]+$/",$_POST["field3"]) || 
				!preg_match("/^[0-9]+$/",$_POST["field4"]) )
			{
				echo "Please enter only number!\n";
				exit;
			}
			$existanceEC = $bdd->query("SELECT ec FROM enzyme WHERE enzyme.ec = '$VALEUR'");
			$result_existance = $existanceEC->fetch();
			
			
			//~ $result = $answer->fetch();
			//~ echo $result;
			if (!$result_existance) {
			  echo "Ec number don't exist!\n";
			  exit;
			}
			else
			{
			$answer = $bdd->query("SELECT * FROM enzyme WHERE enzyme.ec = '$VALEUR'");
			while ($result = $answer->fetch())
			{
		?>
				<strong>EC :</strong> <?php echo $result['ec']. "<br />";?>  
				<strong>Official Name :</strong> <?php echo $result['official_name']. "<br />";?>
				<strong>Other Name :</strong> <?php if ($result['other_name'] != 'NULL'){echo $result['other_name']. "<br />";} else {echo "-". "<br />";}?>
				<strong>Cofacteur :</strong> <?php if ($result['coefacteur'] != 'NULL'){echo $result['coefacteur']. "<br />";} else {echo "-". "<br />";}?>
				<strong>Commentaire :</strong> <?php if ($result['commentaire'] != 'NULL'){echo $result['commentaire']. "<br />";} else {echo "-". "<br />";}?>
				<strong>Activity :</strong> <?php if ($result['activity'] != 'NULL'){echo $result['activity']. "<br />";} else {echo "-". "<br />";}?>
				<?php echo "<br />\n";?>
			<?php
			}
			$answer->closeCursor(); // Termine le traitement de la requête
			}
			$existanceEC->closeCursor(); // Termine le traitement de la requête de l'existance
			?>
	</body>
</html>
