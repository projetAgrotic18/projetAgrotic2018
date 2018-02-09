
<?php
// Connexion, s�lection de la base de donn�es
$dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
    or die('Connexion impossible : ' . pg_last_error());

// Ex�cution de la requ�te SQL
$query = 'SELECT * FROM comptes_utilisateurs';
$result = pg_query($query) or die('�chec de la requ�te : ' . pg_last_error());

// Affichage des r�sultats en HTML
echo "<table>\n";
while ($line = pg_fetch_array($result)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Lib�re le r�sultat
pg_free_result($result);

// Ferme la connexion
pg_close($dbconn);
?>
