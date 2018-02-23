<?php

// Définition du tableau des symptomes
$a[]="Avortement";	$a[]="Diarrhée"; $a[]="Chute production lactée";	$a[]="Perte d'appétit";	$a[]="Inflammation des muqueuses";
$a[]="Perte de poids";	$a[]="Urines foncées";	$a[]="Hypothermie";		$a[]="Hyperthermie";	$a[]="Convulsions"; $a[]="Croutes"; 
$a[]="Perte de poils"; $a[]="Robe terne"; $a[]="Yeux rouges"; $a[]="Difficultés à se lever"; $a[]="Difficultés à se déplacer"; 
// Récupération du début du prénom tapé
$debut=$_GET["debut"];

$propositions="";

// Recherche de prénoms dans le tableau correspondant au texte saisie
if (empty($_GET["debut"])){	
	for($i=0; $i<count($a); $i++){
		$propositions = $propositions.$a[$i] . " ";
	}
	echo $propositions;
	
}else{
	
	for($i=0; $i<count($a); $i++){
		if (strtolower($debut)==strtolower(substr($a[$i],0,strlen($debut))))
				$propositions = $propositions.$a[$i] . " ";
	}

// Le cas échéant, affichage des propositions
	if ($propositions == "")
		echo "Pas de suggestion";
	else
		echo $propositions;
}
?>


	
	
	