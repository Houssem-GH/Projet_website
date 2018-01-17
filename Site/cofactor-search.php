<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="Style.css">
		<link rel="icon" type="image/png" href="images/protein-icon.png" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<title>Result Query on Cofactors</title>
	</head>

	<body>
		
		<script type="text/javascript"> $(document).ready(function(){ $('.top').click(function(){ $('html,body').animate({scrollTop: 0},'slow'); }); }); </script>
		
		<div id = "logo_titre">
			<h1>E.see</h1>
			<img title = "E.see" id = "logo" src="images/protein-icon_128.png" alt="Logo E.see" />
		</div>
				
		<div id="menu">
			<ul id="onglets">
			  <li id = "onglets_li">
				  <a href="Page_principale.html"> Home </a>
			  </li>
			  <li id = "onglets_li" class="active"><a href="Requetes.html"> About Enzymes </a>
			  </li>
			  <li id = "onglets_li">
				  <a href="Visualisation.html"> Statistics About Enzymes </a>
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
			$Val_aff = $_POST["field_cofactor"];
			$VALEUR = strtolower($_POST["field_cofactor"]);
			
			if (empty($_POST["field_cofactor"]))
			{
				echo "Please fill in the research field first!";
		?>
				<br />
				<br />
				<form method="POST" action="Requetes.html">
					<input value="Try again" type="submit"></input>
				</form>
		<?php
				exit;
			}
			
			$answerCOF = $bdd->query("SELECT ec, official_name 
									FROM enzyme 
									WHERE LOWER(enzyme.coefacteur) LIKE '%$VALEUR%'");
			$Arr_EC = array();
			$Arr_Name = array();
			while ($result = $answerCOF->fetch())
				{
					array_push($Arr_EC, $result['ec']);
					array_push($Arr_Name, $result['official_name']);
				}
			
			echo "Number of matches: " .count($Arr_EC)."<br /><br />";
			
			if (empty($Arr_EC))
				{
					echo "there is no enzyme using \"".$Val_aff."\" as cofactor";
		?>
					<br />
					<br />
					<form method="POST" action="Requetes.html">
						<input value="Try again" type="submit"></input>
					</form>
		<?php
				}
			else
				{					
					echo "<strong>List of enzymes using: \"".$Val_aff."\" as cofactor</strong><br /><br />";	
		?>
					<div style = "margin-right: 0cm; width: 600px; height: 400px; float: right;" id="piechart_3d1"></div>
		<?php					
					$Oxido = 0;
					$Transferase = 0;
					$Hydrolase = 0;
					$Lyase = 0 ;
					$Isomerase = 0 ;
					$Ligase = 0;			
					foreach ($Arr_EC as $key=>$value)
					{
						$num = $key+1;
						if (stristr($Arr_EC[$key], 'EC 1.') == true )
						{
							$Oxido ++;
						} 
						else if (stristr($Arr_EC[$key], 'EC 2.') == true )
						{
							$Transferase ++;
						} 
						else if (stristr($Arr_EC[$key], 'EC 3.') == true )
						{
							$Hydrolase ++;
						} 
						else if (stristr($Arr_EC[$key], 'EC 4.') == true )
						{
							$Lyase ++;
						} 
						else if (stristr($Arr_EC[$key], 'EC 5.') == true )
						{
							$Isomerase ++;
						} 
						else if (stristr($Arr_EC[$key], 'EC 6.') == true )
						{
							$Ligase ++;
						}						
		?>
						<div >
						<form method="POST" action="enzyme-search-ec.php" target="_BLANK">
							<strong> Enzyme <?php echo $num; ?>: </strong>
							<input type="txt" readonly="readonly" id = "enzyme_bouton" size = "9" name="Var-Vers-Enzyme" value="<?php echo $value; ?>"></input>
							<input value="E.see this enzyme" type="submit"></input><br/>
							<div id = "Name_Enzyme"><?php echo "=> Name: ".$Arr_Name[$key]; ?></div>
							<br/>
							<br/>
							<br/>
						</form>
						</div>
		<?php
					}
					
					if ($num >20)
					{
		?>
					<div id = "Go_top">
						<a href="#"><img src="images/fleche.png" align = "right" class="top" title="Retour en haut"/></a>
					</div>
		<?php
					}
				}
			$answerCOF->closeCursor(); // Termine le traitement de la requête
		?>
		
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
			var data = google.visualization.arrayToDataTable([
			['Enzymes', 'class'],
			['Oxidoreductase',	<?php echo $Oxido?>],
			['Transferase',		<?php echo $Transferase?>],
			['Hydrolase',		<?php echo $Hydrolase?>],
			['Lyase',		    <?php echo $Lyase?>],
			['Isomerase',		<?php echo $Isomerase?>],
			['Ligase',		    <?php echo $Ligase?>]
			]);

			var options = {
			title: 'Enzyme classes proportion',
			titleTextStyle: {
								color: 'white',   
								fontSize: 20, 
								bold: true, 
							},
			pieHole: 0.4,
			backgroundColor: 'transparent',
			legend: {pagingTextStyle: { color: 'white' }, scrollArrows:{ activeColor: '#2994B2', inactiveColor:'transparent' } , 
				position: 'right', textStyle: {bold:true , color: 'white', fontSize: 12}},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d1'));
			chart.draw(data, options);
			}
		</script>
	</body>
</html>
