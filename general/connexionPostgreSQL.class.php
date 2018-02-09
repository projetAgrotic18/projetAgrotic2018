<?php

class connexionPostgreSQL {
    private $nom_bdd;
    private $login;
    private $mdp;
    private $host;
    private $port;
    private $connex;
    
    function __construct() {
        $this->nom_bdd = testprojet;
        $this->login = postgres;
        $this->mdp = postgres;
        $this->host = '194.199.251.139';
        $this->port = '5433';
        $this->connex = pg_connect("'host=".$this->host." port=".$this->port." dbname=".$this->nom_bdd." user =".$this->login." password=".$this->mdp."'")
                or die('Connexion impossible : ' . pg_last_error());
        pg_set_client_encoding($this->connex, 'utf8mb4');
    }
    
    function fermer() {
        // Libère le résultat
        pg_free_result($this->result);

        // Ferme la connexion
        pg_close($this->connex);       
    }
    
    function requete($query) {
        $result = pg_query($this->connex, $query)
            or die('Échec de la requête : ' . pg_last_error());
        return $result;
    }
}
