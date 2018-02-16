<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	Votre diagnostic a bien été ajouté. <br>
	
	<?php
	if (isset($_GET["nom_exploitant"]) && isset($_GET["nom_exploitation"]) && isset($_GET["commune"]) && isset($_GET["date"]) && isset($_GET["espece"])){
		
	//Lien avec l'éleveur
	$result= $connex->requete("SELECT compte_utilisateur.id_compte FROM compte_utilisateur JOIN diagnostic ON compte_utilisateur.id_compte=diagnostic.id_compte 
								WHERE compte_utilisateur.nom='".$_GET["nom_exploitant"]."' AND compte_utilisateur.id_type_utilisateur='7'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0];
	}
	
	
	
	//Insertion de l'id_compte 
	
	//Insertions des données 
	
	// Insertion symptome 
	// $result= $connex->requete("INSERT INTO symp(id_sympt, id_obl, libelle_symptome) VALUES('', '', '$autre_symptome')";
		
	// Insertion maladie 
	// $result= $connex->requete("INSERT INTO maladie(id_maladie, id_espece, libelle_maladie, cat_maladie, precautions) VALUES('', '', '$autre_maladie', '', '')";	
		
	} //pour le if
	
	?>
	
	
	</body>
</html>
