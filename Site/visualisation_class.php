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

		<h2>Proportion of enzyme classes</h2>	
		<?php
			try
			{
				$bdd = new PDO('pgsql:dbname=Prog_Web host=localhost','postgres','robinhoussem');
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
			
			$ec_class1 = "ec 1.%" ;			
			$answer1 = $bdd->query("SELECT count(ec)
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class1'");
									
			$result1 = $answer1->fetch();
			$val1 = $result1['count'];
											
			$ec_class2 = "ec 2.%" ;
			$answer2 = $bdd->query("SELECT count(ec)
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class2'");
			$result2 = $answer2->fetch();
			$val2 = $result2['count'];
									
			$ec_class3 = "ec 3.%" ;
			$answer3 = $bdd->query("SELECT count(ec)
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class3'");
			$result3 = $answer3->fetch();
			$val3 = $result3['count'];
									
			$ec_class4 = "ec 4.%" ;
			$answer4 = $bdd->query("SELECT count(ec)
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class4'");
			$result4 = $answer4->fetch();
			$val4 = $result4['count'];
									
			$ec_class5 = "ec 5.%" ;
			$answer5 = $bdd->query("SELECT count(ec)
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class5'");
			$result5 = $answer5->fetch();
			$val5 = $result5['count'];
									
			$ec_class6 = "ec 6.%" ;
			$answer6 = $bdd->query("SELECT count(ec)
									FROM enzyme 
									WHERE LOWER(enzyme.ec) LIKE '$ec_class6'");
			$result6 = $answer6->fetch();
			$val6 = $result6['count'];
		?>
		
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['Enzymes', 'class'],
			['Oxidoreductase',	<?php echo $val1?>],
			['Transferase',		<?php echo $val2?>],
			['Hydrolase',		<?php echo $val3?>],
			['Lyase',		    <?php echo $val4?>],
			['Isomerase',		<?php echo $val5?>],
			['Ligase',		    <?php echo $val6?>]
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
	
		

	</body>
</html>
