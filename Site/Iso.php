<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="Style.css">
		<link rel="icon" type="image/png" href="images/protein-icon.png" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<title>Iso Enzymes</title>
    </head>

	<body>
		
		<h1>E.see</h1>
		
		<script type="text/javascript"> $(document).ready(function(){ $('.top').click(function(){ $('html,body').animate({scrollTop: 0},'slow'); }); }); </script>
		
		<div id = "logo">
			<img src="images/protein-icon_128.png" alt="Logo E.see" />
		</div>
		
		<div id="menu">
			<ul id="onglets">
			  <li id = "onglets_li">
				  <a href="Page_principale.html"> Home </a>
			  </li>
			  <li id = "onglets_li" class="active">
				  <a href="Requetes.html"> About Enzymes </a>
			  </li>
			  <li id = "onglets_li">
				  <a href="Visualisation.html"> Visualize Metabolic Network </a>
			  </li>
			  <li id = "onglets_li" style="float:right">
				  <a href="Contacts.html"> Contact </a>
			  </li>
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
									WHERE LOWER(enzyme.ec) LIKE 'ec 5.%'");
			
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
					echo "<h2>Isomerase enzymes</h2>"."<br />"."<br />";
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
						<br/><br/>
						<?php
					}
				}
		?>
		<a href="#"><img src="images/fleche.png" class="top" align="right" title="Retour en haut"/></a>	
		
		
	</body>
</html>
