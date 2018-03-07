<?php
    require "../general/connexionPostgreSQL.class.php";
    // Connexion, sélection de la base de données
    $id_transhumance = $_POST['id_lot_mvt'];
    $date_arrivee = $_POST['date_arrivee'];
    $date_sortie = $_POST['date_sortie'];
    $marque = $_POST['marquage'];
    $nom_respo = $_POST['nom_responsable'];
    $commune = $_POST['commune'];
    $tel_respo =$_POST['num_responsable'];
    $nom_transport =$_POST['nom_transp'];
    $tel_transport =$_POST['tel_transp'];
    $alpage=$_POST['type_paturage1'];
    $nbr_cap_m= $_POST['nbr_cap_-'];
    $nbr_cap_p = $_POST['nbr_cap_+'];
    $nbr_ov_m = $_POST['nbr_ov_-'];
    $nbr_ov_p = $_POST['nbr_ov_+'];
    if (isset($_POST['type_paturage1'])==true)
    {
        $alpage='TRUE';
    }
    else
    {
       $alpage='FALSE';
    }
    // Connexion, sélection de la base de données du projet

    $connex = new connexionPostgreSQL();
    $result1 = $connex->requete("SELECT id_commune FROM commune WHERE nom_commune = '" . $commune . "'");
    while ($line1 = pg_fetch_array($result1, null, PGSQL_ASSOC)) {

        foreach ($line1 as $col_value1) {
            $id_commune = $col_value1;
        }
    }
    $result2 = $connex->requete("SELECT id_compte FROM compte_utilisateur WHERE nom = '" . $nom_respo . "'");
    while ($line2 = pg_fetch_array($result2, null, PGSQL_ASSOC)) {

        foreach ($line2 as $col_value2) {
            $id_compte = $col_value2;
        }
    }
    // Exécution de la requête SQL
    $query3=$connex->requete("INSERT INTO lot_mvt VALUES ('" .$id_transhumance."','".$id_commune."','".$id_compte."','" .$date_arrivee."','".$date_sortie."','".$marque."','".$nom_respo."','" .$tel_respo."','".$nom_transport."','" .$tel_transport."',".$alpage.",'".$nbr_cap_m."','".$nbr_cap_p."','" .$nbr_ov_m. "','" .$nbr_ov_p. "')");
    
    echo "La transhumance a bien été enregistrée";

    // Ferme la connexion
    $connex->fermer();
?>