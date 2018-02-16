<html>
	<head>
		<META charset="UTF-8">
		<title> Liste Diagnostic USD3 </title>
	</head>
		
	<body>
		<b> Tableau des diagnostics : </b><br/>
		
		<?php
		
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();
		$result = $connex->requete("SELECT * FROM diagnostic");
		
		$result = $connex->requete("SELECT * from liste_diag");

		//Code de Pierre
		
		echo "<table border=1 bordorcolor=black>";
		while ($row=pg_fetch_array($result,null,PGSQL_NUM)) {
			echo "<tr>";
			for($i=0; $i<pg_num_fields($result); $i++){
				echo "<td>".$row[$i]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		
		
		/* Code de Martin et Laure mis en comm' par Pierre
		
		echo "<table border=1>" ;
		
		$i=0 ;
		echo "<tr>" ;
		while ($i < mysqli_num_fields($result)){
			echo "<td>" . mysqli_fetch_field_direct($result,$i)->name . "</td>" ;
			$i++;
			}
		echo "</tr>" ;
		
		while ($row = mysqli_fetch_array($result)){
			$i = 0 ;
			echo "<tr>" ;
			while ($i < mysqli_num_fields($result)){
				echo "<td>" .$row[$i]." </td>" ;
				$i++;
			}
			echo "</tr>" ;
		}
		
		echo "</table>" ;
		
		
		
		mysqli_free_result($result);
		mysqli_close($link);		
		*/
		
		$connex->fermer();
		?>
				
		</body>
</html>