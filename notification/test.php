<?php
require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();
$req='SELECT * FROM type_utilisateur';
$res=$connex->requete($req);
while($row=pg_fetch_array($res)){
echo 'id: ' . $row[0] . ' type: ' . $row[1];
}
?>
