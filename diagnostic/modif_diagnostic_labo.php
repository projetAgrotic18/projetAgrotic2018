<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templatesx
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
  
    </head>
    <body>
        
        <div>Votre remarque à bien été enregistrée </div><br/>
        <?php 
        require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL(); 
        $id_diagnostique=$_POST['id_diagnostic'];
        $id_diagnostique2=pg_escape_string[$id_diagnostique];
        $com_labo=$_POST['comm_labo'];
        $Query1=$connex->requete("UPDATE diagnostic SET comm_labo='$com_labo' WHERE id_diagnostic='".$id_diagnostique2."'");
        ?> 
        <form action="liste_diagnostic.php" >
                    <input type="submit" value="Retour aux liste des diagnostics"> 
        </form>

        
        
        
    </body>
</html>
