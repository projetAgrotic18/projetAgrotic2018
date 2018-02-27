<html>


    <title>Déclaration de transhumance</title>
    <!-- inclusion du style CSS de base -->
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />

    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<body>
    <?php
    require "../general/connexionPostgreSQL.class.php";
    // Connexion, sélection de la base de données du projet

    $connex = new connexionPostgreSQL();


    // Exécution de la requête SQL

    $result1 = $connex->requete("SELECT id_lot_mvt FROM lot_mvt ORDER BY id_lot_mvt"); //sélectionne le premier id  de transhumance disponible
    $nbre_col = pg_num_fields($result1);
    $id = 1;

    while ($row = pg_fetch_array($result1)) {
          
        if ($id < $row[0]) {
            break;
        }
        $id++;
    }

    echo $id;


