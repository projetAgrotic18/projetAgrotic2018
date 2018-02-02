<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href="ex2.php">Exo2</a>
		<?php
		$connexion=new PDO("pgsql:host=localhost;port=5433;dbname=postgres","postgres","postgres") or die('Connexion impossible');

		//Pour afficher les erreurs dans le navigateur. Les erreurs de connexion sont aussi répertoriées dans les fichiers logs d'Apache.

		echo $connexion;
		error_reporting(E_ALL);

		?>
    </body>
</html>
