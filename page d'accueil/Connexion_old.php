<html>
<head>
    <META charset="UTF-8">
    <title>Connexion</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href='../general/front/style.css'>
</head>
<body>
    <div class='container'>
        <?php //Ajout mise en page
        include('../general/front/navigation.html');?>
    </div>
    
    <div class='container'>
        <center><h1>Nom du site</h1></center><br>
        <br><br>
        <!-- ddpp, gds, veto, labo, eleveur-->
        <h2>Veuillez vous connecter</h2>
        <span id='alerte'></span>
        <form method='POST' action='Page_accueil.php'>
            <p>Saisir votre nom</p><br/>
            <input type='text' name='identifiant' id='nom' size='10' value=''><br/>
            <p>Saisir votre mot de passe</p><br/>
            <input type='password' name='mdp' id='mdp' size='10'><br/><br/>
            <input type='submit' name='bouton1' value='Soumettre'>
        </form><br><br>
    </div>
    
    <div class='container'>
        <?php //Ajout mise en page
        include('../general/front/footer.html');?>
    </div>
</body>
</html>