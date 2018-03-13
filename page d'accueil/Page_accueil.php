<?php session_start();?>
<html>
<head>
    <META charset="UTF-8" />
    <title>Accueil</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
</head>
    
<body> 
    
    <?php
        //Barre de navigation en fonction de l'utilisateur
        include('../general/front/navigation.php');        

        //Récupération des infos page précédente
        $id_compte=$_SESSION["id_compte"];
        $type=$_SESSION["id_type_utilisateur"];
        $identifiant=$_SESSION["identifiant"];
        
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
    
        echo "<br><br>";
        echo "<div class='row'><div class='col-lg-4'> </div><div class='col-lg-'><br><br><br><br><h1>Bienvenue sur</h1></div><div class='col-lg-4'> <img src='../general/front/logo_complet_petit.png'></div></div><br><br>";
        
    

    //Gestion des modules par type d'utilisateur
    //Pour chaqsue module, on crée un tableau qui stocke les id des types d'utilisateur ayant accès à un module
    //Si l'id du type de compte connecté a l'accès à la rubrique, alors le module d'accès est visible

    //Module saisie transhumance (éleveur seulement)
    $compteur_row=0;
    echo "<div class='container'>";
    echo "<h3>Bonjour $identifiant !</h3><BR/>";
    echo "<div class='row padding_accueil'>";
        $tab_saisi_trans=array(2,6);
        if (in_array($type,$tab_saisi_trans)){    
            echo "<br><div class='col-lg-3'><br>";
            //<img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                echo "<center><img class='rounded-circle' src='transhumance.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p> Déclarer un déplacement d'animaux vers un alpage </p></center>";
                echo "<center><a class='btn bouton-sonnaille' href='../transhumance/transhumance_front.php' role='button'>Déclarer une transhumance</a></center>";
                //echo "<a href='../transhumance/transhumance_front.php'>Déclarer une tranhumance</a>";
            echo "</div><br>";
            $compteur_row=$compteur_row+1;
        }

    //Module Liste transhumance (eleveur, GDS)
        $tab_liste_trans=array(2,3,6);
        if (in_array($type,$tab_liste_trans)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='liste_transhumances.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p> Consulter la liste des transhumances existantes </p></center>";
                echo "<center><a class='btn bouton-sonnaille' href='../transhumance/liste_transhumance.php' role='button'>Liste des transhumances</a></center>";
            echo "</div><br>";
            $compteur_row=$compteur_row+1;
        }

    //Module saisie diagnostic (véto seulement)
        $tab_saisi_diag=array(1,6);
        if (in_array($type,$tab_saisi_diag)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='diagnostic.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p> Saisir un nouveau diagnostic </p></center>";
                echo "<center><br><a class='btn bouton-sonnaille' href='../diagnostic/diagnostic_front.php' role='button'>Diagnostics</a></center>";
            echo "</div><br>";
            $compteur_row=$compteur_row+1;
        }

    //Module saisie prophylaxie (véto seulement)
        $tab_saisi_pro=array(1,6);
        if (in_array($type,$tab_saisi_pro)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='virus.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p> Saisir une nouvelle prophylaxie </p></center>";
                echo "<center><br><a class='btn bouton-sonnaille' href='../prophylaxie/prophylaxie.php' role='button'>Prophylaxie</a></center>";
            echo "</div><br>";
            $compteur_row=$compteur_row+1;
        }
    if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
     
    //Module Liste diagnostics (Véto, GDS)
        $tab_liste_diag=array(1,3,6);
        if (in_array($type,$tab_liste_diag)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='liste_diagnostics.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p>Consulter la liste des diagnostics saisis </p></center>";
                echo "<center><a class='btn bouton-sonnaille' href='../diagnostic/liste_diagnostic.php' role='button'>Liste des diagnostics</a></center>";
            echo "</div><br>";
            $compteur_row=$compteur_row+1;
        }
    
    if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
    
    //Module saisie zone tampon (GDS)
        $tab_saisi_ZT=array(3,6);
        if (in_array($type,$tab_saisi_ZT)){
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='zone_tampon.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p>Saisir une nouvelle zone tampon</p></center>";
                echo "<center><br><a class='btn bouton-sonnaille' href='../zone_tampon/zone_tampon_front.php' role='button'>Zone tampon</a></center>";
            
            $compteur_row=$compteur_row+1;
            echo "</div><br>";
        } 
    if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
    
    //Module Liste exploitations (GDS)
        $tab_saisi_ZT=array(3,6);
        if (in_array($type,$tab_saisi_ZT)){
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='exploitations.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p>Consulter la liste des exploitations</p></center>";
                echo "<center><br><a class='btn bouton-sonnaille' href='../prophylaxie/liste_exploitation.php' role='button'>Liste des exploitations</a></center>";
            
            $compteur_row=$compteur_row+1;
            echo "</div><br>";
        } 
    if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
    
    //Module ajout doc
        $tab_ajout_doc=array(6);
        if (in_array($type,$tab_ajout_doc)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='ajout_document.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p>Ajouter un nouveau document</p></center>";
                echo "<center><br><a class='btn bouton-sonnaille' href='../documents/document.php' role='button'>Documents</a></center>";
            
            $compteur_row=$compteur_row+1;
            echo "</div><br>";
        } 
    
        if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
            echo "<br><br>";
    }

    //Module saisie compte utilisateur
        $tab_saisi_compte=array(6);
        if (in_array($type,$tab_saisi_compte)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='users.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p>Saisir un nouveau compte utilisateur</p></center>";
                echo "<center><a class='btn bouton-sonnaille' href='../compte_utilisateur/compte_utilisateur.php' role='button'>Comptes utilisateurs</a></center>";
            
            $compteur_row=$compteur_row+1;
            echo "</div><br>";
        } 
    
    if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }

    //Module liste comptes utilisateur
        $tab_liste_compte=array(6);
        if (in_array($type,$tab_liste_compte)){    
            echo "<br><div class='col-lg-3'><br>";
                echo "<center><img class='rounded-circle' src='list_users.png' alt='Generic placeholder image' width='140' height='140'></center><br>";
                echo "<center><p>Consulter la liste des comptes utilisateurs</p></center>";
                echo "<center><a class='btn bouton-sonnaille' href='../compte_utilisateur/liste_comptes.php' role='button'>Liste des comptes</a></center>";
            
            $compteur_row=$compteur_row+1;
            echo "</div><br>";
        }             
        
    if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
        ?>

        <br><div class='col-lg-3'>
    <br>
            <center><img class='rounded-circle' src='liste_zones_tampon.png' alt='Generic placeholder image' width='140' height='140'></center><br>
            <center><p>Consulter la carte des zones tampon</p></center>
            <center><a class='btn bouton-sonnaille' href='../carte/cartepaca.php' role='button'>Carte des zones tampons</a></center>
        </div>
    <?php
            if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
        ?>
        <br><div class='col-lg-3'>
    <br>
            <center><img class='rounded-circle' src='annuaire.png' alt='Generic placeholder image' width='140' height='140'></center><br>
            <center><p>Consulter l'annuaire Sonnaille</p></center>
            <center><br><a class='btn bouton-sonnaille' href='../communication/annuaire.php' role='button'>Annuaire</a></center>
        </div>
        <br>

    <?php
            if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
        ?>
    
        <br><div class='col-lg-3'>
            <br>
            <center> <img class='rounded-circle' src='liste_zones.png' alt='Generic placeholder image' width='140' height='140'></center><br>
            <center><p>Consulter la liste des zones tampon</p></center>
            <center><br><a class='btn bouton-sonnaille' href='../zone_tampon/liste_zone_tampon.php' role='button'>Liste des zones tampon</a></center>
        </div>
    <br>
    <?php
            if ($compteur_row == 4){
        echo "</div><div class='row padding_accueil'>";
        $compteur_row = 0;
        echo "<br><br>";
    }
        ?>
        <br><div class='col-lg-3'>
            <br>
            <center><img class='rounded-circle' src='documents.png' alt='Generic placeholder image' width='140' height='140'></center><br>
            <center><p>Consulter la liste des documents</p></center>
            <center><br><a class='btn bouton-sonnaille' href="../documents/liste_documents.php" role='button'>Liste des documents</a></center>
        </div>
<br>
    </div>
    </div>
    <br>
    <br>
    <div class="center">
    <button onclick="self.location.href='Connexion.php'" class="btn btn-secondary bouton-m">Retour</button>
    </div>
    <br>
    <?php //Ajout mise en page
    include('../general/front/footer.html');?>
</body>
</html>