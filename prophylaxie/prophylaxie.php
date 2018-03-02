<?php session_start() ?>
<html>
    <head>
        <title>Visites de prophylaxie</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    </head>

    <body>
        <script>
            function modifier($i) {
                console.log($('#date_proph' + $i));
                $('#date_proph' + $i).prop('readonly', false);
                $('#remarque' + $i).prop('readonly', false);
                if (document.getElementById("bouton" + $i).value == "enregistrer les modifications") {
                    $('#bouton' + $i).prop('type', "submit");
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
            echo $id_compte;
            echo $date_visite;
            echo $remarques;
//            $result = $connex->requete("INSERT INTO table (date_visite,) VALUES ('" . $date_visite . "','" . $remarques . "') WHERE id_compte_eleveur = $id_compte");
        }

        if (isset($_POST['date_proph'])) {
            $result1 = $connex->requete("SELECT id_visite FROM visite_proph ORDER BY id_visite"); //sélectionne le premier id  de transhumance disponible
            $nbre_col = pg_num_fields($result1);
            $id_visite = 1;

            while ($row = pg_fetch_array($result1, null, PGSQL_NUM)) {

                if ($id_visite < $row[0]) {
                    break;
                }
                $id_visite++;
            }
            $date_visite = $_POST['date_proph'];
            $remarques = $_POST['remarque'];
            $id_periode_proph = $_POST['id_periode_proph'];
            if ($remarques == NULL) {
                $remarques = "N/A";
            }
            $id_compte = $_POST['id_compte_eleveur'];
            $result = $connex->requete("INSERT INTO visite_proph VALUES ('" . $id_visite . "','" . $id_compte . "','" . $id . "','" . $date_visite . "','" . $remarques . "','" . $id_periode_proph . "')");
        }



        // Récuperation de la période de prophylaxie la plus récente


        $result1 = $connex->requete("SELECT MAX(id_periode_proph) FROM periode_proph");
        while ($row1 = pg_fetch_array($result1)) {
            $periode_max = $row1[0];
        }

        // 	Liste des éleveurs ayant réalisé la prophylaxie	

        $result2 = $connex->requete("SELECT nom_exploitation, date_visite, com_proph, v.id_compte
										FROM compte_utilisateur c 
										LEFT JOIN visite_proph v ON c.id_compte=v.id_compte 
										LEFT JOIN periode_proph p ON p.id_periode_proph=v.id_periode_proph 
										WHERE c.com_id_compte= '" . $id . "' AND p.id_periode_proph=$periode_max");

        $liste_fait = array();
        $liste_fait_nom = array();
        $liste_fait_date = array();
        $liste_fait_com = array();

        while ($row2 = pg_fetch_array($result2)) {
            array_push($liste_fait, $row2[3]);
            array_push($liste_fait_nom, $row2[0]);
            array_push($liste_fait_date, $row2[1]);
            array_push($liste_fait_com, $row2[2]);
        }

        // Liste complète des éleveurs du veterinaire identifié, concernés par la prophylaxie

        $result3 = $connex->requete("SELECT id_compte from eleveur_concerne_prophy WHERE id_periode_proph=$periode_max");

        $liste_exp = array();
        while ($row3 = pg_fetch_array($result3)) {
            array_push($liste_exp, $row3[0]);
        }
        // Liste des éleveurs du vétérinaire n'ayant pas encore fait la prophylaxie

        $liste_pas_fait = array_diff($liste_exp, $liste_fait);
        $liste_pas_fait_nom = array();

        // Affichage du tableau

        echo "<table border=1 bordorcolor=black><tr><th>Nom de l'exploitation</th><th>Date de visite</th><th>Commentaires</th></tr>";


        foreach ($liste_pas_fait as $value) {
            echo "<tr>";


            $result4 = $connex->requete("SELECT nom_exploitation from compte_utilisateur WHERE id_compte=$value");
            while ($row4 = pg_fetch_array($result4)) {

                echo "<form method='post' action='prophylaxie.php'  >";
                echo "<input type='hidden' name='id_compte_eleveur'  value=$value />";
                echo "<input type='hidden' name='id_periode_proph'  value=$periode_max />";
                echo "<td>" . $row4[0] . "</td><td><input name='date_proph' type='date'></td><td><TEXTAREA name='remarque' placeholder='remarques'></TEXTAREA><Br><br></td><td><input type='submit'   name='bouton' value='enregistrer la visite'></td>";

                echo "</form>";
            }

            echo "</tr>";
        }

        for ($i = 0; $i < count($liste_fait); $i++) {
            echo "<form method='post' action='prophylaxie.php'  >";
            echo "<tr>";
            echo "<input type='hidden' name='id_compte_eleveur'  value=$liste_fait[$i] />";

            echo "<td>" . $liste_fait_nom[$i] . "</td><td><input id='date_proph$i' name='date_proph2'  type='date' readonly  value=$liste_fait_date[$i]></td><td><TEXTAREA id='remarque$i' name='remarque2'  readonly>$liste_fait_com[$i]</TEXTAREA></td><td><input type='button' id = 'bouton$i'  value='modifier les informations' onclick = modifier($i)></td>";
            echo "</tr>";
            echo "</form>";
        }

        echo "</table>";
        ?>