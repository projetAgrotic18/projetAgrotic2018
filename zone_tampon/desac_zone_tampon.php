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
        <?php
        
        require "../general/connexionPostgreSQL.class.php";
        $idzt=$_GET["id_zone_tampon"];
	$connex = new connexionPostgreSQL();
        $result= $connex->requete("UPDATE zone_tampon SET active='FALSE' WHERE id_zone_tampon=".$idzt); 
       
        ?>
        
       La zone tampon à bien été désactivée!
       <input type="button" action="liste_zone_tampon.php" name="retour" Value="Retour sur les listes des zones tampons">
    </body>
</html>
