<?php

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();
$result = $connex->requete("SELECT libelle_maladie, id_maladie FROM maladie");

?>
<form>
<select name="liste_maladie"><?php

while ($line = pg_fetch_array($result) ){

  
        
        echo "<option value =".$line[1].">".$line[0]."</option>";
    
}
    
?></select>
</form>