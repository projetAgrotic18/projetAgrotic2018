<?php session_start(); ?>
<html>
    <head>
        <title>Envoie du mail</title>
		<META charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
	</head>
    <body>
    	<!-- Entête -->
    
    	<!-- DIV Navigation (Menus) -->
        <?php include("../general/Front/navigation.php"); ?>
    
    	<!-- Appelle de la page regroupant les fonctions -->
        <?php require_once('../general/procedures.php'); ?>
		
		<div class="padding">
			<?php
			
			$id_compte_utilisateur = $_SESSION['id_compte'];
			
			//Appel du fichier contenant la fonction de connexion
			require ("../general/connexionPostgreSQL.class.php");
		
			// Connexion, sélection de la base de données du projet
			$connex = new connexionPostgreSQL();

			// Exécution de la requête SQL permettant la récupération des données du compte utilisateur
			$info_utilisateur = $connex->requete("SELECT nom, portable, mail FROM compte_utilisateur WHERE id_compte=$id_compte_utilisateur");
			$row_info_util = pg_fetch_array($info_utilisateur);
			$mail_utilisateur = $row_info_util[2];
			$tel_utilisateur = $row_info_util[1];
			
			$id_dest=$_POST['id_dest'];
			
			// Exécution de la requête SQL permettant la récupération des informations sur le ou les destinataires
			$info_destinataire = $connex->requete("SELECT id_compte, nom, portable, mail FROM compte_utilisateur WHERE id_compte IN $id_dest");
			$nbr_dest = pg_num_fields($info_destinataire);
			
			$obj=$_POST['objet'];
			$message=$_POST['message'];
			
			$mailto="";
            $tel = "";
            while($row_dest = pg_fetch_array($info_destinataire)){
                $mailto .=$row_dest[3].", ";
                $tel .=$row_dest[2].", ";
            }
			$mailto = substr($mailto,0,strlen($mailto)-2);
			$tel_dest = substr($tel_dest,0,strlen($tel_dest)-2);
			
            //Envoie mail et notification
            if (isset($_POST['envoi_mail'])==TRUE AND isset($_POST['envoi_notif'])==TRUE) {
                //Définition du header pour l'envoie de mail.
				$headers = 'From:'.$mail_utilisateur. "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				
				ini_set('SMTP','sauternes.agro-bordeaux.fr');
				ini_set('smtp_port', '587');
				ini_set('sendmail_from','meryl.boquillon@agro-bordeaux.fr');
				
                //Envoie du mail
				if(mail($mailto, $obj, $message, $headers)){
					echo "Votre mail à bien été envoyé";
                    echo "</br>";
				}else {
					echo "Un problème est survenu, votre mail n'a pas pu être envoyé";
				}
                
                //Envoie de la notification
                $last_notif_id_req= $connex->requete('SELECT MAX(id_notification) as max_id FROM notification');
				$row_notif=pg_fetch_array($last_notif_id_req,null,PGSQL_NUM);

				//on récupere l'id max des notifications
				$last_id=$row_notif[0]+1;

				//ajout de la notification en premier pour respecter la contrainte de clé étrangère
				$connex->requete("INSERT INTO notification (id_notification, date_notification, titre_notification, message) VALUES (".$last_id.", CURRENT_DATE, '".$obj."', '".$message."')");
                
                $info_destinataire2 = $connex->requete("SELECT id_compte, nom, portable, mail FROM compte_utilisateur WHERE id_compte IN $id_dest");
                
				//ajout du lien avec le compte
				while($row_dest = pg_fetch_array($info_destinataire2)){
				    $connex->requete("INSERT INTO notification_compte(id_notification,id_compte,lu) VALUES (".$last_id.",".$row_dest[0].",FALSE)");
				} 
                echo "Votre notification à bien été envoyé";
                echo "</br>";
            }
            //Envoie d'un mail 
			elseif(isset($_POST['envoi_mail'])==TRUE AND isset($_POST['envoi_notif'])==FALSE) {
				
				//Définition du header pour l'envoie de mail.
				$headers = 'From:'.$mail_utilisateur. "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				
				ini_set('SMTP','sauternes.agro-bordeaux.fr');
				ini_set('smtp_port', '587');
				ini_set('sendmail_from','meryl.boquillon@agro-bordeaux.fr');
				
				if(mail($mailto, $obj, $message, $headers)){
					echo "Votre mail à bien été envoyé";
				}else {
					echo "Un problème est survenu, votre mail n'a pas pu être envoyé";
				}
                
            // Envoie d'un notification    
			} elseif(isset($_POST['envoi_notif'])==TRUE AND isset($_POST['envoi_mail'])==FALSE) {
				
                $last_notif_id_req= $connex->requete('SELECT MAX(id_notification) as max_id FROM notification');
				$row_notif=pg_fetch_array($last_notif_id_req,null,PGSQL_NUM);

				//on récupere l'id max des notifications
				$last_id=$row_notif[0]+1;

				//ajout de la notification en premier pour respecter la contrainte de clé étrangère
				$connex->requete("INSERT INTO notification (id_notification, date_notification, titre_notification, message) VALUES (".$last_id.", CURRENT_DATE, '".$obj."', '".$message."')");
                
                $info_destinataire1 = $connex->requete("SELECT id_compte, nom, portable, mail FROM compte_utilisateur WHERE id_compte IN $id_dest");
                
				//ajout du lien avec le compte
				while($row_dest = pg_fetch_array($info_destinataire1)){
				    $connex->requete("INSERT INTO notification_compte(id_notification,id_compte,lu) VALUES (".$last_id.",".$row_dest[0].",FALSE)");
				}
                echo "Votre notification à bien été envoyé";
                echo "</br>";
			}
				
			?>
			<center><br><a class='btn bouton-sonnaille' href="../page d'accueil/Page_accueil.php" role='button'>Retour page d'accueil</a></center>
				
			
			
		</div>
		
		<!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>
	</body>
</html>