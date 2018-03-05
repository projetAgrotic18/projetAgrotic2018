<?php
	$titre=$_GET['titre_notif'];
	$texte=$_GET['message'];
	
require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();
$last_notif_id_req= $connex->requete('SELECT MAX(id_notification) as max_id FROM notification');
$row=pg_fetch_array($last_notif_id_req,null,PGSQL_NUM);

//on recupere l'id max des notifications
$last_id=$row[0]+1;
echo 'max_id+1: ' . $last_id;

//ajout de la notification en premier pour respecter la contrainte de clé éétrangère
$connex->requete("INSERT INTO notification VALUES (" . $last_id . ", CURRENT_DATE, '" .  $titre . "', FALSE, '" . $texte . "')");

//ajout du lien avec le compte
$result = $connex->requete("INSERT INTO notification_compte VALUES (" . $last_id . ",7)");

$connex->fermer();

?>
