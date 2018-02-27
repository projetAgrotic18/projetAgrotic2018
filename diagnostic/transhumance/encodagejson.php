<?php 
 
//Pour appeler la fonction d'ouverture de la BDD,
//Mettre juste après la balise ouvrante de php (<?php) :

	require "../general/connexionPostgreSQL.class.php";

//Puis la ligne suivante pour établir une connexion avec la BDD du projet :

	$connex = new connexionPostgreSQL();

//Pour faire une requête sur la BDD du projet, écrire ENSUITE la ligne suivante :
         $term = "abe";//$_GET["com"]; 

         $rqt="SELECT nom_commune FROM commune WHERE nom_commune LIKE '%".$term."%'";
	$result = $connex->requete($rqt);// j'effectue ma requ?te SQL gr?ce au mot-cl?
     
     echo $rqt;
  // $result = pg_query("SELECT libelle FROM communes WHERE libelle LIKE '$term'"); 
    
 //$result->execute(array('commune' => '%'.$term.'%'));
 
 
     
$array = array(); // on créé le tableau 
 
	while ($row = pg_fetch_array($result))   // on effectue une boucle pour obtenir les données 
{ 
$array[]=$row['nom_commune']; // et on ajoute celles-ci à notre tableau 
} 
 
echo json_encode($array); // il n'y a plus qu'à convertir en JSON 
 
$connex->fermer; 

?>