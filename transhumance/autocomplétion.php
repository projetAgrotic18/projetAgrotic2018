<?php 
 
// Connexion, sélection de la base de donnée
 
    $dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=te user=postgres password=postgres") 
        or die('Connexion impossible : ' . pg_last_error()); 
 
// Exécution de la requ?te 
     
   $term = $_GET['commune']; 
 
   $result =$dbconn->prepare("SELECT non_commune FROM commune WHERE nom_commune LIKE '$term'"); // j'effectue ma requète SQL gràce au mot-clé
    
 $result->execute(array('term' => '%'.$term.'%'));
 
 
     
$array = array(); // on crée le tableau 
  while ($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données 
{ 
    array_push($array, $line['libelle']); // et on ajoute celles-ci dans notre tableau 
} 
 
echo json_encode($array); // il n'y a plus qu'à convertir en JSON 
 
 
// Libère le résultat
 
   pg_free_result($result); 

// Ferme la connexion 
     
    pg_close($dbconn); 
?> 