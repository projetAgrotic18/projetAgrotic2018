<html>

<head>
	<META charset = "UTF-8">
	<title>USD5</title>
</head>

<body>

	<?php

	$id_diagnostic = $_POST[/*"id diagnostic transmis de la page précédente (liste_diagnostic)"*/]
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	$result = $connex->requete("SELECT s.id_sympt, s.libelle_symptome, p.id_prele, p.libelle_prelevement, a.id_analyse, a.libelle_analyse, c.id_compte, c.nom_exploitation, c.adresse, c.adresse2, co.id_commune, co.nom_commune, d.id_dpt, d.libelle_dep, e.id_espece, e.libelle_espece
				FROM symptome s, prelevement p, analyse a, compte_utilisateur c, commune co, departement d, espece e
				WHERE id_diagnostic = ".$id_diagnostic);

	$row=pg_fetch_array($result,null,PGSQL_NUM);

	echo"<table border=1>";
		$i=0;
		echo"<tr>";
		while($i < pg_num_fields($result)){
			$name=pg_field_name($result,$i) -> name;
			echo "<td>". $name." </td>";
			$i++;
		}
		echo"</tr>";

		while($row=pg_fetch_array($result,null,PGSQL_NUM)){
			$i=0;
			echo "<tr>";
			while ($i < pg_num_fields($result))
			{
				echo"<td> ".$row[$i]." </td>";
				$i++;
			}
			echo"</tr>";
		}
	?>

<form method="POST" action="???">
	<input type="submit" name="submit" value="Retour">
</form>
</table>
</body>
</html>