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
            <INPUT type = radio name = rb value = 'ddpp' >DDPP 
            <INPUT type = radio name = rb value = 'gds'>GDS 
            <INPUT type = radio name = rb value = 'veto'>Vétérinaire / GTV 
            <INPUT type = radio name = rb value = 'labo'>Laboratoire 
            <INPUT type = radio name = rb value = 'eleveur'>Eleveur <br/>
            Identifiant : <input type=text name='identifiant' placeholder='Identifiant'><br/><br/> 
            Mot de passe : <input type=text name='mot_de_passe' placeholder='Mot de Passe'><br/><br/><br/>
            Nom : <input type=text name='nom' placeholder='Nom Prénom'><br/><br/><br/>
            Adresse : <input type=text name='adresse' placeholder='Adresse' size = 100><br/><br/> 
            Commune : <input type=text name='commune' placeholder='Commune' size = 75> 
            Code postal : <input type=text name='code_postal' placeholder='Code Postal' size = 20><br/><br/> 
            Département : <input type=text name='departement' placeholder='Département' size = 100><br/><br/><br/> 
            Téléphone : <input type=tel name='telephone' placeholder='Numéro de Téléphone'><br/><br/> 
            Adresse mail : <input type=email name='mail' placeholder='Adresse Mail'><br/><br/><br/>
            <input type="submit" name="bt_submit" value="Valider">
        </form>
		
	</body>
</html>