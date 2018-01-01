<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="Style.css" />
		<link rel="icon" type="image/png" href="images/protein-icon.png" />
		<title>Lya Enzymes</title>
    </head>

	<body>
		<h1>E.see</h1>
		<figure>
			<img src="images/protein-icon_128.png" alt="Logo E.see" />
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
		
		$answer = $bdd->query("SELECT ec, official_name 
								FROM enzyme 
								WHERE LOWER(enzyme.ec) LIKE 'ec 4.%'");
		
		$Arr_EC = array();
		$Arr_Name = array();
		while ($result = $answer->fetch())
			{
				array_push($Arr_EC, $result['ec']);
				array_push($Arr_Name, $result['official_name']);
			}
		
		if (empty($Arr_EC))
			{
				echo "there is no enzymes in this class";
			}
		else
			{			
				echo "<strong>Lyase enzymes:</strong>"."<br />"."<br />";
				foreach ($Arr_EC as $key=>$value)
				{
					$num = $key+1;
					echo "* <strong> Enzyme ".$num.": </strong> ".$value;
					echo "-> Name: ".$Arr_Name[$key];
					
					?>
					<form method="POST" action="enzyme-search-ec.php" target="_BLANK">
						<input type="hidden" name="Var-Vers-Enzyme" value="<?php echo $value ?>"></input>
						<input value="E.see this enzyme" type="submit"></input>
					</form>
					<br /><br />
					<?php
				}
			}
	?>

  </body>
</html>