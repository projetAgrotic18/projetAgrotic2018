<?php 
 
//Pour appeler la fonction d'ouverture de la BDD,
//Mettre juste apr�s la balise ouvrante de php (<?php) :

	require "../general/connexionPostgreSQL.class.php";

//Puis la ligne suivante pour �tablir une connexion avec la BDD du projet :

	$connex = new connexionPostgreSQL();

//Pour faire une requ�te sur la BDD du projet, �crire ENSUITE la ligne suivante :
         $term = "abe";//$_GET["com"]; 

         $rqt="SELECT nom_commune FROM commune WHERE nom_commune LIKE '%".$term."%'";
	$result = $connex->requete($rqt);// j'effectue ma requ?te SQL gr?ce au mot-cl?
     
     echo $rqt;
  // $result = pg_query("SELECT libelle FROM communes WHERE libelle LIKE '$term'"); 
    
 //$result->execute(array('commune' => '%'.$term.'%'));
 
 
     
$array = array(); // on cr�� le tableau 
 
	while ($row = pg_fetch_array($result))   // on effectue une boucle pour obtenir les donn�es 
{ 
$array[]=$row['nom_commune']; // et on ajoute celles-ci � notre tableau 
} 
 
echo json_encode($array); // il n'y a plus qu'� convertir en JSON 
 
$connex->fermer; 

?>