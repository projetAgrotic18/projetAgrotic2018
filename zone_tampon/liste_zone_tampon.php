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
	$result = $connex->requete("SELECT * FROM zone_tampon");
	
	echo "<table border = 1 bordercolor = black>";
	echo "<tr>";
	for ($i=0 ; $i < pg_num_fields($result) ; $i++){
		echo "<td>";
		echo pg_field_name($result, $i);
		echo "</td>";
	}
	echo "</tr>";
	
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<tr>";
		for ($j=0 ; $j < pg_num_fields($result) ; $j++){
			echo "<td>";
			echo $row[$j];
			echo "</td>";
		}
		echo "</tr>";
	}
        ?>
        
     
            <input type="submit" value="Ajouter une zone tampon" name="Ajouter_zt" />
        </form>
    </body>
</html>
