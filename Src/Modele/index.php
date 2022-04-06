<?php 
    require_once("creationbase.php");
    define("PROJET", "projet");
    define("SERVER", new Creationbase());

    define("TABLES", array(
        ["nomTable" => "utilisateur", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "login" => "VARCHAR(64)", "mdp" => "VARCHAR(64)", "mail" => "VARCHAR(64)", "prenom" => "VARCHAR(64)", "nom" => "VARCHAR(64)", "typeUtilisateur" => "ENUM('Etudiant', 'Professeur')"]],
        ["nomTable" => "etudiants", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "niveau" => "ENUM('6EME', '5EME', '4EME', '2ND', '1ERE', 'TERM', 'L1', 'L2', 'L3', 'M1', 'M2')", "matiereSuivies" => "VARCHAR(64)"]],
        ["nomTable" => "forum", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "nom" => "VARCHAR(64)", "participant" => "INT(20)"]],
        ["nomTable" => "canal", "conditionFin" => "PRIMARY KEY(canaux)", "attributs" => ["canaux" => "VARCHAR(50)"]],
        ["nomTable" => "matiere", "conditionFin" => "PRIMARY KEY(id), FOREIGN KEY (createur) REFERENCES projet.utilisateur(id) ON DELETE CASCADE", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "nom" => "VARCHAR(64)", "dateCreation" => "VARCHAR(64)", "contenu" => "VARCHAR(64)", "createur" => "INT UNSIGNED", "tags" => "VARCHAR(64)", "niveau" => "ENUM('6EME', '5EME', '4EME', '2ND', '1ERE', 'TERM', 'L1', 'L2', 'L3', 'M1', 'M2')"]],
        ["nomTable" => "message", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "contenu" => "VARCHAR(64)"]],
        ["nomTable" => "reponse", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "reponse" => "VARCHAR(1024)"]]
    ));
    function createTable($nomTable, $conditionsFin, $array){
        $stringAttributs = "";
        foreach($array as $key => $type){
            $stringAttributs .= $key . " " . $type . ", ";
        }
        $stringAttributs .= $conditionsFin;
        SERVER->createTable(PROJET, $nomTable, $stringAttributs);
    }
    function createTableProjet(){
        SERVER->deleteBDD(PROJET); // Pour éviter les doubles insertions
        SERVER->createBDD(PROJET);
        foreach(TABLES as $table){
            createTable($table["nomTable"], $table["conditionFin"], $table["attributs"]);
        }
    }

    createTableProjet();
?>