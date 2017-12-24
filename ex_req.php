<!DOCTYPE html>
<html>
	<title>Exemple de requete sur la table enzyme</title>
	<body>
		<?php
			try
			{
				$bdd = new PDO('pgsql:dbname=Prog_Web host=localhost','postgres','houss940715.');
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
			$VALEUR= "EC 1.1.1.1";
			$answer = $bdd->query("SELECT * FROM enzyme WHERE enzyme.ec = '$VALEUR'");
						
			if (!$answer) {
			  echo "Ec number don't exist!\n";
			  exit;
			}
			
			while ($result = $answer->fetch())
			{
		?>
				<strong>EC:</strong> <?php echo $result['ec']. "<br />";?>  
				<strong>Official Name:</strong> <?php echo $result['official_name']. "<br />";?>
				<strong>Other Name:</strong> <?php if ($result['other_name'] != 'NULL'){echo $result['other_name']. "<br />";} else {echo "-". "<br />";}?>
				<strong>Cofacteur:</strong> <?php if ($result['coefacteur'] != 'NULL'){echo $result['coefacteur']. "<br />";} else {echo "-". "<br />";}?>
				<strong>Commentaire:</strong> <?php if ($result['commentaire'] != 'NULL'){echo $result['commentaire']. "<br />";} else {echo "-". "<br />";}?>
				<strong>Activity:</strong> <?php if ($result['activity'] != 'NULL'){echo $result['activity']. "<br />";} else {echo "-". "<br />";}?>
				<?php echo "<br />\n";?>
				
			<?php
			}
			
			$answer->closeCursor(); // Termine le traitement de la requête
			?>
	</body>
</html>
