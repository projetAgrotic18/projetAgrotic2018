function valid_compte_utilisateur()
	{
		var ok=1;
		var msg="";
		if (document.saisie.rb.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir un type d'utilisateur\n";
					
		}
		if (document.saisie.login.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir le login du compte\n";
		}
		if (document.saisie.mot_de_passe.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir le mot de passe\n";
		}
		if (document.saisie.nom.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir le nom du compte\n";
		}
		if (document.saisie.adresse.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir l'adresse du compte\n";
		}
		if (document.saisie.commu.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir la commune du compte\n";
		}
		if (document.saisie.code_postal.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir le code postal\n";
		}
		if (document.saisie.telephone.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir le numéro de téléphone associé au compte\n";
		}
		if (document.saisie.mail.value=="")
		{
			ok = 0;
			msg = msg + "Veuillez saisir l'adresse mail du compte\n";
		}					
		if(ok == 1)
		{
			return true;
		}
				
		else
		{
			alert(msg);
			return false;
		}
	}