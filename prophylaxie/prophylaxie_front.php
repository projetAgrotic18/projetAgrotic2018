<?php session_start() ?>
<html>
    <head>
        <!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">

    <!-- inclusion du style CSS de base -->
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="icon" href="sonnaille.ico">
        <title>Visites de prophylaxie</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <!--Deux lignes de code pour le tableau-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        
        <script type="text/javascript">
            //Code pour la mise en forme du tableau (voir datatable)
            $(document).ready(function () {
                
                $('#proph').DataTable();
            });
        </script>
    </head>
        

    <body>
        <?php include ("../general/switchbar.php"); ?><br><br>

        <script>
            function modifier($i) {
                console.log($('#date_proph' + $i));
                $('#date_proph' + $i).prop('readonly', false);
                $('#remarque' + $i).prop('readonly', false);
                if (document.getElementById("bouton" + $i).value == "enregistrer les modifications") {

                    document.getElementById('form' + $i).submit();
                }
                $('#bouton' + $i).prop('value', "enregistrer les modifications");

            }

        </script>
        <?php
        //connexion à la bdd du projet
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();
        $id = $_SESSION["id_compte"];

        if (isset($_POST['date_proph2'])) {
            $id_compte = $_POST['id_compte_eleveur'];
            $date_visite = $_POST['date_proph2'];
            $remarques = $_POST['remarque2'];
            if ($remarques == NULL) {
                $remarques = "N/A";
            }

            $result = $connex->requete("UPDATE visite_proph SET date_visite='" . $date_visite . "',com_proph='" . $remarques . "' WHERE id_compte='" . $id_compte . "'");
        }

         if (isset($_POST['date_proph'])) {
            $result1 = $connex->requete("SELECT id_visite,id_compte FROM visite_proph ORDER BY id_visite"); //sélectionne le premier id  de transhumance disponible
            $nbre_col = pg_num_fields($result1);
            $id_visite = 1;

            while ($row = pg_fetch_array($result1, null, PGSQL_NUM)) {
                
                if ($id_visite < $row[0]) {
                    break;
                }
                $id_visite++;
            }
            
            pg_result_seek($result1,0);
            $ids_comptes = array();
            while ($row = pg_fetch_array($result1, null, PGSQL_NUM)) {
                
               array_push($ids_comptes,$row[1]);
            }
            
            $date_visite = $_POST['date_proph'];
            $remarques = $_POST['remarque'];
            $id_periode_proph = $_POST['id_periode_proph'];
            if ($remarques == NULL) {
                $remarques = "N/A";
            }
            $id_compte = $_POST['id_compte_eleveur'];
            if (!in_array($id_compte, $ids_comptes)){
            $result = $connex->requete("INSERT INTO visite_proph VALUES ('" . $id_visite . "','" . $id_compte . "','" . $id . "','" . $date_visite . "','" . $remarques . "','" . $id_periode_proph . "')");
            }
        }

            echo "<h1 class='sonnaille_titre'>Liste des prophylaxies</h1><div class='padding'>";

        // Récuperation de la période de prophylaxie la plus récente


        $result1 = $connex->requete("SELECT MAX(id_periode_proph) FROM periode_proph");
        while ($row1 = pg_fetch_array($result1)) {
            $periode_max = $row1[0];
        }

        // 	Liste des éleveurs ayant réalisé la prophylaxie	

        $result2 = $connex->requete("SELECT nom_exploitation, date_visite, com_proph, v.id_compte,c.nom
										FROM compte_utilisateur c 
										LEFT JOIN visite_proph v ON c.id_compte=v.id_compte 
										LEFT JOIN periode_proph p ON p.id_periode_proph=v.id_periode_proph 
										WHERE c.com_id_compte= '" . $id . "' AND p.id_periode_proph=$periode_max");

        $liste_fait = array();
        $liste_fait_nom = array();
        $liste_fait_date = array();
        $liste_fait_com = array();
        $liste_fait_name = array();

        while ($row2 = pg_fetch_array($result2)) {
            array_push($liste_fait, $row2[3]);
            array_push($liste_fait_nom, $row2[0]);
            array_push($liste_fait_date, $row2[1]);
            array_push($liste_fait_com, $row2[2]);
            array_push($liste_fait_name, $row2[4]);
        }

        // Liste complète des éleveurs du veterinaire identifié, concernés par la prophylaxie

        $result3 = $connex->requete("SELECT e.id_compte FROM eleveur_concerne_prophy as e LEFT JOIN compte_utilisateur as c ON e.id_compte = c.id_compte WHERE e.id_periode_proph=$periode_max AND c.com_id_compte= '" . $id . "' ");

        $liste_exp = array();
        while ($row3 = pg_fetch_array($result3)) {
            array_push($liste_exp, $row3[0]);
        }
        // Liste des éleveurs du vétérinaire n'ayant pas encore fait la prophylaxie

        $liste_pas_fait = array_diff($liste_exp, $liste_fait);
        $liste_pas_fait_nom = array();

        // Affichage du tableau

        echo '<table border=1 id="proph">';
        echo "<THEAD>";
        echo "<tr><th>Nom de l'exploitant</th><th>Nom de l'exploitation</th><th>Date de visite</th><th>Commentaires</th><th> </th></tr>";
        echo "</THEAD>";


        foreach ($liste_pas_fait as $value) {
            echo "<TBODY>";
            echo "<tr>";


            $result4 = $connex->requete("SELECT nom_exploitation, nom from compte_utilisateur WHERE id_compte=$value");
            while ($row4 = pg_fetch_array($result4)) {

                echo "<form method='post' action='prophylaxie.php'  >";
                echo "<input type='hidden' name='id_compte_eleveur'  value=$value />";
                echo "<input type='hidden' name='id_periode_proph'  value=$periode_max />";
                echo "<td>" . $row4[1] . "</td><td>" . $row4[0] . "</td><td><input name='date_proph' type='date'></td><td><TEXTAREA name='remarque' placeholder='remarques'></TEXTAREA><Br><br></td><td><input type='submit'   name='bouton' value='enregistrer la visite'></td>";

                echo "</form>";
            }

            echo "</tr>";
        }

        for ($i = 0; $i < count($liste_fait); $i++) {

            echo "<tr>";
            echo "<form method='post' action='prophylaxie.php' id = 'form$i' >";
            echo "<input type='hidden' name='id_compte_eleveur'  value=$liste_fait[$i] >";
           
            echo "<td>". $liste_fait_name[$i] ."</td><td>" . $liste_fait_nom[$i] . "</td><td><input id='date_proph$i' name='date_proph2'  type='date' readonly  value=$liste_fait_date[$i]></td><td><TEXTAREA id='remarque$i' name='remarque2'  readonly>$liste_fait_com[$i]</TEXTAREA></td><td><input type='button' id = 'bouton$i'  value='modifier les informations' onclick = modifier($i)></td>";

            echo "</form>";
            echo "</tr>";
        }

        echo "</TBODY>";
        echo "</table>";
        echo "</div><br><br>";
        ?>
            <?php include ("../general/Front/footer.html"); ?>         
        </body>
</html>