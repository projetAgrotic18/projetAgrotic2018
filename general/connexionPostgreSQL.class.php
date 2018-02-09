<?php

class connexionPostgreSQL {
    private $connex;
    
    function __construct() {
        $this->connex = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
                or die('Connexion impossible : ' . pg_last_error());
    }
    
    function fermer() {
        // Ferme la connexion
        pg_close($this->connex);       
    }
    
    function requete($query) {
        $result = pg_query($this->connex, $query)
            or die('Échec de la requête : ' . pg_last_error());
        return $result;
    }
}
