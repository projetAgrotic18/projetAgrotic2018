<?php session_start();
//session_destroy (); //Fermeture d'une session ouverte
if (1==0){
    header('Page_accueil2.php');
    exit;
else{
    
}
}
?> 
<html>
<head>
    <META charset="UTF-8">
    <title>Connexion</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href='../general/front/style.css'>
    <script type="text/javascript">
        function verif(){
            var log=document.getElementById('nom').value;
            var mdp=document.getElementById('mdp').value;
            
            $.ajax({
                type: 'post',
                url: 'page_verif.php',
                data : {
                    login : log,
                    mdp: mdp
                },
                success: function (response){
                    if (response=='Failed'){
                        document.getElementById('alerte').innerHTML="Erreur lors de la connexion, votre login ou votre mot de passe est incorrect";
                    }
                    else{
                        document.getElementById('alerte').innerHTML="";
                    }
                },
                complete: function(){
                    if (document.getElementById('alerte').innerHTML=="Connexion établie"){
                        return true;
                    };
                    else{return false};
                }
            });

        };
        
        function tafonction(){
            // traitement
            setTimeout(tafonction,1000); /* rappel après 2 secondes = 2000 millisecondes */
        }
        tafonction();

        
    </script>
</head>
<body>
    <div class='container'>
        <?php //Ajout mise en page
        include('../general/front/navigation.html');?>

        <center><h1>Nom du site</h1></center><br>
        <br><br>
        <!-- ddpp, gds, veto, labo, eleveur-->
        <h2>Veuillez vous connecter</h2>
        <span id='alerte'></span>
        <form method='POST' action='Page_accueil2.php' onsubmit="return verif()">
            <p>Saisir votre nom</p><br/>
            <input type='text' name='nom' id='nom' size='10' value=''><br/>
            <p>Saisir votre mot de passe</p><br/>
            <input type='password' name='mdp' id='mdp' size='10'><br/><br/>
            <input type='submit' name='bouton1' value='Soumettre'><!--onclick="verif()">-->
        </form><br><br>

        <?php //Ajout mise en page
        include('../general/front/footer.html');?>
    </div>
</body>
</html>