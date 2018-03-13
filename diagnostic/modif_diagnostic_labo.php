<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
  
    </head>
    <body>
        
        <!-- DIV Navigation (Menus) -->
        <?php include("../general/Front/navigation.php"); ?>
        
        <div class="padding">
            <div>Votre remarque à bien été enregistrée </div><br/>
            <?php 
            require "../general/connexionPostgreSQL.class.php";
            $connex = new connexionPostgreSQL(); 
            $id_diagnostique=$_POST['id_diagnostic'];

            $com_labo=$_POST['comm_labo'].'<a href="/projetAgrotic2018/diagnostic/consultation_diagnostic.php?id_diagnostic='.$id_diagnostique.'">Consulter le diagnostic</a>';

            $com_labo2=pg_escape_string($com_labo);
            $Query1=$connex->requete("UPDATE diagnostic SET comm_labo='$com_labo2' WHERE id_diagnostic='".$id_diagnostique."'");
            $title=pg_escape_string("Un laboratoire a laisse un commentaire");

            $result3 =  $connex->requete("SELECT MAX (id_notification) FROM notification"); //sÃ©lectionne le premier id  de notification disponible
                         $row= pg_fetch_array($result3);
                         $id=$row[0]+1; 

            $date= date("d.m.y");

            //création d'une notification labo           
            $Query2=$connex->requete("INSERT INTO notification(id_notification,date_notification,titre_notification,message) VALUES ('".$id."','".$date."','".$title."','".$com_labo2."')");

            //envoi des notifications au comptes concernés
            $Querycomptes=$connex->requete("SELECT com_id_compte FROM diagnostic WHERE id_diagnostic='".$id_diagnostique."'");
            $row=pg_fetch_array($Querycomptes, null, PGSQL_NUM);
            $connex->requete("INSERT INTO notification_compte(id_notification,id_compte,lu) VALUES (".$id.",".$row[0].",'FALSE')");  


            ?> 
            <form action="liste_diagnostic.php" >
                <input class='btn bouton-sonnaille' type="submit" value="Retour aux liste des diagnostics"> 
            </form>
        </div>
        
        <!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>	
        
    </body>
</html>
