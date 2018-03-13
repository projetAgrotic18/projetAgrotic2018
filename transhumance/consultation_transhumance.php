<?php session_start();?>
<html>
    <head>
        
        <!--- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- inclusion du style CSS de base -->
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <title>Consultation transhumance</title>
        <link rel="icon" href="sonnaille.ico"/>
          
    </head>
    <body>
        <?php include ("../general/Front/navigation.php"); 
        
        // Connexion, sélection de la base de données
        $connex = new connexionPostgreSQL();

        // Exécution de la requête SQL
		$id_transhumance = $_GET["id_lot_mvt"];
		$id_type_utilisateur = $_GET["type_utilisateur"];
               

        // R&cupération des champs correspondant à la transhumance que l'on veut modifier

		$result = $connex->requete("SELECT * FROM lot_mvt lm JOIN commune c ON lm.id_commune = c.id_commune WHERE lm.id_lot_mvt=".$id_transhumance);
		while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
			$date_arrivee = $row[3];
			$date_depart = $row[4];
			$description_marque = $row[5];
			$nom_responsable = $row[6];
			$tel_responsable = $row[7];
			$nom_transporteur = $row[8];
			$contact_transporteur = $row[9];
			$alp_collectif = $row[10];
			$capr_msm = $row[11];
			$capr_psm = $row[12];
			$ov_msm = $row[13];
			$ov_psm = $row[14];
			$prenom_responsable = $row[15];
			$adresse_transporteur = $row[16];
			$entreprise_transporteur = $row[17];
			$commune = $row[20];
		}

        ?>
       

        <h1 class="sonnaille_titre"><b>Votre transhumance :</b></h1>
        <form method="post" action="valid_modif_transhumance.php" name='form' onsubmit='return valider()' >
            <div class="fond-gris">
                <div class="padding">
                    
                    <h2>Renseignements responsable alpage</h2>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNom">(*) Nom</label>
                            <input type='text' name='nom_responsable' value ='<?php echo "$nom_responsable"; ?>' pattern="^([A-Za-  z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNom">(*) Prenom</label>
                            <input type='text' name='prenom_responsable' value ='<?php echo "$prenom_responsable"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNom">(*) Numero</label>
                            <input type='text' name='num_responsable' value ='<?php echo "$tel_responsable" ?>' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control" readonly/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="padding">
            
                <h2>Renseignements généraux</h2>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputDateDepart">(*)Date départ :</label>
                        <input type="date" class="form-control" id="inputDateDepart" placeholder="Date_depart" name="date_arrivee" value="<?php echo "$date_arrivee"; ?>" readonly>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="inputDateSortie">(*)Date Arrivée :</label>
                            <input type="date" class="form-control" id="inputDateSortie" placeholder="Date_sortie" name="date_sortie" value="<?php echo "$date_depart"; ?>" readonly>
                        </div>
                    </div>
                </div>
            

                <div class="form-group">
                    <label for="inputDateDepart">(*)Commune de destination :</label>
                    <input type="text" class="form-control" id="commune_id" placeholder="Entrez la commune" name="commune" value ='<?php echo "$commune"; ?>' readonly>
                    <input type='hidden' id='commune_id' name="commu" value ='<?php echo "$commune"; ?>' readonly>
                </div> 
            </div>

            <div class="fond_gris">
                <div class="padding">
                
                    <h2>Vos animaux déplacés</h2><br>
            
                    <div class="form-row align-items-center">
                        <div class="col-lg-6">
                            <div class="form-row">
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-4">
                                    <i>Agés de moins de 6 mois</i>
                                </div>
                                <div class="form-group col-md-4">
                                    <i>Agés de plus de 6 mois</i>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-1">Caprins</div>
                                <div class="form-group col-md-4">
                                    <input type='text' name='nbr_cap_-' value ='<?php echo "$capr_msm"; ?>' pattern = "[0-9]+" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type='text' name='nbr_cap_-' value ='<?php echo "$capr_psm"; ?>' pattern = "[0-9]+" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-1">Ovins</div>
                                <div class="form-group col-md-4">
                                    <input type='text' name='nbr_ov_-' value ='<?php echo "$ov_msm"; ?>' pattern = "[0-9]+" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type='text' name='nbr_ov_-' value ='<?php echo "$ov_psm"; ?>' pattern = "[0-9]+" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
            
                        <div class="col-lg-6">(*) Description du marquage :<br><br>
                            <TEXTAREA class="textarea" name="marquage" rows=10 cols=40 placeholder='Description (forme,couleur,emplacement)' value='<?php echo "$description_marque"; ?>' readonly></TEXTAREA>
                        </div>

                        <?php 
                        if($alp_collectif=='t'){
                            echo "Type d'Alpage/Pâturage:  collectif";
                        } else {
                            echo "Type d'Alpage/Pâturage:   individuel";
                        }
                        ?>     
                        <br>
                    </div>
                </div>
            </div>
                
            <div class="padding">
                <h2>Transporteur</h2><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNom">Nom</label>
                        <input type="text" class="form-control" id="NomTransporteur" name='nom_transp' value ='<?php echo "$nom_transporteur"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNom">Adresse</label>
                        <input type='text' name='adresse_transp' value ='<?php echo "$adresse_transporteur"; ?>' class="form-control" readonly>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNom">Nom de l'entreprise</label>
                        <input type="text" class="form-control" id="entreprise" name='entreprise_transp' value ='<?php echo "$entreprise_transporteur"; ?>' readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNom">Téléphone</label>
                        <input type='text'  name='tel_transp' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value ='<?php echo "$contact_transporteur" ?>' class="form-control" readonly>
                    </div>
                </div>
            </div>   
        </form>
        
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-3">
                <form action='liste_transhumance.php' method='POST' name='form_liste'>
                        <input type='submit' name='bt_retour' value='Retour' class="btn bouton-sonnaille bouton-m" >
                </form>
            </div>
           
            <div class="col-lg-3">
                <?php	
                if($id_type_utilisateur == 2){
                    echo "<form action='modif_transhumance.php?id_lot_mvt=".$id_transhumance."'  method='POST' name='form_consult'>
                    <input type='submit'   name='bouton' value='Modifier' class='btn bouton-sonnaille bouton-m'>
                    </form>";
                }
                ?>
            </div>
        </div>
        
        <?php include ("../general/Front/footer.html"); ?>  
        
    </body>
</html>