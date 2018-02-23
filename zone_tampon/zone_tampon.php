<html>
    <head>
        <META charset="UTF-8">
    </head>
    <body>
        <h1>Ajouter des zones tampons</h1>
        <?php

            require "../general/connexionPostgreSQL.class.php";
            $connex = new connexionPostgreSQL();
            $result1 = $connex->requete("SELECT libelle_maladie, id_maladie FROM maladie");
            $result2 = $connex->requete("SELECT id_dpt, libelle_dep FROM departement");

        ?>
        <form>
            <select name="liste_maladie"><?php

                while ($line = pg_fetch_array($result1) ){
        
                    echo "<option value =".$line[1].">".$line[0]."</option>";
    
                }
    
            ?></select>
            
        </form>

        <BR/><BR/>

        <FORM METHOD = "GET" ACTION = "confirmation_zone_tampon.php">
            <INPUT TYPE = "radio" NAME = "zt_type" VALUE = "val"> Zone tampon par rayon autour du foyer <BR/>
                Rayon : <INPUT TYPE = "text" NAME = "zt_rayon"> km
        
        
            <BR/><BR/>
                
            <INPUT TYPE = "radio" NAME = "zt_type" VALUE = "val"> Zone tampon par département <BR/><BR/>
                <?php
                while ($line = pg_fetch_array($result2)){
                    echo "<INPUT TYPE ='checkbox' NAME = ".$line[2]." VALUE = ".$line[1]."> ".$line[1]."<BR/>";
                }
                //<INPUT TYPE = "checkbox" NAME = "Alpes_de_Haute_Provence" VALUE = "04"> 04   
                //<INPUT TYPE = "checkbox" NAME = "Hautes_Alpes" VALUE ="05"> 05    
                //<INPUT TYPE = "checkbox" NAME = "Alpes_Maritimes" VALUE ="06"> 06<BR/>
                //<INPUT TYPE = "checkbox" NAME = "Bouches_du_Rhone" VALUE ="13"> 13    
                //<INPUT TYPE = "checkbox" NAME = "Var" VALUE ="83"> 83    
                //<INPUT TYPE = "checkbox" NAME = "Vaucluse" VALUE ="84"> 84<BR/>
                ?>
                <BR/>
            <INPUT TYPE = "submit" NAME = "zt_ajout" VALUE = "Ajouter cette zone tampon">
                    
        </FORM>
                
        <FORM>
            <?php
                echo "<INPUT TYPE ='date' VALUE = ".getdate()."><BR/>";
            ?>
        </FORM>
    </body>
</html>