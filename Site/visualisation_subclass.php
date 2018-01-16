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
			?>
			<h2>
			<?php	
			echo "Enzyme Class: ".$class."";
			?>
			</h2>
			<br/>
			<?php
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
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d"></div>
				
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
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d"></div>
				
		<?php	
			}
			else if ($class == "Lyase")
			{
				$ec_class = "ec 4.%" ;
			
			$answer = $bdd->query("SELECT ec
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class'");
									
			$Carbon_carbon_lyases = 0;
			$Carbon_oxygen_lyases = 0;
			$Carbon_nitrogen_lyases = 0;
			$Carbon_sulfur_lyases = 0;
			$Carbon_halide_lyases = 0;
			$Phosphorus_oxygen_lyases = 0;
			$Carbon_phosphorus_lyases = 0;
			$Other_lyases = 0;
			
			while ($result = $answer->fetch())
				{
					if ( stristr($result['ec'], 'EC 4.1') == true ) 
					{
						$Carbon_carbon_lyases ++;
					}
					else if ( stristr($result['ec'], 'EC 4.2') == true )
					{
						$Carbon_oxygen_lyases ++;
					}
					else if ( stristr($result['ec'], 'EC 4.3') == true )
					{
						$Carbon_nitrogen_lyases ++;
					}
					else if ( stristr($result['ec'], 'EC 4.4') == true )
					{
						$Carbon_sulfur_lyases ++;
					}
					else if ( stristr($result['ec'], 'EC 4.5') == true )
					{
						$Carbon_halide_lyases ++;
					}
					else if ( stristr($result['ec'], 'EC 4.6') == true )
					{
						$Phosphorus_oxygen_lyases ++;
					}
					else if ( stristr($result['ec'], 'EC 4.7') == true )
					{
						$Carbon_phosphorus_lyases ++;
					}
					else
					{
						$Other_lyases ++;
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
			['Carbon-carbon lyases',	<?php echo $Carbon_carbon_lyases?>],
			['Carbon-oxygen lyases',		<?php echo $Carbon_oxygen_lyases?>],
			['Carbon-nitrogen lyases',		<?php echo $Carbon_nitrogen_lyases?>],
			['Carbon-sulfur lyases',		    <?php echo $Carbon_sulfur_lyases?>],
			['Carbon-halide lyases',		<?php echo $Carbon_halide_lyases?>],
			['Phosphorus-oxygen lyases',		<?php echo $Phosphorus_oxygen_lyases?>],
			['Carbon-phosphorus lyases',		<?php echo $Carbon_phosphorus_lyases?>],
			['Other lyases',		<?php echo $Other_lyases?>],
			]);

			var options = {
			is3D: true,
			backgroundColor: 'transparent',
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d"></div>
	<?php
		}
			else if ($class == "Hydrolase")
			{
				$ec_class = "ec 3.%" ;
			
			$answer = $bdd->query("SELECT ec
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class'");
									
			$Acting_on_ester_bonds = 0;
			$Glycosylases = 0;
			$Acting_on_ether_bonds = 0;
			$Peptidases = 0;
			$Acting_on_carbon_nitrogen_bonds = 0;
			$Acting_on_acid_anhydrides = 0;
			$Acting_on_carbon_carbon_bonds = 0;
			$Acting_on_halide_bonds = 0;
			$Acting_on_phosphorus_nitrogen_bonds = 0;
			$Acting_on_sulfur_nitrogen_bonds = 0;
			$Acting_on_carbon_phosphorus_bonds = 0;
			$Acting_on_sulfur_sulfur_bonds = 0;
			$Acting_on_carbon_sulfur_bonds = 0;
			
			while ($result = $answer->fetch())
				{
					if ( stristr($result['ec'], 'EC 3.1') == true ) 
					{
						$Acting_on_ester_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.2') == true )
					{
						$Glycosylases ++;
					}
					else if ( stristr($result['ec'], 'EC 3.3') == true )
					{
						$Acting_on_ether_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.4') == true )
					{
						$Peptidases ++;
					}
					else if ( stristr($result['ec'], 'EC 3.5') == true )
					{
						$Acting_on_carbon_nitrogen_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.6') == true )
					{
						$Acting_on_acid_anhydrides ++;
					}
					else if ( stristr($result['ec'], 'EC 3.7') == true )
					{
						$Acting_on_carbon_carbon_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.8') == true )
					{
						$Acting_on_halide_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.9') == true )
					{
						$Acting_on_phosphorus_nitrogen_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.10') == true )
					{
						$Acting_on_sulfur_nitrogen_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.11') == true )
					{
						$Acting_on_carbon_phosphorus_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.12') == true )
					{
						$Acting_on_sulfur_sulfur_bonds ++;
					}
					else if ( stristr($result['ec'], 'EC 3.13') == true )
					{
						$Acting_on_carbon_sulfur_bonds ++;
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
			['Acting on ester bonds',	<?php echo $Acting_on_ester_bonds?>],
			['Glycosylases',		<?php echo $Glycosylases?>],
			['Acting on ether bonds',		<?php echo $Acting_on_ether_bonds?>],
			['Peptidases',		    <?php echo $Peptidases?>],
			['Acting on C-N bonds',		<?php echo $Acting_on_carbon_nitrogen_bonds?>],
			['Acting on acid anhydrides',		<?php echo $Acting_on_acid_anhydrides?>],
			['Acting on C-C bonds',		<?php echo $Acting_on_carbon_carbon_bonds?>],
			['Acting on halide bonds',		<?php echo $Acting_on_halide_bonds?>],
			['Acting on P-N bonds',		<?php echo $Acting_on_phosphorus_nitrogen_bonds ?>],
			['Acting on S-N bonds',		<?php echo $Acting_on_sulfur_nitrogen_bonds?>],
			['Acting on C-P bonds',		<?php echo $Acting_on_carbon_phosphorus_bonds?>],
			['Acting on S-S bonds',		<?php echo $Acting_on_sulfur_sulfur_bonds?>],
			['Acting on C-S bonds',		<?php echo $Acting_on_carbon_sulfur_bonds?>],
			]);

			var options = {
			is3D: true,
			backgroundColor: 'transparent',
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d"></div>
	<?php
		}
			else if ($class == "Transferase")
			{
				$ec_class = "ec 2.%" ;
			
			$answer = $bdd->query("SELECT ec
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class'");
									
			$Transferring_one_carbon_groups = 0;
			$Transferring_aldehyde_or_ketonic_groups = 0;
			$Acyltransferases = 0;
			$Glycosyltransferases = 0;
			$Transferring_alkyl_or_aryl_groups = 0;
			$Transferring_nitrogenous_groups = 0;
			$Transferring_phosphorus_containing_groups = 0;
			$Transferring_sulfur_containing_groups = 0;
			$Transferring_selenium_containing_groups = 0;
			$Transferring_molybdenum = 0;

			
			while ($result = $answer->fetch())
				{
					if ( stristr($result['ec'], 'EC 2.1') == true ) 
					{
						$Transferring_one_carbon_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.2') == true )
					{
						$Transferring_aldehyde_or_ketonic_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.3') == true )
					{
						$Acyltransferases ++;
					}
					else if ( stristr($result['ec'], 'EC 2.4') == true )
					{
						$Glycosyltransferases ++;
					}
					else if ( stristr($result['ec'], 'EC 2.5') == true )
					{
						$Transferring_alkyl_or_aryl_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.6') == true )
					{
						$Transferring_nitrogenous_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.7') == true )
					{
						$Transferring_phosphorus_containing_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.8') == true )
					{
						$Transferring_sulfur_containing_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.9') == true )
					{
						$Transferring_selenium_containing_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 2.10') == true )
					{
						$Transferring_molybdenum ++;
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
			['Transferring one-carbon groups',		    <?php echo $Transferring_one_carbon_groups?>],
			['Transferring aldehyde or ketonic groups',		    <?php echo $Transferring_aldehyde_or_ketonic_groups?>],
			['Acyltransferases',		    <?php echo $Acyltransferases?>],
			['Glycosyltransferases',		    <?php echo $Glycosyltransferases?>],
			['Transferring alkyl or aryl groups',		    <?php echo $Transferring_alkyl_or_aryl_groups?>],
			['Transferring nitrogenous groups',		    <?php echo $Transferring_nitrogenous_groups?>],
			['Transferring phosphorus-containing groups',		    <?php echo $Transferring_phosphorus_containing_groups?>],
			['Transferring sulfur-containing groups',		    <?php echo $Transferring_sulfur_containing_groups?>],
			['Transferring selenium-containing groups',		    <?php echo $Transferring_selenium_containing_groups?>],
			['Transferring molybdenum',		    <?php echo $Transferring_molybdenum?>],
			]);

			var options = {
			is3D: true,
			backgroundColor: 'transparent',
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d"></div>
	<?php
		}
		
			else if ($class == "Oxidoreductase")
			{
				$ec_class = "ec 1.%" ;
			
			$answer = $bdd->query("SELECT ec
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class'");
									
			$Oxidizing_metal_ions = 0;
			$Acting_on_CH_or_CH2_groups = 0;
			$Acting_on_NADH_or_NADPH = 0;
			$Catalyzing_the_reaction = 0;
			$Acting_on_molecules_having_oxygen_in_donors = 0;
			$Acting_on_molecules_in_the_acceptor = 0;
			$Other_oxidoreductases = 0;
			$Acting_on_groups_or_domain_in_the_donors = 0;

			
			while ($result = $answer->fetch())
				{
					if ( stristr($result['ec'], 'EC 1.16') == true ) 
					{
						$Oxidizing_metal_ions ++;
					}
					else if ( stristr($result['ec'], 'EC 1.17') == true )
					{
						$Acting_on_CH_or_CH2_groups ++;
					}
					else if ( stristr($result['ec'], 'EC 1.6') == true )
					{
						$Acting_on_NADH_or_NADPH ++;
					}
					else if ( stristr($result['ec'], 'EC 1.21') == true )
					{
						$Catalyzing_the_reaction ++;
					}
					else if ( stristr($result['ec'], 'EC 1.13') == true || stristr($result['ec'], 'EC 1.14') == true  )
					{
						$Acting_on_molecules_having_oxygen_in_donors ++;
					}
					else if ( stristr($result['ec'], 'EC 1.11') == true || stristr($result['ec'], 'EC 1.23') == true || stristr($result['ec'], 'EC 1.15') == true )
					{
						$Acting_on_molecules_in_the_acceptor ++;
					}
					else if ( stristr($result['ec'], 'EC 1.97') == true || stristr($result['ec'], 'EC 1.98') == true || stristr($result['ec'], 'EC 1.99') == true )
					{
						$Other_oxidoreductases ++;
					}
					else
					{
						$Acting_on_groups_or_domain_in_the_donors ++;
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
			['Oxidizing metal ions',		    			<?php echo $Oxidizing_metal_ions?>],
			['Acting on CH or CH(2) groups',		    	<?php echo $Acting_on_CH_or_CH2_groups?>],
			['Acting on NADH or NADPH',		    			<?php echo $Acting_on_NADH_or_NADPH?>],
			['Catalyzing the reaction X-H + Y-H = X-Y',		<?php echo $Catalyzing_the_reaction?>],
			['Acting on molecules having oxygen in donors',	<?php echo $Acting_on_molecules_having_oxygen_in_donors?>],
			['Acting_on molecules in the acceptor',		    <?php echo $Acting_on_molecules_in_the_acceptor?>],
			['Other oxidoreductases',		    			<?php echo $Other_oxidoreductases?>],
			['Acting on groups or domain in the donors',	<?php echo $Acting_on_groups_or_domain_in_the_donors?>],
			]);

			var options = {
			is3D: true,
			backgroundColor: 'transparent',
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'bottom', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
			}
		</script>
		<div id="piechart_3d"></div>
	<?php
		}
		
	?>



	</body>
</html>
