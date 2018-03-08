
	function valider(){ 
	var ok =1;
	var msg = "Veuillez saisir les informations suivantes :\n";
		if (document.getElementById('nom').value == "") 	{
			ok = 0;
			msg = msg + "[Nom de l'exploitant]\n";
		}	
		if (document.getElementById('date').value == ""){
			ok = 0;
			msg = msg + "[Date]\n";
		}
		if (document.getElementById('commune').value == ""){
			ok = 0;
			msg = msg + "[Lieu du diagnostic]\n";
		}
		var radiochecked=0;
		var espece=document.getElementsByName('espece');
		for (var i = 0, length = espece.length; i < length; i++){
			if (espece[i].checked){
				radiochecked=1;
				break;
			}
		}
		if (radiochecked==0){
			ok = 0;
			msg = msg + "[Espèce]\n";
		}
		if (ok !=1){
			alert(msg);
			return false;
		}
	}
