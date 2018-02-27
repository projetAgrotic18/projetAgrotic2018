<?php 
 
// Connexion, s?lection de la base de donn?
 
    $dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres") 
        or die('Connexion impossible : ' . pg_last_error()); 
 
// Ex?cution de la requ?te 
     
   $term = $_GET['commune']; 
 
   $result =$bdd->prepare('SELECT libelle FROM communes WHERE libelle LIKE :term'); // j'effectue ma requ?te SQL gr?ce au mot-cl?
    
 $result->execute(array('term' => '%'.$term.'%'));
 
 
     
$array = array(); // on créé le tableau 
  while ($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données 
{ 
    array_push($array, $line['libelle']); // et on ajoute celles-ci à notre tableau 
} 
 
echo json_encode($array); // il n'y a plus qu'à convertir en JSON 
 
 
// Lib?re le r?sul
 
   pg_free_result($result); 
// Ferme la connexion 
     
    pg_close($dbconn); 
?> 