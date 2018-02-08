<html>
    <head>
        <title>Déclaration de transhumance</title>

    </head>
    <body>
        <h1 align="center"><b>Déclarer un transhumance intrarégionale</b></h1>
        <h2>Renseignements responsable alpage</h2>
        <form method="post" action="exo19_p3" name='form' onsubmit='return valider()'>
            <table>

                <tr>
                    <td><label>(*)Nom</label> :</td>
                    <td><input type='text' name='nom_responsable' value =''></td>
                </tr>
                <tr>
                    <td><label>(*)Prénom</label> :</td>
                    <td><input type='text' name='prenom_responsable' value =''></td>
                </tr>
                <tr>
                    <td> <label>(*)Numéro de téléphone :</label></td>
                    <td><input type='text' name='num_responsable' value =''></td>
                </tr>
            </table>
            <h2>Renseignements généraux</h2>
            (*)Date départ : 
            <input id="date_debut" type="date">
            (*)Date fin :
            <input id="date_fin" type="date"><br><br>
            <label>(*)Commune de destination</label>
            <input type='text' name='num_responsable' value =''>
            <h2>Vos animaux déplacés</h2>
            <table>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        Agés de moins de 6 mois
                    </td>
                    <td>
                        Agés de plus de 6 mois
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Caprins
                    </td>
                    <td>
                        <input type='text' name='nbr_cap_-' value =''>
                    </td>
                    <td>
                        <input type='text' name='nbr_cap_+' value =''>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Ovins
                    </td>
                    <td>
                        <input type='text' name='nbr_ov_-' value =''>
                    </td>
                    <td>
                        <input type='text' name='nbr_ov_+' value =''>
                    </td>
                    
                    
                </tr>
            </table>
            Description du marquage :<br>
            <TEXTAREA name="marquage" rows=10 cols=40></TEXTAREA>
            
            <input type="radio" name="type_paturage" value="collectif" /> Alpage/Pâturage collectif
            <input type="radio" name="type_paturage" value="individuel" /> Alpage/Pâturage individuel

        </form>
    </body>




