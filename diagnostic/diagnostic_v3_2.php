<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	
	<?php
	if (isset($_GET["nom_exploitant"]) && isset($_GET["commune"]) && isset($_GET["date"]) && isset($_GET["espece"])){
		$_GET["nom_exploitant"]=$nom_exploitant;
		$_GET["commune"]=$commune;
		$_GET["date"]=$date;
		$_GET["espece"]=$espece;
		$_GET["preconisation"]=$preconisation;
		$id_veto = $_SESSION["id_veto"];
		
		// $_GET["symptome"]=$symptome;
		// $_GET["maladie"]=$maladie;
		// $_GET["prelevement"]=$prelevement;
	
		//Connexion
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();	
		
		//id_compte : id du véto : $id_veto
	
		//com_id_compte : id de l'éleveur
		//$com_id_compte;	
		$result= $connex->requete("SELECT compte_utilisateur.id_compte FROM compte_utilisateur WHERE compte_utilisateur.nom='".$nom_exploitant."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$com_id_compte=$row[0];
		}
		
		//id_espece : $espece
		
		//date_diagnostic : $date
		
		//preconisation : $preconisation
		
		$result_id_diag = $connex->("SELECT max(id_diagnostic) FROM diagnostic");
		while ($row = pg_fecth_array($result_id_diag, nulln PGSQL_NUM)) {
			$id_diagnostic = $row[0];
		}
		
		$result= $connex->requete("INSERT INTO diagnostic (id_diagnostic, id_compte, com_id_compte, id_espece, date_diagnostic, preconisation, confirme, comm_labo)
			VALUES ('".$id_diagnostic."', '".$id_veto."', '".$com_id_compte."', '".$espece."', '".$date."', '".$preconisation."', '0', '')");
		
		#ajouter les symptomes
		#$result= $connex->requete("INSERT INTO symp(id_sympt, id_obl, libelle_symptome) VALUES ('5', '1', '".$symptome."');
		#ajouter les maladies
		#$result= $connex->requete("INSERT INTO maladie(id_maladie, id_espece, libelle_maladie, cat_maladie, precautions) VALUES ('5', '".$espece."', '".$maladie."', '1', '');
		#ajouter les prélèvements
		#$result= $connex->requete("INSERT INTO prelev(id_prele, id_doc, id_obl, libelle_prelevement) VALUES ('5', '1', '1', '".$prelevement."');
	
	}
	else{
	
		echo "Rien n'a été ajouté car vous n'avez pas completé certains champs considérés obligatoires. Recommencez";
	}
	
	//Insertion de l'id_compte 
	
	//Insertions des données 
	
	// Insertion symptome 
	// $result= $connex->requete("INSERT INTO symp(libelle_symptome) VALUES('$autre_symptome')";
		
	// Insertion maladie 
	// $result= $connex->requete("INSERT INTO maladie(libelle_maladie) VALUES('$autre_maladie')";	
		
	 //pour le if
	
	?>
	
	</body>
</html>
