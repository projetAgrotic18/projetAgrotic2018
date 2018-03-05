<?php session_start();
//session_destroy(); //Fermeture d'une session ouverte
if (isset($_POST['nom']) and isset($_SESSION["id_compte"])){
    header('Location: Page_accueil.php');
    exit;
}
?> 
<html>
<head>
    <META charset="UTF-8"/>
    <title>Connexion</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="icon" href="sonnaille.ico">
        
    <!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
</head>
<body>
    
        <br>
        <br>
        <div class='row'>
            <div class='col-lg-4'> </div>
            <div class='col-lg-'><br><br><br><br>
                <h1>Bienvenue sur</h1>
            </div>
            <div class='col-lg-4'> 
                <img src='../general/front/logo_complet_petit.png'>
            </div>
        </div><br>
        <br>
        <!-- ddpp, gds, veto, labo, eleveur-->
        <div class="padding">
            <h2>Se connecter</h2>
            <?php 
                if (isset($_POST['nom'])){
                    echo '<span>Erreur lors de la connexion, votre login ou votre mot de passe est incorrect</span>';
                }
            ?>
            <form method='POST' id='form' action='Connexion.php'>
                
                <div class="form-group col-lg-6">
                    <label for="nom">Identifiant</label>
                    <input type='text' name='nom' value ='' class="form-control" id='nom' placeholder="Saisissez votre identifiant de connexion">
                </div>
                
                <div class="form-group col-lg-6">
                    <label for="mdp">Mot de Passe</label>
                    <input type='password' name='mdp' value ='' class="form-control" id='mdp' placeholder="Saisissez votre mot de passe">
                </div>
                
                <br/><br/>
                
                <div class="center">
                <input type='button' name='bouton1' value='Connexion' onclick="verif()" class="btn bouton-sonnaille bouton-m">
                </div>
            </form><br><br><br>
        </div>
        
</body>
</html>