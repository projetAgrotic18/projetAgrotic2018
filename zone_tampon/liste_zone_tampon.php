<?php session_start(); ?>
<html>
<head>
    <META charset="UTF-8"/>
    <title>Liste des zones tampon</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/Front/navigation.php'); ?>
    
    <!--Deux lignes de code pour le tableau-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <div class="padding"> 
        <h1> Liste des zones tampon</h1><br/>

        <?php
            //Connexion à la base de données
            $connex = new connexionPostgreSQL();

            //Récupération de l'id lors de la connexion (page d'accueil)
            $id_type_utilisateur = $_SESSION["id_type_utilisateur"];

            //Bouton ajouter une zone tampon
            if($id_type_utilisateur == 3 or $id_type_utilisateur ==6){ 
                echo "<form action='zone_tampon_front.php' method='POST'><input type='submit' name='bt_submit_ajout' value='Ajouter une zone tampon'/></form>"; 
            }

            //Requête
            $result = $connex->requete("SELECT libelle_maladie,rayon_prot,rayon_surv,date_fin,id_zone_tampon, active FROM zonetampon zt JOIN maladie m on m.id_maladie=zt.id_maladie WHERE active='t'");
        ?>
        <div class="container">
            <TABLE border=1 id="example">
                <THEAD>
                    <TR>
                        <TH>Maladie</TH>
                        <TH>Rayon de protection</TH>
                        <TH>Rayon de Surveillance</TH>
                        <TH>Date de fin</TH>
                        <TH>ID Zone Tampon</TH>
                        <?php
                            if($id_type_utilisateur == 3 or $id_type_utilisateur ==6){
                                echo "<TH></TH>";
                                echo "<TH></TH>";
                            }
                        ?>
                    </TR>
                </THEAD>
                <TBODY>
                    <?php

                    while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
                        echo "<TR>";
                            // affichage pour chaque diagnostic de ses informations principales
                            for($i = 0; $i < 5; $i++) {
                                echo "<TD>".$row[$i]."</TD>";
                            }

                            if($id_type_utilisateur == 3 or $id_type_utilisateur ==6){
                                //Affichage du bouton détail
                                echo "<TD>
                                        <form action='modif_zone_tampon.php?id_zone_tampon=".$row[4]."' method='POST'><input type='submit' name='bt_submit_modif' value='Modifier'/></form>
                                     </TD>";   // envoie vers la fiche récapitulative de la transhumance
                                //Affichage du bouton détail
                                echo "<TD>
                                        <form action='desac_zone_tampon.php?id_zone_tampon=".$row[4]."' method='POST'><input type='submit' name='bt_submit' value='Désactiver la zone'/></form>
                                     </TD>"; 
                            }
                        echo "</TR>";
                    }
                    ?>
                </TBODY>
            </TABLE>
        </div>
        <br/>
    </div>
    <script type="text/javascript">
        //Code pour la mise en forme du tableau (voir datatable)
        $(document).ready(function() {
             $('#example').DataTable();
        });
    </script>
    
    <!-- Pied de page -->		
    <?php include("../general/front/footer.html"); ?> 
</body>
</html>