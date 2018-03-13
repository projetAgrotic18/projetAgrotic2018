<?php session_start(); ?> 
<html> 
<head> 
    <title>Validation de modification d'une zone tampon</title> 
    <META charset="UTF-8"/> 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
</head> 
<body> 
    <!-- Barre de navigation en fonction de l'utilisateur --> 
    <?php include('../general/front/navigation.php'); ?> 
         
    <h1 class="sonnaille_titre">Validation de modification d'une zone tampon</h1><br/> 
     
    <?php 
        // Connexion, sélection de la base de données du projet 
        $connex = new connexionPostgreSQL(); 
    
        // Récupération du nom de l'exploitation
        // La fonction permet d'éviter les problèmes duent aux apostrophes dans les noms
        $id_compte=$_POST['exploi']; 
        
        //Récupération des infos de l'exploitation
            $query4 = $connex->requete("SELECT tr.id_compte, gid, nom_exploitation FROM compte_utilisateur cu JOIN troupeaux2 tr on cu.id_compte=tr.id_compte WHERE tr.id_compte='".$id_compte."'"); 
            while ($row = pg_fetch_array($query4))  
                  { 
                        $id_compte = $row[0];
                        $gid=$row[1];
                  } 
    
        //Récupération des infos du formulaire
        $maladie=$_POST['liste_maladie'];    
        $idzt=$_POST['id_zt']; 
        $date_fin=$_POST['datefin']; 
        $active="TRUE"; 
 
        $rayonztprot=$_POST['zt_rayon']*1000; 
        $rayonztsurv=$_POST['zt_rayon2']; 
        
        //Enregistrement des modifications
        $query3 = $connex->requete("UPDATE zonetampon SET id_maladie='".$maladie."',rayon_prot='".$rayonztprot."',rayon_surv='".$rayonztsurv."', date_fin='".$date_fin."', id_compte='".$id_compte."' WHERE id_zone_tampon=".$idzt);
        
		$query4 = $connex->requete("UPDATE troupeaux2 SET id_compte=$id_compte WHERE gid=$gid");
    
        $query5 = $connex->requete("UPDATE public.zonetampon SET geom=tampon(id_zone_tampon)");
        echo "La zone tampon a bien été modifiée";    
             
    ?> 
    <form type="POST" action="liste_zone_tampon.php" > 
    <INPUT TYPE = "SUBMIT" VALUE = "Consulter la liste des zones tampon"/>
    </form><BR/> 
    <INPUT TYPE = "BUTTON" VALUE = "Consulter la carte" ONCLICK = "self.location.href='../carte/cartepaca.php'"/>
    
    <?php include('../general/front/footer.html');?> 
</body> 
</html>