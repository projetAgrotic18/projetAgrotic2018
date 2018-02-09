<html>
	<head>
	</head>
	<body>
		<?php
			$type_form = $_GET["porygon"];
			$click_bovin = 0;
			$click_ovin = 0;
			$click_caprin = 0;
			
			//génération d'un formulaire en fonction du type demandé
			if ($type_form == 'eleveur') {
				echo 
					"<input type=text name='identifiant' placeholder='Identifiant'><br/><br/>
					<input type=text name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
					<input type=text name='adresse' placeholder='Adresse' size = 100><br/><br/>
					<input type=text name='commune' placeholder='Commune' size = 75>
					<input type=text name='code_postal' placeholder='Code Postal' size = 20><br/><br/>
					<input type=text name='departement' placeholder='Département' size = 100><br/></br/><br/>
					<input type=text name='telephone' placeholder='Numéro de Téléphone'><br/><br/>
					<input type=email name='mail' placeholder='Adresse Mail'><br/><br/><br/>
					<input type=text name='veto' placeholder='véto'><br/><br/><br/>
					<input type=checkbox name='ovins' value='ovins' onclick = nb_animaux(this.value)> OVINS
					<input type=checkbox name='bovins' value='bovins' onclick = nb_animaux(this.value)> BOVINS
					<input type=checkbox name='caprins' value='caprins' onclick = nb_animaux(this.value)> CAPRINS<br/><br/>
					<span id='nb_animals'></id>";
			}
			elseif ($type_form == 'ddpp') {
				echo 
					"<input type=text name='identifiant' placeholder='Identifiant'><br/><br/>
					<input type=text name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
					<input type=text name='adresse' placeholder='Adresse du Siège' size = 100><br/><br/>
					<input type=text name='commune' placeholder='Commune' size = 75>
					<input type=text name='code_postal' placeholder='Code Postal' size = 20><br/><br/>
					<input type=text name='departement' placeholder='Département' size = 100><br/></br/><br/>
					<input type=text name='telephone' placeholder='Numéro de Téléphone'><br/><br/>
					<input type=text name='mail' placeholder='Adresse Mail'><br/><br/>
					<input type=submit name='sub' value='valider'><br/><br/>
					</form>";
			}
			elseif ($type_form == 'gds') {
				echo 
					"<input type=text name='identifiant' placeholder='Identifiant'><br/><br/>
					<input type=text name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
					<input type=text name='adresse' placeholder='Adresse du Siège' size = 100><br/><br/>
					<input type=text name='commune' placeholder='Commune' size = 75>
					<input type=text name='code_postal' placeholder='Code Postal' size = 20><br/><br/>
					<input type=text name='departement' placeholder='Département' size = 100><br/></br/><br/>
					<input type=text name='telephone' placeholder='Numéro de Téléphone'><br/><br/>
					<input type=text name='mail' placeholder='Adresse Mail'><br/><br/>
					<input type=submit name='sub' value='valider'><br/><br/>
					</form>";
			}
			elseif ($type_form == 'veto') {
				echo 
					"<input type=text name='identifiant' placeholder='Identifiant'><br/><br/>
					<input type=text name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
					<input type=text name='telephone' placeholder='Numéro de Téléphone'><br/><br/>
					<input type=text name='mail' placeholder='Adresse Mail'><br/><br/>
					<input type=submit name='sub' value='valider'><br/><br/>
					</form>";
			}
			elseif ($type_form == 'labo') {
				echo 
					"<input type=text name='identifiant' placeholder='Identifiant'><br/><br/>
					<input type=text name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
					<input type=text name='adresse' placeholder='Adresse' size = 100><br/><br/>
					<input type=text name='commune' placeholder='Commune' size = 75>
					<input type=text name='code_postal' placeholder='Code Postal' size = 20><br/><br/>
					<input type=text name='departement' placeholder='Département' size = 100><br/></br/>
					<input type=submit name='sub' value='valider'><br/><br/>
					</form>";
			}
			//echo "<br/>".$type_form;
			
			?>
	</body>
</html>