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
    <link rel="stylesheet" href='../general/front/style.css'>
</head>
<body>
    <div class='container'>
        <?php //Ajout mise en page
        include('../general/front/navigation.html');?>

        <center><h1>Nom du site</h1></center><br>
        <br><br>
        <!-- ddpp, gds, veto, labo, eleveur-->
        <h2>Veuillez vous connecter</h2>
        <?php 
            if (isset($_POST['nom'])){
                echo '<span>Erreur lors de la connexion, votre login ou votre mot de passe est incorrect</span>';
            }
        ?>
        <form method='POST' id='form' action='Connexion.php'>
            <p>Saisir votre login</p><br/>
            <input type='text' name='nom' id='nom' size='10' value=''><br/>
            <p>Saisir votre mot de passe</p><br/>
            <input type='password' name='mdp' id='mdp' size='10'><br/><br/>
            <input type='button' name='bouton1' value='Soumettre' onclick="verif()">
        </form><br><br>

        <?php //Ajout mise en page
        include('../general/front/footer.html');
        ?>
    </div>
</body>
</html>