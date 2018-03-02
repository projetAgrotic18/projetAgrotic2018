<?php session_start();?>
<html>
<head>
    <META charset="UTF-8">
    <title>Accueil</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
    <link rel="stylesheet" href='../general/front/style.css'>
    <style>
        .box {
            display: inline-block;
            width: 20%;
            height: 100px;
            margin: 1em; 
            background-color: aquamarine;
        }
    </style>
</head>
<body> 
    <?php
        //Ajout mise en page
        include('../general/front/navigation.html');

        //Récupération des infos page précédente
        $id_compte=$_SESSION["id_compte"];
        $type=$_SESSION["id_type_utilisateur"];

        // tableau de vérification de la requête
        /*echo "<table border=1 bordorcolor=black>";
        while ($row=pg_fetch_array($result,null,PGSQL_NUM)) {
            echo "<th>";
            for($i=1; $i<pg_num_fields($result); $i++){
                echo "<td>";
                echo pg_field_name($result, $i)."</td>";  
            }
            echo "</th>";
            echo "<tr>";
            for($i=0; $i<pg_num_fields($result); $i++){
                echo "<td>".$row[$i]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";*/


        echo "<center><h1>Bienvenue sur le site</h1></center><br><br>";
        echo "<h2>Page d'accueil</h2>";


    //Gestion des modules par type d'utilisateur
    //Pour chaqsue module, on crée un tableau qui stocke les id des types d'utilisateur ayant accès à un module
    //Si l'id du type de compte connecté a l'accès à la rubrique, alors le module d'accès est visible

    //Module saisie transhumance (éleveur seulement)
        $tab_saisi_trans=array(2,6);
        if (in_array($type,$tab_saisi_trans)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../transhumance/transhumance_front.php'>Déclarer une tranhumance</a>";
            echo "</div>";
        }

    //Module Liste transhumance (eleveur, GDS)
        $tab_liste_trans=array(2,3,6);
        if (in_array($type,$tab_liste_trans)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../transhumance/liste_transhumance.php'>Liste des transhumances</a>";
            echo "</div>";
        }

    //Module saisie diagnostic (véto seulement)
        $tab_saisi_diag=array(1,6);
        if (in_array($type,$tab_saisi_diag)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../diagnostic/diagnostic_v1.php'>Saisir un diagnostic</a>";
            echo "</div>";
        }

    //Module saisie prophylaxie (véto seulement)
        $tab_saisi_pro=array(1,6);
        if (in_array($type,$tab_saisi_pro)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../prophylaxie/prophylaxie.php'>Saisir une prophylaxie</a>";
            echo "</div>";
        }

    //Module Liste diagnostics (Véto, GDS)
        $tab_liste_diag=array(1,3,6);
        if (in_array($type,$tab_liste_diag)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../diagnostic/liste_diagnostic.php'>Liste des diagnostics</a>";
            echo "</div>";
        }

    //Module saisie zone tampon (GDS)
        $tab_saisi_ZT=array(3,6);
        if (in_array($type,$tab_saisi_ZT)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../zone_tampon/zone_tampon.php'>Ajouter une zone tampon</a>";
            echo "</div>";
        } 

    //Module ajout doc
        $tab_ajout_doc=array(6);
        if (in_array($type,$tab_ajout_doc)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../documents/document.php'>Ajouter un document</a>";
            echo "</div>";
        } 

    //Module saisie compte utilisateur
        $tab_saisi_compte=array(6);
        if (in_array($type,$tab_saisi_compte)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../compte_utilisateur/compte_utilisateur.php'>Ajouter un compte utilisateur</a>";
            echo "</div>";
        } 

    //Module liste comptes utilisateur
        $tab_liste_compte=array(6);
        if (in_array($type,$tab_liste_compte)){    
            echo "<div class='box'>";
                echo "<p>image</p>";
                echo "<a href='../compte_utilisateur/liste_comptes.php'>Liste des comptes utilisateurs</a>";
            echo "</div>";
        }             
        ?>


        <div class='box'>
            <p>image</p>
            <a href='../carte/test1.php'>Carte des zones tampons</a>
        </div>

        <div class='box'>
            <p>image</p>
            <a href='../communication/annuaire.php'>Annuaire</a>
        </div>

        <div class='box'>
            <p>image</p>
            <a href='../zone_tampon/liste_zone_tampon.php'>Liste des zones tampons</a>
        </div>

        <div class='box'>
            <p>image</p>
            <p href='../documents/liste_documents.php'>Documents</p>
        </div>

    <button onclick="self.location.href='Connexion.php'">Retour</button>

    <?php //Ajout mise en page
    include('../general/front/footer.html');?>
</body>
</html>