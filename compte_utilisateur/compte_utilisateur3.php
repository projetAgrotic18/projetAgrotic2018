<html>
	<head>
	</head>
	<body>
		<?php
			$type_animal = $_GET["porygon2"];
			
			if ($type_animal == "ovins"){
				echo "<input type=text name='nb_ovins' placeholder=".'"Nombre '."d'Ovins".'" size = 20><br/><br/>
				<input type=submit name="sub" value="valider"><br/><br/>
				</form>';
			}
			if ($type_animal == "bovins"){
				echo "<input type=text name='nb_bovins' placeholder='Nombre de Bovins' size = 20><br/><br/>
				<input type=submit name='sub' value='valider'><br/><br/>
				</form>";
			}
			if ($type_animal == "caprins"){
				echo "<input type=text name='nb_caprins' placeholder='Nombre de Caprins' size = 20><br/><br/>
				<input type=submit name='sub' value='valider'><br/><br/>
				</form>";
			}
		?>
	</body>
</html>