<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	
	<?php
<<<<<<< HEAD
	if (isset($_GET["nom_exploitant"]) && isset($_GET["commune"]) && isset($_GET["date"]) && isset($_GET["espece"])){
		
		echo "Votre diagnostic a bien été ajouté à notre base de données";
		
		$nom_exploitant = $_GET["nom_exploitant"];
		$commune = $_GET["commune"];
		$date = $_GET["date"];
		$espece = $_GET["espece"];
		$preconisation = $_GET["preconisation"];
		$id_veto = $_SESSION["id_veto"];
		$symptome=$_GET["symptome"];
		$maladie=$_GET["maladie"];
		$prelevement=$_GET["prelevement"];
		$analyse=$_GET["analyse"];
		
		
=======
	
	if (isset($_GET["nom_exploitant"]) && isset($_GET["commune"]) && isset($_GET["date"]) && isset($_GET["espece"])){
>>>>>>> test
		//Connexion
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();	
		
<<<<<<< HEAD
		//id_compte : id du véto : $id_veto
	
		//com_id_compte : id de l'éleveur
		//$com_id_compte;	
		$result= $connex->requete("SELECT compte_utilisateur.id_compte FROM compte_utilisateur WHERE compte_utilisateur.nom='".$nom_exploitant."'");
=======
		//id_compte : id du véto
		//fichier start
	
		//com_id_compte : id de l'éleveur
		$com_id_compte;	
		$result= $connex->requete("SELECT compte_utilisateur.id_compte FROM compte_utilisateur WHERE compte_utilisateur.nom='".$_GET["nom_exploitant"]."' AND compte_utilisateur.id_type_utilisateur='9'");
>>>>>>> test
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$com_id_compte=$row[0];
		}
		
<<<<<<< HEAD
		//id_espece : $espece
		
		//date_diagnostic : $date
		
		//preconisation : $preconisation
		
		$result_id_diag = $connex->requete("SELECT max(id_diagnostic) FROM diagnostic");
		while ($row = pg_fetch_array($result_id_diag, null, PGSQL_NUM)) {
			$id_diagnostic = $row[0];
		}
		
		$id_diagnostic = $id_diagnostic +1;
		
		$result= $connex->requete("INSERT INTO diagnostic (id_diagnostic, id_compte, com_id_compte, id_espece, date_diagnostic, preconisation, confirme, comm_labo, id_commune)
			VALUES ('".$id_diagnostic."', '".$id_veto."', '".$com_id_compte."', '".$espece."', '".$date."', '".$preconisation."', '0', '', '".$commune."')");
		
		//symptomes
		for ($i=0; $i<count($symptome); $i++){
			$result= $connex->requete("INSERT INTO symptdiag (id_sympt, id_diagnostic) VALUES ('".$symptome[$i]."','".$id_diagnostic."')");
		}
=======
		//id_espece : $_GET["espece"]
		
		//date_diagnostic : $_GET["date"]
		
		//preconisation : $_GET["preconisation"]
>>>>>>> test
		
		//maladies
		for ($i=0; $i<count($maladie); $i++){
			$result= $connex->requete("INSERT INTO maladie_diag (id_maladie, id_diagnostic) VALUES ('".$maladie[$i]."','".$id_diagnostic."')");
		}
		
		//prelevements
		for ($i=0; $i<count($prelevement); $i++){
			$result= $connex->requete("INSERT INTO prelevement_diag (id_prele, id_diagnostic) VALUES ('".$prelevement[$i]."','".$id_diagnostic."')");
		}
		
<<<<<<< HEAD
		//analyses
		for ($i=0; $i<count($analyse); $i++){
			$result= $connex->requete("INSERT INTO analyses_diag (id_analyse, id_diagnostic) VALUES ('".$analyse[$i]."','".$id_diagnostic."')");
		}
=======
		$result= $connex->requete("INSERT INTO diagnostic(id_compte, com_id_compte, id_espece, date_diagnostic, preconisation, confirme, comm_lab) VALUES ('7', '".$com_id_compte."', '".$_GET["espece"]."', '".$_GET["date"]."', '".$_GET["preconisation"]."', '1', '".$_GET["commentaire_labo"]."'");
>>>>>>> test
	}
	else{
		echo "Rien n'a été ajouté à notre base de données, car vous n'avez pas completé certains champs considérés obligatoires. Recommencez";
	}
		
	?>
	
	</body>
</html>
