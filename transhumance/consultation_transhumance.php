<html>
    <head>
        <title>Consultation Transhumance</title>
         
       
    </head>
    <body>
        <?php
// Connexion, sélection de la base de données

        require "../general/connexionPostgreSQL.class.php";

        $connex = new connexionPostgreSQL();

// Exécution de la requête SQL

		$id_transhumance = $_GET["id_lot_mvt"];
		$id_type_utilisateur = $_GET["type_utilisateur"];
               

// R&cupération des champs correspondant à la transhumance que l'on veut modifier

		$result = $connex->requete("SELECT * FROM lot_mvt lm JOIN commune c ON lm.id_commune = c.id_commune WHERE lm.id_lot_mvt=".$id_transhumance);
		while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
			$date_arrivee = $row[3];
			$date_depart = $row[4];
			$description_marque = $row[5];
			$nom_responsable = $row[6];
			$tel_responsable = $row[7];
			$nom_transporteur = $row[8];
			$contact_transporteur = $row[9];
			$alp_collectif = $row[10];
			$capr_msm = $row[11];
			$capr_psm = $row[12];
			$ov_msm = $row[13];
			$ov_psm = $row[14];
			$prenom_responsable = $row[15];
			$adresse_transporteur = $row[16];
			$entreprise_transporteur = $row[17];
			$commune = $row[20];
		}
	
                
                    
     
        $connex->fermer();
        ?>
       

        <h1 align="center"><b>Votre transhumance :</b></h1>
        <h2>Renseignements responsable alpage</h2>
        <form method="post" action="valid_modif_transhumance.php" name='form' value="" >
            <table border="blue">
            
                <tr>
                    <td><label>Nom</label> :</td>
                    <td> <?php echo "$nom_responsable " ?>
                </tr>
                <tr>
                    <td><label>Prénom</label> :</td>
                    <td><?php echo "$prenom_responsable"?> </td>
                </tr>
                <tr>
                    <td> <label>Numéro de téléphone:</label></td>
                    <td><?php echo "$tel_responsable" ?></td>
                </tr>
            </table>
            <h2>Renseignements généraux</h2>
            Date départ : 
           <?php echo "$date_arrivee"; ?> <br>
            Date fin :
            <?php echo "$date_depart"; ?><br><br>
            <label>Commune de destination :</label>
            <?php echo "$commune"; ?>
       
            <h2>Vos animaux déplacés</h2>
            <table border="blue">
                <tr>
                    <td>

                    </td>
                    <td>
                        Agés de moins de 6 mois
                    </td>
                    <td>
                        Agés de plus de 6 mois
                    </td>

                </tr>
                <tr>
                    <td>
                        Caprins
                    </td>
                    <td>
                        <?php echo "$capr_msm"; ?>
                    </td>
                    <td>
                       <?php echo "$capr_psm"; ?>
                    </td>

                </tr>
                <tr>
                    <td>
                        Ovins
                    </td>
                    <td>
                       <?php echo "$ov_msm"; ?>
                    </td>
                    <td>
                       <?php echo "$ov_psm"; ?>
                    </td>


                </tr>
            </table><br>
            Description du marquage :<br>
            <?php echo "$description_marque"; ?><Br><br>
           <?php 
           if($alp_collectif=='t'){
               echo "Type d'Alpage/Pâturage:  collectif";
           } else {
             echo "Type d'Alpage/Pâturage:   individuel";
           }
           ?>     <br>
            <h2>Transporteur</h2>
            <table border="blue">
                <tr>
                    <td>
                        <label>Nom :</label>
                    </td>
                    <td>
                        <?php echo "$nom_transporteur"; ?>
                    </td>
                    <td>
                        <label>Adresse</label>
                    </td>
                    <td>
                       <?php echo "$adresse_transporteur"; ?>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <label>Nom de l'entreprise</label>
                    </td>
                    <td>
                      <?php echo "$entreprise_transporteur"; ?>
                    </td>
                    <td>
                        <label>Téléphone</label>
                    </td>
                    <td>
                       <?php echo "$contact_transporteur" ?>
                    </td>                  
                </tr>
                
            </table>
            <br>
            
            
        </form>
		<form action='liste_transhumance.php' method='POST' name='form_liste'>
			<input type='submit' name='bt_retour' value='Retour'>
		</form> 
		<?php	
			if($id_type_utilisateur == 2){
				echo "<form action='modif_transhumance.php?id_lot_mvt=".$id_transhumance."'  method='POST' name='form_consult'>
				<input type='submit'   name='bouton' value='modifier'>
				</form>";
			}
		?>
    </body>
</html>