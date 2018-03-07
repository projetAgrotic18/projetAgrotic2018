<!DOCTYPE html>
<?php
session_start(); 
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form method="post" action="zone_tampon_front.php" name='creerzt'> 
        <?php
			require "../general/connexionPostgreSQL.class.php";
			$connex = new connexionPostgreSQL();
	
			//Récupération de l'id lors de la connexion (page d'accueil)
			$id_type_utilisateur = $_SESSION["id_type_utilisateur"];
			$result = $connex->requete("SELECT libelle_maladie,rayon_prot,rayon_surv,id_zone_tampon,active FROM zone_tampon zt JOIN maladie m on m.id_maladie=zt.id_maladie WHERE active='t'");
	      
		    if($id_type_utilisateur == 3 or $id_type_utilisateur ==6){
				echo "<table border = 1 bordercolor = black>";
				echo "<tr>";
	
				echo "<th>";
				echo "Maladie";
				echo "</th>";
				echo "<th>";
				echo "Rayon de protection";
				echo "</th>";
				echo "<th>";
				echo "Rayon de Surveillance";
				echo "</th>";
				echo "</tr>";
            
       
        
				while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
					echo "<tr>";
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[2]."</td>";
					echo "<td><form action='modif_zone_tampon.php?id_zone_tampon=".$row[3]."' method='POST'><input type='submit' name='bt_submit_modif' value='Modifier'/></form></td>";
					echo "<td><form action='desac_zone_tampon.php?id_zone_tampon=".$row[3]."' method='POST'><input type='submit' name='bt_submit' value='Désactiver la zone'/></form></td>";
					echo "</tr>";
				}
				echo "<input type='submit' value='Ajouter une zone tampon' name='Ajouter_zt' />";
			}
			else{
				echo "Vous n'avez pas les droits pour accéder à cette page";
			}
		?>
			
        </form>
    </body>
</html>
