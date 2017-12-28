<!DOCTYPE hmtl>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Style.css" />
    <link rel="icon" type="image/png" href="protein-icon.png" />
    <title>Result Query on Description</title>
  </head>

  <body>
    <h1>E.see</h1>
    <figure>

      <img src="protein-icon_128.png" alt="Logo E.see" />

    </figure>

		<div id="menu">
			<ul id="onglets">
			  <li><a href="Page_principale.html"> Home </a></li>
			  <li class="active"><a href="Requetes.html"> About Enzymes </a></li>
			  <li><a href="Visualisation.html"> Visualize Metabolic Network </a></li>
			  <li><a href="Contacts.html"> Contact Us </a></li>
			</ul>
		</div>
  <br />
	<?php
		try
		{
			$bdd = new PDO('pgsql:dbname=Prog_Web host=localhost','postgres','robinhoussem');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}
		
		$VALEUR = strtolower($_POST["field_Des"]);
		
		if (empty($_POST["field_Des"]))
		{
			echo "Please fill in the descreption field first!";
			exit;
		}
		
		$answerDES = $bdd->query("SELECT ec, official_name 
								FROM enzyme 
								WHERE LOWER(enzyme.official_name) LIKE '%$VALEUR%' or LOWER(enzyme.other_name) LIKE '%$VALEUR%' or 
								LOWER(enzyme.commentaire) LIKE '%$VALEUR%' or LOWER(enzyme.sys_name) LIKE '%$VALEUR%'");
		$Arr_EC = array();
		$Arr_Name = array();
		while ($result = $answerDES->fetch())
			{
				array_push($Arr_EC, $result['ec']);
				array_push($Arr_Name, $result['official_name']);
			}
		
		echo "Number of matches: " .count($Arr_EC)."<br /><br />";	
		
		if (empty($Arr_EC))
			{
				echo "there is no enzyme related to: \"".$VALEUR."\"";
			}
		else
			{	
				echo "<strong>List of enzymes related to: \"".$VALEUR."\"</strong><br /><br />";
				foreach ($Arr_EC as $key=>$value)
				{
					$num = $key+1;
					echo "* <strong> Enzyme ".$num.": </strong> ".$value."<br />";
					echo "-> Name: ".$Arr_Name[$key]."<br /><br />";
				}

			}
		$answerDES->closeCursor(); // Termine le traitement de la requête
	?>

	</body>
</html>
