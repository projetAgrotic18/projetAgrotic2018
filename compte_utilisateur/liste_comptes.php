<?php session_start();?>
<html>
<head>
    <title>Liste Compte</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    
    <script>
        function confirm_s(id){
            if(confirm("Voulez vous vraiment supprimer ce compte ?")){
                window.location='liste_comptes.php?id_compte='+id
            }
            else{
                alert("Le compte utilisateur n'a pas été supprimé.")
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
    <!-- Appelle de la page regroupant les fonctions -->
    <?php require_once('../general/procedures.php'); ?>

    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/front/navigation.php');?>
    
    <!--Deux lignes de code pour le tableau-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <div class="padding">
        <h1>Comptes utilisateurs</h1><br>
        <h2>Liste des comptes</h2><br>
        
        <?php 
        // Connexion, sélection de la base de données

        $connex = new connexionPostgreSQL();
        
        //Suppression d'un client
        if (isset($_GET['id_compte'])){
            //Récupération de toutes les info
            $compte=$_GET["id_compte"];

            //Requête
            $result = $connex->requete("DELETE FROM compte_utilisateur WHERE id_compte='$compte'");
            echo "La suppression a bien été prise en en compte. <br/><br/>";
        }

        // Exécution de la requête SQL
        $result = $connex->requete("SELECT cu.id_compte, cu.identifiant, tu.libelle_type_utilisateur FROM type_utilisateur tu JOIN compte_utilisateur cu ON tu.id_type_utilisateur=cu.id_type_utilisateur GROUP BY tu.libelle_type_utilisateur, cu.id_compte ORDER BY tu.libelle_type_utilisateur, cu.identifiant");

        // Affichage des résultats en HTML?>
        <div class='container'>
            <table border=1 id="example">
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Type d'utilisateur</th>
                    <th>Supprimer</th>
                </tr>
                <?php 
                    while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
                        echo "<tr><td>".$row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        echo "<td>".$row[2]."</td>";
                        echo "<td><center><input type='button' onclick=confirm_s($row[0]) value='Supprimer'></button></center></td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    
    <script type="text/javascript">
        //Code pour la mise en forme du tableau (voir datatable)
        $(document).ready(function() {
             $('#example').DataTable();
        });
    </script>
    
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