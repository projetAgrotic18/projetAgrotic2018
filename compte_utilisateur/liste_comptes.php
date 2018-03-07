<html>
<head>
    <META charset="UTF-8"/>
    <link rel="stylesheet" href='../general/front/style.css'> 
    
    <!--Deux lignes de code pour le tableau-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <script>
        function confirm_s(id){
            if(confirm("Voulez vous vraiment supprimer ce compte ?")){
                window.location='valid_suppr.php?id_compte='+id
            }
            else{
                alert("Le ompte utilisateur n'a pas été supprimé.")
                window.location='liste_comptes.php'
            }
        }
        //Code pour la mise en forme du tableau (voir datatable)
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</head>
<body>
    <!-- Entête -->
    
    <!-- Appelle de la page regroupant les fonctions -->
        <?php require_once('../general/procedures.php'); ?>

    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/switchbar.php'); 
    
    echo "<center><h1>Comptes utilisateurs</h1></center><br><br>";
    echo "<h2>Liste des comptes</h2><br><br>";
        
    // Connexion, sélection de la base de données
        
        require "../general/connexionPostgreSQL.class.php";

        $connex = new connexionPostgreSQL();

    // Exécution de la requête SQL
        
        $result = $connex->requete("SELECT cu.id_compte, cu.identifiant, tu.libelle_type_utilisateur FROM type_utilisateur tu JOIN compte_utilisateur cu ON tu.id_type_utilisateur=cu.id_type_utilisateur GROUP BY tu.libelle_type_utilisateur, cu.id_compte ORDER BY tu.libelle_type_utilisateur, cu.identifiant");
        
    // Affichage des résultats en HTML?>
        <div class='padding'>
            <table border=1 id="example"><tr><th>ID</th><th>Utilisateur</th><th>Type d'utilisateur</th><th></th></tr>
                <?php while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {

                    $id = $row[0];
                    echo "<tr><td>".$row[0]."</td>";
                    echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "<td><img src='suppr.png' alt='supprimer' onclick='confirm_s($id)'/></td></tr>";
                }?>
            </table>
        </div>

    <?php
    // Libère le résultat

        pg_free_result($result);

    // Ferme la connexion

        $connex->fermer();
		
		//<a href='valid_suppr.php?id_compte=".$id."'>
        echo "<br><br><br>";
        include('../general/front/footer.html');?>

    </body>
</html>