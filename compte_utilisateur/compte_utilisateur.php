<html>
	<head> 
		<!--By les Pokemen-->
	</head>
	<body>
		Bienvenue dans l'assistance de création de compte. <br/>
		Que puis-je pour vous?<br/>
        <h2>Type de compte:</h2>
		
		<!-- Radio-boutonpour sélectionner le type de formulaire à remplir-->
		<form method = 'POST' name = 'form_eleveur' action = 'validation_compte_utilisateur.php'>	
            <INPUT type = radio name = rb value = 'DDPP' >DDPP 
            <INPUT type = radio name = rb value = 'GDS'>GDS 
            <INPUT type = radio name = rb value = 'veterinaire'>Vétérinaire / GTV 
            <INPUT type = radio name = rb value = 'laboratoire'>Laboratoire 
            <INPUT type = radio name = rb value = 'eleveur'>Eleveur <br/><br/><br/>
            Login : <input type=text name='login' placeholder='Login'><br/><br/>
            Mot de passe : <input type=password name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
            Nom : <input type=text name='nom' placeholder='Nom'><br/><br/><br/>
            Adresse : <input type=text name='adresse' placeholder='Adresse' size = 100><br/><br/>
            Adresse (suite) : <input type=text name='adresse2' placeholder='Adresse (suite)' size = 100><br/><br/>
            Commune : <input type=text name='commune' placeholder='Commune' size = 75> 
            Code postal : <input type=text name='code_postal' placeholder='Code Postal' size = 20><br/><br/> 
            Département : <input type=text name='departement' placeholder='Département' size = 100><br/><br/><br/> 
            Téléphone : <input type=tel name='telephone' placeholder='Numéro de Téléphone'><br/><br/> 
            Adresse mail : <input type=email name='mail' placeholder='Adresse Mail'><br/><br/><br/>
            <input type="submit" name="bt_submit" value="Valider">
        </form>
		
	</body>
</html>