<!DOCTYPE html >
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="Style.css">
		<link rel="icon" type="image/png" href="images/protein-icon.png" />
		<title>Statistics about enzymes</title>
	</head>

	<body>

		<div id = "logo_titre">
			<h1>E.see</h1>
			<img id = "logo" src="images/protein-icon_128.png" alt="Logo E.see" />
		</div>

		<div id="menu">
			<ul id="onglets">
				<li id = "onglets_li">
					<a href="Page_principale.html"> Home </a>
				</li>
				<li id = "onglets_li">
					<a href="Requetes.html"> About Enzymes </a>
				</li>
				<li id = "onglets_li" class="active">
					<a href="Visualisation.html"> Statistics About Enzymes </a>
				</li>
				<li id = "onglets_li" style="float:right">
					<a href="Contacts.html"> Contact </a>
				</li>
			</ul>
		</div>
		
		<h2>Enzyme statistics</h2>
		<br/>
		

		<?php
			try
			{
				$bdd = new PDO('pgsql:dbname=Prog_Web host=localhost','postgres','robinhoussem');
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
			
			$class = $_POST["visu_class"];
			
			echo "<b>Enzyme Class:</b> ".$class;
			
			if ($class == "Ligase")
			{
				$ec_class = "ec 6.%" ;
			
			$answer = $bdd->query("SELECT ec
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class'");
									
			$Forming_carbon_oxygen_bonds = 0;
			$Forming_carbon_sulfur_bonds = 0;
			$Forming_carbon_nitrogen_bonds = 0;
			$Forming_carbon_carbon_bonds = 0;
			$Forming_phosphoric_ester_bonds = 0;
			$Forming_nitrogen_metal_bonds = 0;
			
			while ($result = $answer->fetch())
				{
					if ( stristr($result['ec'], 'EC 6.1') == true ) 
					{
						$Forming_carbon_oxygen_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 6.2') == true )
					{
						$Forming_carbon_sulfur_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 6.3') == true )
					{
						$Forming_carbon_nitrogen_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 6.4') == true )
					{
						$Forming_carbon_carbon_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 6.5') == true )
					{
						$Forming_phosphoric_ester_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 6.6') == true )
					{
						$Forming_nitrogen_metal_bonds ++;
					}
				}
		?>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['Enzymes', 'Subclass'],
			['Forming carbon-oxygen bonds',	<?php echo $Forming_carbon_oxygen_bonds?>],
			['Forming carbon-sulfur bonds',		<?php echo $Forming_carbon_sulfur_bonds?>],
			['Forming carbon-nitrogen bonds',		<?php echo $Forming_carbon_nitrogen_bonds?>],
			['Forming carbon-carbon bonds',		    <?php echo $Forming_carbon_carbon_bonds?>],
			['Forming phosphoric ester bonds',		<?php echo $Forming_phosphoric_ester_bonds?>],
			['Forming nitrogen-metal bonds',		    <?php echo $Forming_nitrogen_metal_bonds?>]
			]);

			var options = {
			is3D: true,
			backgroundColor: 'transparent',
			legend: { position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 11}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d" style="width: 810px; height: 500px; float: right; margin-right: 6.5cm; margin-top: -1.9cm;"></div>
				
		<?php	
			}

			else if ($class == "Isomerase")
			{
				$ec_class = "ec 5.%" ;
			
			$answer = $bdd->query("SELECT ec
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class'");
									
			$Racemases_and_epimerases = 0;
			$Cis_trans_isomerases = 0;
			$Intramolecular_transferases = 0;
			$Intramolecular_lyases = 0;
			$Other_isomerases = 0;
			
			while ($result = $answer->fetch())
				{
					if ( stristr($result['ec'], 'EC 5.1') == true ) 
					{
						$Racemases_and_epimerases ++;
					}
					else if ( stristr($result['ec'], 'EC 5.2') == true )
					{
						$Cis_trans_isomerases ++;
					}
					else if ( stristr($result['ec'], 'EC 5.3') == true )
					{
						$Intramolecular_transferases ++;
					}
					else if ( stristr($result['ec'], 'EC 5.4') == true )
					{
						$Intramolecular_lyases ++;
					}
					else
					{
						$Other_isomerases ++;
					}
				}
		?>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['Enzymes', 'Subclass'],
			['Racemases and epimerases',	<?php echo $Racemases_and_epimerases?>],
			['Cis-trans-isomerases',		<?php echo $Cis_trans_isomerases?>],
			['Intramolecular transferases',		<?php echo $Intramolecular_transferases?>],
			['Intramolecular lyases',		    <?php echo $Intramolecular_lyases?>],
			['Other isomerases',		<?php echo $Other_isomerases?>],
			]);

			var options = {
			is3D: true,
			backgroundColor: 'transparent',
			legend: {position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 11}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d" style="width: 810px; height: 500px; float: right; margin-right: 6.5cm; margin-top: -1.9cm;"></div>
				
		<?php	
			}					
		?>



	</body>
</html>
