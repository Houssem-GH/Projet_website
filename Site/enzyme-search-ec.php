<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Style.css" />
    <link rel="icon" type="image/png" href="protein-icon.png" />
    <title>Result Query on Ec number</title>
  </head>

  <body>
    <h1>E.see</h1>
    <figure>

      <img src="protein-icon_128.png" alt="Logo E.see" />

    </figure>

    <div id="menu">
    <ul id="onglets">
      <li class="active"><a href="Page_principale.html"> Accueil </a></li>
      <li><a href="Requetes.html"> requêtes </a></li>
      <li><a href="Visualisation.html"> Visualisation voies métaboliques </a></li>
      <li><a href="Contacts.html"> Nous contacter </a></li>
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
		$VALEUR= "EC ".$_POST["field1"].".".$_POST["field2"].".".$_POST["field3"].".".$_POST["field4"];
		
		if (empty($_POST["field1"]) || empty($_POST["field2"]) || empty($_POST["field3"]) || empty($_POST["field4"]) )
			{ 
				echo "Please fill all the input field!\n";
				exit;
			}
		else if (!preg_match("/^[0-9]+$/",$_POST["field1"]) || 
			!preg_match("/^[0-9]+$/",$_POST["field2"]) || 
			!preg_match("/^[0-9]+$/",$_POST["field3"]) || 
			!preg_match("/^[0-9]+$/",$_POST["field4"]) )
			{
				echo "Please enter only numbers!\n";
				exit;		
			}
			
		$existanceEC = $bdd->query("SELECT ec FROM enzyme WHERE enzyme.ec = '$VALEUR'");
		$result_existance = $existanceEC->fetch();
		
		if (!$result_existance) 
			{
				echo "Ec number don't exist!\n";
				exit;
			}
		else
			{
			
			$answer = $bdd->query("SELECT enzyme.ec, enzyme.official_name, enzyme.other_name, enzyme.coefacteur, enzyme.commentaire, enzyme.activity, 
			prosite.id_p, swissprot.id_sp, publication.titre, publication.year_pub, publication.auteurs 
			FROM enzyme, swissprot, prosite, publication WHERE enzyme.ec = '$VALEUR' 
			and enzyme.ec = prosite.ec and enzyme.ec = swissprot.ec and enzyme.ec = publication.ec");

			while ($result = $answer->fetch())
				{
					$EC = $result['ec'];
					$Off_Name = $result['official_name'];
					$Oth_Name = $result['other_name'];
					$Coef = $result['coefacteur'];
					$Comm = $result['commentaire'];
					$Act = $result['activity'];
					
					$Arr_id_p = array();
					array_push($Arr_id_p, $result['id_p']);
					
					$Arr_id_sp = array();
					array_push($Arr_id_sp, $result['id_sp']);
					
					$Arr_pub_tit = array();
					array_push($Arr_pub_tit, $result['titre']);
					
					$Arr_id_pub_year = array();
					array_push($Arr_pub_tit, $result['year_pub']);
					
					$Arr_pub_auteur = array();	
					array_push($Arr_pub_auteur, $result['auteurs']);
				}
			$answer->closeCursor(); // Termine le traitement de la requête
			}
			
		$existanceEC->closeCursor(); // Termine le traitement de la requête de l'existance
	?>
					<br />
					<strong>EC :</strong> <?php echo $EC;?>  
					<br />
					<br />
					<strong>Official Name :</strong> <?php echo $Off_Name;?>
					<br />
					<strong>Other Name :</strong> <?php if ($Oth_Name != 'NULL'){echo $Oth_Name;} else {echo "-";}?>
					<br />
					<strong>Cofacteur :</strong> <?php if ($Coef != 'NULL'){echo $Coef;} else {echo "-";}?>
					<br />
					<strong>Commentary:</strong> <?php if ($Comm != 'NULL'){echo $Comm;} else {echo "-";}?>
					<br />
					<strong>Activity :</strong> <?php if ($Act != 'NULL'){echo $Act;} else {echo "-";}?>
					<br />
					<strong>Prosite Id :</strong> <?php if (!empty($Arr_id_p)){foreach ($Arr_id_p as &$value){echo $value."; ";}} else {echo "-";} ?>
					<br />
					<strong>SwissProt Id :</strong> <?php if (!empty($Arr_id_sp)){foreach ($Arr_id_sp as &$value){echo $value."; ";}} else {echo "-";} ?>
					<br />
	



  </body>
</html>
