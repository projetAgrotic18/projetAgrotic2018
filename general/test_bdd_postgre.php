
<?php

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();
$result = $connex->requete("SELECT * FROM communes");

echo pg_num_rows($result)."</br>";
echo pg_num_fields($result);
echo "<table border=1 bordorcolor=black>";
while ($row=pg_fetch_array($result,null,PGSQL_NUM)) {
    echo "<tr>";
    for($i=0; $i<pg_num_fields($result); $i++){
        echo "<td>".$row[$i]."</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "prout" ;

$connex->fermer;
