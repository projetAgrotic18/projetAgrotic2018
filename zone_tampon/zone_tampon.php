<?php
$dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
        or die('Connexion impossible : ' . pg_last_error());

$query = "SELECT libelle_maladie, id_maladie FROM maladie";
$result =  pg_query($query) or die('Échec de la requête : ' . pg_last_error());
?>
<form>
<select name="liste_maladie"><?php
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {

    foreach ($line as $col_value) {
        echo "<option value =".$col_value[1].">".$col_value[0]."</option>";
    }
}
    
?></select>
</form>