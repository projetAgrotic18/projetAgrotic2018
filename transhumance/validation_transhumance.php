<?php

// Connexion, s�lection de la base de donn�es
$id_transhumance = $_POST['id_transhumance'];
$date_arrivee = $_POST['date_arrivee'];
$date_sortie = $_POST['date_sortie'];
$marque = $_POST['marquage'];
$nom_respo = $_POST['nom_responsable'];
$commune = $_POST['commune'];
$tel_respo =$_POST['num_responsable'];
$nom_transport =$_POST['nom_transp'];
$tel_transport =$_POST['tel_transp'];

$dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
        or die('Connexion impossible : ' . pg_last_error());
$query2 = "SELECT id_commune FROM communes WHERE libelle = '" . $commune . "'";
$result2 = pg_query($query2) or die('�chec de la requ�te : ' . pg_last_error());
while ($line = pg_fetch_array($result2, null, PGSQL_ASSOC)) {

    foreach ($line as $col_value) {
        $id_commune = $col_value;
    }
}

// Ex�cution de la requ�te SQL
$query = "INSERT INTO  transhumances  VALUES (" .$id_transhumance. ",'" . $date_arrivee . "','" . $date_sortie . "','" . $marque . "','" . $nom_respo . "','" . $tel_respo . "','" . $nom_transport . "','" . $tel_transport . "'," . $id_commune . ")";

$result = pg_query($query) or die('�chec de la requ�te : ' . pg_last_error());
echo "transhumance bien enregistr�e";
// Affichage des r�sultats en HTML
// Lib�re le r�sultat

pg_free_result($result2);

// Ferme la connexion

pg_close($dbconn);
?>