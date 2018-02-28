<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	
	<?php
	//Vérification PHP
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
		
		//Connexion
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();	
		
		//PREPARATION DE LA REQUETE
		//id_diagnostic : 
		$result_id_diag = $connex->requete("SELECT max(id_diagnostic) FROM diagnostic");
		while ($row = pg_fetch_array($result_id_diag, null, PGSQL_NUM)) {
			$id_diagnostic = $row[0];
		}
		
		$id_diagnostic = $id_diagnostic +1;
		
		//id_compte : id du véto : $id_veto
	
		//com_id_compte : id de l'éleveur
		$result= $connex->requete("SELECT compte_utilisateur.id_compte FROM compte_utilisateur WHERE compte_utilisateur.nom='".$nom_exploitant."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$com_id_compte=$row[0];
		}
		
		//id_espece : simplement le $espece
		
		//date_diagnostic : simplement le $date
		
		//preconisation : simplement le $preconisation
                
        //id_commune : requête pour récupérer l'id à partir du nom $commune
		$result=$connex->requete("SELECT id_commune from commune where nom_commune='".$commune."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$id_commune=$row[0];
		}
		
		//INSERTION DANS LA TABLE DIAGNOSTIC : 
		$result= $connex->requete("INSERT INTO diagnostic (id_diagnostic, id_compte, com_id_compte, id_espece, date_diagnostic, preconisation, confirme, comm_labo, id_commune)
			VALUES ('".$id_diagnostic."', '".$id_veto."', '".$com_id_compte."', '".$espece."', '".$date."', '".$preconisation."', '0', '', '".$id_commune."')");
		
		//INSERTION DANS LES AUTRES TABLES : 
		//symptomes : $SESSION["insertion_symptomes"]
		
		$insertion_symptomes=$_SESSION["choix_symptomes"];
		for ($i=0; $i<count($insertion_symptomes); $i++){
			$result= $connex->requete("INSERT INTO symptdiag (id_sympt, id_diagnostic) VALUES ('".$insertion_symptomes[$i]."','".$id_diagnostic."')");
		}
		
		//maladies : $SESSION["insertion_maladies"]
		$insertion_maladies=$_SESSION["choix_maladies"];
		for ($i=0; $i<count($insertion_maladies); $i++){
			$result= $connex->requete("INSERT INTO maladie_diag (id_maladie, id_diagnostic) VALUES ('".$insertion_maladies[$i]."','".$id_diagnostic."')");
		}
		
		//prelevements : $SESSION["insertion_prelevements"]
		$insertion_prelevements=$_SESSION["choix_prelevements"];
		for ($i=0; $i<count($insertion_prelevements); $i++){
			$result= $connex->requete("INSERT INTO prelevement_diag (id_prele, id_diagnostic) VALUES ('".$insertion_prelevements[$i]."','".$id_diagnostic."')");
		}
		
		//analyses : $analyse
		for ($i=0; $i<count($analyse); $i++){
			$result= $connex->requete("INSERT INTO analyses_diag (id_analyse, id_diagnostic) VALUES ('".$analyse[$i]."','".$id_diagnostic."')");
		}
	}else{
		echo "Rien n'a été ajouté à notre base de données, car vous n'avez pas completé certains champs considérés obligatoires. Recommencez";
	}
		
	?>
	</body>
</html>
