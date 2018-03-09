<?php session_start() ?>
<html>
<head>
    <title>Liste Diagnostic</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!--- Style Sonnaille -->
    <link href="../general/front/style.css" rel="stylesheet">

    <!--Deux lignes de code pour le tableau-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        //Code pour la mise en forme du tableau (voir datatable)
        $(document).ready(function() {
             $('#example').DataTable();
        });
    </script>
</head>
		
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/switchbar.php'); ?>

    <!-- Appelle de la page regroupant les fonctions -->
    <?php require_once('../general/procedures.php'); ?>
    
    <div class="padding">
        <h1> Liste des diagnostics </h1><br/>

        <?php
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();

        //Zones de textes des dates de diagnostic

        echo "<form action='liste_diagnostic.php' method='POST'>";
        if (isset($_POST['date_debut']) and isset($_POST['date_fin'])){
            echo "Pour une période allant du : <input type='date' name='date_debut' value='".$_POST['date_debut']."'>";
            echo "Au : <input type='date' name='date_fin' value='".$_POST['date_fin']."'>";
        }
        else {
            echo "Pour une période allant du : <input type='date' name='date_debut'>";
            echo "Au : <input type='date' name='date_fin'>";
        }
        echo "<input type=submit value='Valider'/>";
        echo "</form>";

        //Si l'utilisateur est une véto on affiche seulement ses diagnostics
        if ($_SESSION['id_type_utilisateur']==1){
            //Si des dates ont été saisies 
            if (isset($_POST['date_debut']) and isset($_POST['date_fin']) and $_POST['date_debut']!='' and $_POST['date_fin']!=''){
                $result_all_compte =  $connex->requete("SELECT ld.id_diagnostic, nom_veterinaire, nom_eleveur, nom_commune, libelle_espece, date_diagnostic FROM liste_diag ld join maladie_diag md on ld.id_diagnostic=md.id_diagnostic join maladie m on md.id_maladie=m.id_maladie
                where id_veto='".$_SESSION['id_compte']."' date_diagnostic between '".$_POST['date_debut']."' and '".$_POST['date_fin']."'");
            }

            //si dates pas saisies
            else{
                $result_all_compte =  $connex->requete("SELECT ld.id_diagnostic, nom_veterinaire, nom_eleveur, nom_commune, libelle_espece, date_diagnostic FROM liste_diag ld join maladie_diag md on ld.id_diagnostic=md.id_diagnostic join maladie m on md.id_maladie=m.id_maladie
                where id_veto='".$_SESSION['id_compte']."'");
            }
        }

        //Sinon (GDS ou admin ou labo) on affiche tout
        else {
            //Si des dates ont été saisies 
            if (isset($_POST['date_debut']) and isset($_POST['date_fin']) and $_POST['date_debut']!='' and $_POST['date_fin']!=''){
                $result_all_compte =  $connex->requete("SELECT ld.id_diagnostic, nom_veterinaire, nom_eleveur, nom_commune, libelle_espece, date_diagnostic FROM liste_diag ld join maladie_diag md on ld.id_diagnostic=md.id_diagnostic join maladie m on md.id_maladie=m.id_maladie
                where date_diagnostic between '".$_POST['date_debut']."' and '".$_POST['date_fin']."'");
            }

            //si dates pas saisies
            else{
                $result_all_compte =  $connex->requete("SELECT ld.id_diagnostic, nom_veterinaire, nom_eleveur, nom_commune, libelle_espece, date_diagnostic FROM liste_diag ld join maladie_diag md on ld.id_diagnostic=md.id_diagnostic join maladie m on md.id_maladie=m.id_maladie");
            }
        }

        $nbr_col = pg_num_fields($result_all_compte);
        ?>
        <br/>
        <TABLE border=1 id="example">
            <THEAD>
                <TR>
                    <TH> Vétérinaire </TH>
                    <TH> Eleveur </TH>
                    <TH> Commune </TH>
                    <TH> Espèce </TH>
                    <TH> Date du diagnostic </TH>
                    <TH> Maladies </TH>
                    <TH></TH>
                </TR>
            </THEAD>
            <TBODY>
                <?php
                while ($row = pg_fetch_array($result_all_compte)){
                    echo "<TR>";
                        // affichage pour chaque diagnostic de ses informations principales
                        for($i = 1; $i < $nbr_col; $i++) {
                            echo "<td>".$row[$i]."</td>";
                        }
                        //Affichage des maladies
                        $id_diagnostic=$row[0];
                        $result_conf=$connex->requete("select libelle_maladie from maladie_diag md join maladie m on md.id_maladie=m.id_maladie where md.id_diagnostic=$id_diagnostic and confirme=true");
                        echo "<td>";
                            //Diagnostiquées
                            if (pg_num_rows($result_conf)==0){
                                $result_diag=$connex->requete("select libelle_maladie from maladie_diag md join maladie m on md.id_maladie=m.id_maladie where md.id_diagnostic=$id_diagnostic and confirme=false");
                                echo "<p>Diagnostiquées :</p>";
                                while ($row = pg_fetch_array($result_diag)){
                                    echo "<p>".$row[0]."</p>";
                                }
                            }
                            //Confirmées
                            else{
                                echo "<b>Confirmées :</b>";
                                while ($row = pg_fetch_array($result_conf)){
                                    echo "<p>".$row[0]."</p>";
                                }
                            }

                        echo "</td>";

                        //Affichage du bouton détail
                        echo "<td><a href = 'consultation_diagnostic.php?id_diagnostic=$id_diagnostic'><button type='button'>Détails</button></a></td>";
                        echo "</TR>";
                }
                ?>
            </TBODY>
        </TABLE>
    </div>

    <!-- Pied de page -->		
    <?php include("../general/front/footer.html"); ?>
</body>
</html>