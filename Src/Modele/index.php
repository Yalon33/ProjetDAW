<?php 
    require_once("creationbase.php");
    require_once("../Controlleur/utilisateur.php");
    define("PROJET", "projet");
    define("SERVER", new Creationbase());

    define("TABLES", array(
        ["nomTable" => "utilisateur", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "login" => "VARCHAR(64)", "mdp" => "VARCHAR(64)", "mail" => "VARCHAR(64)", "prenom" => "VARCHAR(64)", "nom" => "VARCHAR(64)", "typeUtilisateur" => "ENUM('Etudiant', 'Professeur')"]],
        ["nomTable" => "etudiants", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "niveau" => "ENUM('6EME', '5EME', '4EME', '2ND', '1ERE', 'TERM', 'L1', 'L2', 'L3', 'M1', 'M2')", "matiereSuivies" => "VARCHAR(64)"]],
        ["nomTable" => "forum", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "nom" => "VARCHAR(64)", "participant" => "INT(20)"]],
        ["nomTable" => "canal", "conditionFin" => "PRIMARY KEY(canaux)", "attributs" => ["canaux" => "VARCHAR(50)"]],
        ["nomTable" => "matiere", "conditionFin" => "PRIMARY KEY(id), CONSTRAINT FK_utilisateur_matiuere FOREIGN KEY (createur) REFERENCES projet.utilisateur(id) ON DELETE CASCADE", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "nom" => "VARCHAR(64)", "dateCreation" => "VARCHAR(64)", "contenu" => "VARCHAR(64)", "createur" => "INT UNSIGNED", "tags" => "VARCHAR(64)", "niveau" => "ENUM('6EME', '5EME', '4EME', '2ND', '1ERE', 'TERM', 'L1', 'L2', 'L3', 'M1', 'M2')"]],
        ["nomTable" => "message", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "contenu" => "VARCHAR(64)"]],
        ["nomTable" => "reponse", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "reponse" => "VARCHAR(1024)"]]
    ));

    define("DATA", array(
        "utilisateur" => [ 
                            new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudiant"),
                            new Utilisateur(null, "xXSasukeXx", "tropDark", "noir@triste.com", "Clément", "Pouilly", "Etudiant"),
                            new Utilisateur(null, "Zeus", "SKTtoplane", "zeus@mail.com", "Choi", "Woo-je", "Etudiant"),
                            new Utilisateur(null, "Oner", "SKTjungle", "oner@mail.com", "Moon", "Hyeon-joon",  "Etudiant"),
                            new Utilisateur(null, "Faker", "SKTmidlane", "faker@mail.com", "Sang-hyeok", "Lee", "Etudiant"),
                            new Utilisateur(null, "Gumayushi", "SKTadc", "Gumayushi@mail.com", "Min-hyeon", "Lee", "Etudiant"),
                            new Utilisateur(null, "Keria", "SKTsuppoer", "keria@mail.com", "Min-seok", "Ryu", "Etudiant"),
                            new Utilisateur(null, "Wunder", "FCtoplane", "wunder@mail.com", "Martin", "Nordahl Hansen", "Etudiant"),
                            new Utilisateur(null, "Razork", "FCjungle", "razork@mail.com", "Ivan", "Martin Diaz", "Etudiant"),
                            new Utilisateur(null, "Humanoid", "FCmidlane", "humanoid@mail.com", "Marek", "Brazda", "Etudiant"),
                            new Utilisateur(null, "Upset", "FCadc", "upset@mail.com", "Eliasee", "Lipp", "Etudiant"),
                            new Utilisateur(null, "Hylissang", "FCsupport", "hylissang@mail.com", "Zdravets", "Iliev Galabov", "Etudiant"),
                            new Utilisateur(null, "Jupiter", "McKinsey", "jupier@mail.com", "Emmanuel", "Macron", "Professeur"),
                            new Utilisateur(null, "Flanby", "Scooter", "flanby@mail.com", "Fançois", "Hollande", "Professeur"),
                            new Utilisateur(null, "Tempete", "Audible", "tempete@mail.com", "Nicolas", "Sarcozy", "Professeur"),
                            new Utilisateur(null, "Resistant", "JeVousAiEntendu", "resistant@mail.com", "Charles", "deGaulle", "Professeur"),
                            new Utilisateur(null, "Accordeon", "President", "accordeon@mail.com", "Valérie", "Giscard d'Estaing", "Professeur"),
                            new Utilisateur(null, "xXLesPommes", "ChefFaitPourCheffer", "pommes@mail.com", "Jacques", "Chirac", "Professeur")
        ],
        "etudiants" => [

        ]
    ));
    function createTable($nomTable, $conditionsFin, $array){
        $stringAttributs = "";
        foreach($array as $key => $type){
            $stringAttributs .= $key . " " . $type . ", ";
        }
        $stringAttributs .= $conditionsFin;
        SERVER->createTable(PROJET, $nomTable, $stringAttributs);
    }
    function reCreateTableProjet(){
        SERVER->deleteBDD(PROJET); // Pour éviter les doubles insertions
        SERVER->createBDD(PROJET);
        foreach(TABLES as $table){
            createTable($table["nomTable"], $table["conditionFin"], $table["attributs"]);
        }
    }

    reCreateTableProjet();
?>