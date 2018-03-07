<?php 
// On appelle la session 
session_start();
$_SESSION["user"] = NULL;

// On écrase le tableau de session 
$_SESSION = array(); 

$informations = Array(/*Déconnexion*/
				false,
				'Déconnexion',
				'Vous êtes à présent déconnecté.',
				' - <a href="'.ROOTPATH.'/membres/connexion.php">Se connecter</a>',
				ROOTPATH.'/index.php',
				5
				);


// On détruit la session 
session_destroy(); 
// On redirige le visiteur vers la page d'accueil 
header ('location: accueil.html');
exit();
?> 