<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="Style.css">
		<link rel="icon" type="image/png" href="images/protein-icon.png" />
		<title>About Enzymes</title>
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
			
			if ( empty($_POST["Var-Vers-Enzyme"]) )
			{
				$VALEUR= "EC ".$_POST["field1"].".".$_POST["field2"].".".$_POST["field3"].".".$_POST["field4"];
				
				if (empty($_POST["field1"]) || empty($_POST["field2"]) || empty($_POST["field3"]) || empty($_POST["field4"]) )
					{ 
						echo "Please fill in all the input field!\n";
						?>
						<br />
						<br />
						<form method="POST" action="Requetes.html">
							<input value="Try again" type="submit"></input>
						</form>
						<?php
						exit;
					}
				else if (!preg_match("/^[0-9]+$/",$_POST["field1"]) || 
					!preg_match("/^[0-9]+$/",$_POST["field2"]) || 
					!preg_match("/^[0-9]+$/",$_POST["field3"])  )
					{
						echo "Please enter only numbers!\n";
						?>
						<br />
						<br />
						<form method="POST" action="Requetes.html">
							<input value="Try again" type="submit"></input>
						</form>
						<?php
						exit;		
					}
			}
			else 
			{
				$VALEUR= $_POST["Var-Vers-Enzyme"];
			}
				
			$answerEC = $bdd->query("SELECT * FROM enzyme WHERE enzyme.ec = '$VALEUR'");
			while ($result = $answerEC->fetch())
				{
					$EC = $result['ec'];
					$Off_Name = $result['official_name'];
					$Oth_Name = $result['other_name'];
					$Coef = $result['coefacteur'];
					$Comm = $result['commentaire'];
					$Act = $result['activity'];
					$His = $result['history'];
					$Fun_Name = $result['sys_name'];
				}
						
			if (empty($EC)) 
				{
					echo $VALEUR.": Ec number don't exist!\n";
						?>
						<br />
						<br />
						<form method="POST" action="Requetes.html">
							<input value="Try again" type="submit"></input>
						</form>
						<?php
					exit;
				}
			else
			{
		?>
				<strong>EC :</strong> <?php echo $EC;?>  
				<br />
				<br />
				<br />
				<strong>Official Name :</strong> <?php echo $Off_Name;?>
				<br />
				<br />
				<strong>Functional Name :</strong> <?php if ($Fun_Name != 'NULL'){echo $Fun_Name;} else {echo "-";}?>
				<br />
				<br />
				<strong>Other Name :</strong> <?php if ($Oth_Name != 'NULL'){echo $Oth_Name;} else {echo "-";}?>
				<br />
				<br />
				<strong>Cofacteur :</strong> <?php if ($Coef != 'NULL'){echo $Coef;} else {echo "-";}?>
				<br />
				<br />
				<strong>Commentary:</strong> <?php if ($Comm != 'NULL'){echo $Comm;} else {echo "-";}?>
				<br />
				<br />
				<strong>Activity :</strong> <?php if ($Act != 'NULL'){echo $Act;} else {echo "-";}?>
				<br />
				<br />
				<strong>History :</strong> <?php if ($His != 'NULL'){echo $His;} else {echo "-";}?>
				<br />
				<br />				
		<?php	
			}
			
			$answerEC->closeCursor(); // Termine le traitement de la requête
			
			$answerProsite = $bdd->query("SELECT * FROM prosite WHERE prosite.ec = '$VALEUR'");

			$Arr_id_p = array();
			
			while ($result = $answerProsite->fetch())
			{
				array_push($Arr_id_p, $result['id_p']);
			}
		?>					
			<strong>Prosite Id :</strong> <?php if (!empty($Arr_id_p)){foreach ($Arr_id_p as &$value){echo $value."; ";}} else {echo "-";} ?>
			<br />
			<br />
		<?php
				
			$answerProsite->closeCursor(); // Termine le traitement de la requête
			
			$answerSwiss = $bdd->query("SELECT * FROM swissprot WHERE swissprot.ec = '$VALEUR'");
			

			$Arr_id_sp = array();
			while ($result = $answerSwiss->fetch())
			{
				array_push($Arr_id_sp, $result['id_sp']);
			}
		?>					
				<strong>SwissProt Id :</strong> <?php if (!empty($Arr_id_sp)){foreach ($Arr_id_sp as &$value){echo $value.", ";}} else {echo "-";} ?>
				<br />
				<br />
		<?php
			$answerSwiss->closeCursor(); // Termine le traitement de la requête
			
			$answerPub = $bdd->query("SELECT * FROM publication WHERE publication.ec = '$VALEUR'");			
			
			$Arr_pub_tit = array();
			$Arr_pub_year = array();
			$Arr_pub_auteur = array();	
			
			while ($result = $answerPub->fetch())
			{			
				array_push($Arr_pub_auteur, $result['auteurs']);
				array_push($Arr_pub_year, $result['year_pub']);
				array_push($Arr_pub_tit, $result['titre']);	
			}					
		?>
			<strong>Publications about this enzyme :</strong><br/><br/>
		<?php
			if (!empty($Arr_pub_tit))
				{
					foreach ($Arr_pub_tit as $key=>$value)
					{
						echo "* Title: ".$value. "<br />"; 
						$year = $Arr_pub_year[$key];
						echo "Year: ".$Arr_pub_year[$key]. "<br />";
						echo "Authors: ".$Arr_pub_auteur[$key]. "<br />". "<br />";
					}
				} 
			else 
			{
				echo "-";
			}
			
			$answerPub->closeCursor(); // Termine le traitement de la requête 
		?>
	</body>
</html>
