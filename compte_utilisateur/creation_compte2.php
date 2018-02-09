<html>
	<head>
	</head>
	<body>
		<?php
			$type_form = $_GET["porygon"];
			
			//génération d'un formulaire en fonction du type demandé
			if ($type_form == 'eleveur') {
				echo 
					"<form method = 'GET' name = 'form_eleveur' action = 'admin_creation_compte3.php'>
						<input type=text name='identifiant' value='Identifiant'><br/><br/>
						<input type=text name='mot_de_passe' value='Mot de Passe'><br/><br/><br/>
						<input type=text name='adresse' value='Adresse' size = 100><br/><br/>
						<input type=text name='commune' value='Commune' size = 75>
						<input type=text name='code_postal' value='Code Postal' size = 20><br/><br/>
						<input type=text name='departement' value='Département' size = 100><br/></br/><br/>
						<input type=text name='telephone' value='Numéro de Téléphone'><br/><br/>
						<input type=text name='mail' value='Adresse Mail'><br/><br/><br/>
						<input type=text name='veto' value='véto'><br/><br/><br/>
						<input type=checkbox name='ovins' value='ovins'> OVINS
						<input type=checkbox name='bovins' value='bovins'> BOVINS
						<input type=checkbox name='caprins' value='caprins'> CAPRINS<br/><br/>
						<input type=submit name='sub' value='valider'><br/><br/>";
			}
			elseif ($type_form == 'ddpp') {
				echo 
					"<form method = 'GET' name = 'form_eleveur' action = 'admin_creation_compte3.php'>
						<input type=text name='identifiant' value='Identifiant'><br/><br/>
						<input type=text name='mot_de_passe' value='Mot de Passe'><br/><br/><br/>
						<input type=text name='adresse' value='Adresse du Siège' size = 100><br/><br/>
						<input type=text name='commune' value='Commune' size = 75>
						<input type=text name='code_postal' value='Code Postal' size = 20><br/><br/>
						<input type=text name='departement' value='Département' size = 100><br/></br/><br/>
						<input type=text name='telephone' value='Numéro de Téléphone'><br/><br/>
						<input type=text name='mail' value='Adresse Mail'><br/><br/>
						<input type=submit name='sub' value='valider'><br/><br/>";
			}
			elseif ($type_form == 'gds') {
				echo 
					"<form method = 'GET' name = 'form_eleveur' action = 'admin_creation_compte3.php'>
						<input type=text name='identifiant' value='Identifiant'><br/><br/>
						<input type=text name='mot_de_passe' value='Mot de Passe'><br/><br/><br/>
						<input type=text name='adresse' value='Adresse du Siège' size = 100><br/><br/>
						<input type=text name='commune' value='Commune' size = 75>
						<input type=text name='code_postal' value='Code Postal' size = 20><br/><br/>
						<input type=text name='departement' value='Département' size = 100><br/></br/><br/>
						<input type=text name='telephone' value='Numéro de Téléphone'><br/><br/>
						<input type=text name='mail' value='Adresse Mail'><br/><br/>
						<input type=submit name='sub' value='valider'><br/><br/>";
			}
			elseif ($type_form == 'veto') {
				echo 
					"<form method = 'GET' name = 'form_eleveur' action = 'admin_creation_compte3.php'>
						<input type=text name='identifiant' value='Identifiant'><br/><br/>
						<input type=text name='mot_de_passe' value='Mot de Passe'><br/><br/><br/>
						<input type=text name='telephone' value='Numéro de Téléphone'><br/><br/>
						<input type=text name='mail' value='Adresse Mail'><br/><br/>
						<input type=submit name='sub' value='valider'><br/><br/>";
			}
			elseif ($type_form == 'labo') {
				echo 
					"<form method = 'GET' name = 'form_eleveur' action = 'admin_creation_compte3.php'>
						<input type=text name='identifiant' value='Identifiant'><br/><br/>
						<input type=text name='mot_de_passe' value='Mot de Passe'><br/><br/><br/>
						<input type=text name='adresse' value='Adresse' size = 100><br/><br/>
						<input type=text name='commune' value='Commune' size = 75>
						<input type=text name='code_postal' value='Code Postal' size = 20><br/><br/>
						<input type=text name='departement' value='Département' size = 100><br/></br/>
						<input type=submit name='sub' value='valider'><br/><br/>";
			}
			// echo "<br/>".$type_form;
			//pour tester
			?>
	</body>
</html>