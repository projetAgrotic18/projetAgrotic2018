<!DOCTYPE html>
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
        
           <form method="post" action="zone_tampon.php" name='creerzt'> 
        <?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	$result = $connex->requete("SELECT libelle_maladie,rayon_prot,rayon_surv,id_zone_tampon,active FROM zone_tampon zt JOIN maladie m on m.id_maladie=zt.id_maladie where active='t'");
	      
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
                 echo "<td><a href='modif_zone_tampon.php?id_zone_tampon=".$row[3]."'>Modifier</a></td>";
                   echo "<td><a href='desac_zone_tampon.php?id_zone_tampon=".$row[3]."'>Désactiver la zone</a></td>";
		echo "</tr>";
	}
        ?>
        
     
            <input type="submit" value="Ajouter une zone tampon" name="Ajouter_zt" />
        </form>
    </body>
</html>
