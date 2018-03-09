<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	
	<?php
	//Vérification PHP
	if (!empty($_GET["nom"]) && !empty($_GET["commune"]) && !empty($_GET["date"]) && !empty($_GET["espece"])){
		
		echo "Votre diagnostic a bien été ajouté à notre base de données";
		
		$nom = $_GET["nom"];
		//Gestion des apostrophes éventuelles avec la fonction pg_escape_string 
		$nom = pg_escape_string( $nom ); 
		$commune = $_GET["commune"];
		//Gestion des apostrophes éventuelles avec la fonction pg_escape_string 
		$commune = pg_escape_string( $commune ); 
		$date = $_GET["date"];
		$espece = $_GET["espece"];
		$preconisation = $_GET["preconisation"];
		$id_veto = $_SESSION["id_veto"];
		$symptome=$_GET["symptome"];
		$maladie=$_GET["maladie"];
		$prelevement=$_GET["prelevement"];
		$analyse=$_GET["analyse"];
		$nom_labo=$_GET["labo_ch"];
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
		
		//ATTENTION : DANS diagnostic, id_compte EST TOUJOURS CELUI DE L ELEVEUR
	
		//id_compte : id de l'éleveur
		$result= $connex->requete("SELECT compte_utilisateur.id_compte FROM compte_utilisateur WHERE compte_utilisateur.nom='".$nom."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$id_eleveur=$row[0];
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
		$result= $connex->requete("INSERT INTO diagnostic (id_diagnostic, id_compte, com_id_compte, id_espece, date_diagnostic, preconisation, confirme, comm_labo, id_commune,nom_labo)
			VALUES ('".$id_diagnostic."','".$id_eleveur."', '".$id_veto."', '".$espece."', '".$date."', '".$preconisation."', '0', '', '".$id_commune."','".$nom_labo."')");
	
		//INSERTION DANS LES AUTRES TABLES : 
		//symptomes : $SESSION["insertion_symptomes"]
		
		$insertion_symptomes=$_SESSION["choix_symptomes"];
		for ($i=0; $i<count($insertion_symptomes); $i++){
			$result= $connex->requete("INSERT INTO symptdiag (id_sympt, id_diagnostic) VALUES ('".$insertion_symptomes[$i]."','".$id_diagnostic."')");
		}
		
		//maladies : $SESSION["insertion_maladies"]
		// A MODIFIER : confirme_maladie ! de base à 0
		$insertion_maladies=$_SESSION["choix_maladies"];
		for ($i=0; $i<count($insertion_maladies); $i++){
			$result= $connex->requete("INSERT INTO maladie_diag (id_maladie, id_diagnostic, confirme) VALUES ('".$insertion_maladies[$i]."','".$id_diagnostic."', FALSE)");
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
		echo "<form action='diagnostic.php'><input type='submit' value='Nouveau diagnostic'></form>";
	}
		
	?>
        <form action="liste_diagnostic.php" name="btn_liste">
            <input type="submit" name="goliste" value="Consulter la liste des Diagnostics effectue"/>
        </form>
        
	</body>
</html>
