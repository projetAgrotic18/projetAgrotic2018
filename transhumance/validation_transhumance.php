<?php session_start();?>
<html>
    <head>
        <META charset="UTF-8"/>  
        <title>Validation déclaration de transhumance</title>
    </head>
    <body>
        <?php
        
        //Barre de navigation
        include ("../general/Front/navigation.php");
        
        // Connexion, sélection de la base de données
        $id_transhumance = $_POST['id_lot_mvt'];
        $date_arrivee = $_POST['date_arrivee'];
        $date_sortie = $_POST['date_sortie'];
        $marque = pg_escape_string($_POST['marquage']);
        $prenom_respo = $_POST['prenom_respo'];
        $nom_respo = $_POST['nom_respo'];
        $commune =  pg_escape_string($_POST['commune']);
        $tel_eleveur = $_POST['num_eleveur'];
        $tel_transport = 9999999999;
        $nom_transport = "NA";
        $adresse_transpo ="NA";
        $entreprise_transpo ="NA";
        //Récupération de l'id du compte
        $id_compte = $_SESSION['id_compte'];

        //Vérification des infos transporteur si non vide
        if ($_POST['nom_transp']!="") {
            $nom_transport = $_POST['nom_transp'];
        }
        if ($_POST['tel_transp']!="") {
            $tel_transport = $_POST['tel_transp'];
        }
        if ($_POST['adresse_transp']!=""){
            $adresse_transpo = $_POST['adresse_transp'];
        }
        if ($_POST['entreprise_transp']!=""){
            $entreprise_transpo = $_POST['entreprise_transp'];
        }

        $alpage = $_POST['type_paturage'];

        if ($alpage==1){
            $alpage='TRUE';
        } else {
            $alpage='FALSE';
        }

        $nbr_cap_m = 0;
        $nbr_cap_p = 0;
        $nbr_ov_m = 0;
        $nbr_ov_p = 0;

        if ($_POST['nbr_cap_-']!="") {
            $nbr_cap_m = $_POST['nbr_cap_-'];
        }
        if ($_POST['nbr_cap_+']!="") {
            $nbr_cap_p = $_POST['nbr_cap_+'];
        }
        if ($_POST['nbr_ov_-']!="") {
            $nbr_ov_m = $_POST['nbr_ov_-'];
        }
        if ($_POST['nbr_ov_+']!="") {
            $nbr_ov_p = $_POST['nbr_ov_+'];
        }
        if (isset($_POST['type_paturage1'])==true)
        {
            $alpage='TRUE';
        } else {
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

        // Exécution de la requête SQL pour l'insertion des données dans la bdd
        $query3 = $connex->requete("INSERT INTO lot_mvt (id_lot_mvt, id_commune, id_compte, date_arrivee, date_depart, description_marque, nom_responsable, portable_responsable, nom_transporteur, contact_transporteur, alp_collectif, capr_msm, capr_psm, ov_msm, ov_psm, prenom_responsable, adresse_transporteur, entreprise_transporteur) VALUES ('".$id_transhumance."','" . $id_commune . "','" . $id_compte . "','" . $date_arrivee . "','" . $date_sortie . "','" . $marque . "','" . $nom_respo . "','" . $tel_eleveur . "','" . $nom_transport . "','" . $tel_transport . "'," . $alpage . ",'" . $nbr_cap_m . "','" . $nbr_cap_p . "','" . $nbr_ov_m . "','" . $nbr_ov_p . "','". $prenom_respo ."','". $adresse_transpo ."','". $entreprise_transpo ."')");

        echo "La transhumance a bien été enregistrée.<br/><br/>";
        ?>

        <form action='liste_transhumance.php' method='POST' name='form_liste'>
            <input class="btn bouton-sonnaille bouton-m" type='submit' name='bt_retour' value='Retour'>
        </form> 

        <?php 
        echo "<form action='consultation_transhumance.php?id_lot_mvt=$id_transhumance' method='POST' name='form_consult'>";
        echo "<input type='submit' class='btn bouton-sonnaille bouton-m' name='bt_consult' value='Visualiser'>";
        echo "</form>";
        
        //Pied de page
        include ("../general/Front/footer.html"); 
        ?>         
    </body>
</html>

