<?php 
    require_once("creationbase.php");
    require_once("bdd.php");
    require_once("../controlleur/utilisateur.php");
    require_once("matiereDAO.php");
    define("PROJET", "projet");
    define("SERVER", new Creationbase());

    define("TABLES", array(
        ["nomTable" => "utilisateur", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "login" => "VARCHAR(64)", "mdp" => "VARCHAR(64)", "mail" => "VARCHAR(64)", "prenom" => "VARCHAR(64)", "nom" => "VARCHAR(64)", "typeUtilisateur" => "ENUM('Etudiant', 'Professeur')"]],
        ["nomTable" => "etudiants", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "niveau" => "ENUM('6EME', '5EME', '4EME', '2ND', '1ERE', 'TERM', 'L1', 'L2', 'L3', 'M1', 'M2')", "matiereSuivies" => "VARCHAR(64)"]],
        ["nomTable" => "forum", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "nom" => "VARCHAR(64)", "participant" => "INT(20)"]],
        ["nomTable" => "canal", "conditionFin" => "PRIMARY KEY(canaux)", "attributs" => ["canaux" => "VARCHAR(50)"]],
        ["nomTable" => "matiere", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT UNSIGNED AUTO_INCREMENT", "nom" => "VARCHAR(64)", "dateCreation" => "VARCHAR(64)", "contenu" => "VARCHAR(64)", "createur" => "VARCHAR(64)", "tags" => "VARCHAR(64)", "niveau" => "ENUM('6EME', '5EME', '4EME', '2ND', '1ERE', 'TERM', 'L1', 'L2', 'L3', 'M1', 'M2')"]],
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
    /*
    define("DATA", array(
        "utilisateur" => [ 
                            [":l" => "Zokey", ":mdp" => "1234", ":m" => "mail@mail.com", ":p" => "Daniel", ":n" => "Pinson", ":t" => "Etudiant"],
                            [":l" => "xXSasukeXx", ":mdp" => "tropDark", ":m" => "noir@triste.com", ":p" => "Clément", ":n" => "Pouilly", ":t" => "Etudiant"],
                            [":l" => "Zeus", ":mdp" => "toplane", ":m" => "zeus@mail.com", ":p" => "Woo-je", ":n" => "Choi", ":t" => "Etudiant"],
                            [":l" => "Oner", ":mdp" => "jungle", ":m" => "oner@mail.com", ":p" => "Hyeon-joon", ":n" => "Moon", ":t" => "Etudiant"],
                            [":l" => "Faker", ":mdp" => "midlane", ":m" => "faker@mail.com", ":p" => "Lee", ":n" => "Sang-hyeok", ":t" => "Etudiant"],
                            [":l" => "Gumayushi", ":mdp" => "adc", ":m" => "Gumayushi@mail.com", ":p" => "Lee", ":n" => "Min-hyeong", ":t" => "Etudiant"],
                            [":l" => "Keria", ":mdp" => "support", ":m" => "keria@mail.com", ":p" => "Ryu", ":n" => "Min-seok", ":t" => "Etudiant"],
                            [":l" => "Wunder", ":mdp" => "danemark", ":m" => "wunder@mail.com", ":p" => "Martin", ":n" => "Nordahl Hansen", ":t" => "Etudiant"],
                            [":l" => "Razork", ":mdp" => "espagne", ":m" => "Razork@mail.com", ":p" => "Ivan", ":n" => "Martin Diaz", ":t" => "Etudiant"],
                            [":l" => "Humanoid", ":mdp" => "tcheque", ":m" => "humanoid@mail.com", ":p" => "marek", ":n" => "brazda", ":t" => "Etudiant"],
                            [":l" => "Upset", ":mdp" => "allemagne", ":m" => "Guupsetail.com", ":p" => "Eliasee", ":n" => "Lipp", ":t" => "Etudiant"],
                            [":l" => "Hylissang", ":mdp" => "bulgarie", ":m" => "hylissang@mail.com", ":p" => "Zdravets", ":n" => "Iliev Galabov", ":t" => "Etudiant"],
                            [":l" => "Jupiter", ":mdp" => "McKinsey", ":m" => "jupiter@mail.com", ":p" => "Emmanuel", ":n" => "Macon", ":t" => "Professeur"],
                            [":l" => "Flanby", ":mdp" => "Scooter", ":m" => "flanby@mail.com", ":p" => "François", ":n" => "Hollande", ":t" => "Professeur"],
                            [":l" => "Tempete", ":mdp" => "Audible", ":m" => "tempete@mail.com", ":p" => "Nicolas", ":n" => "Sarcozy", ":t" => "Professeur"],
                            [":l" => "Resistant", ":mdp" => "JeVousAiEntendu", ":m" => "resistant@mail.com", ":p" => "Charles", ":n" => "deGaulle", ":t" => "Professeur"],
        ],
        "etudiants" => []
    ));


    function createData($nomTable, $attributs, $arrayData){
        foreach($arrayData as $data)
        SERVER->insertData("INSERT INTO ".PROJET.".$nomTable($attributs) VALUES(:l, :mdp, :m, :p, :n, :t);", $data);
    }
    */
    function createTableProjet(){
        SERVER->deleteBDD(PROJET); // Pour éviter les doubles insertions
        SERVER->createBDD(PROJET);
        foreach(TABLES as $table){
            createTable($table["nomTable"], $table["conditionFin"], $table["attributs"]);
        }
        echo "Creation des tables et insertions des données dans utilisateur réussie<br>";
    }

    createTableProjet();
    $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
    $mathematique = new Matiere(null, "algebre", "11/12/2012", "algebreLineraire.txt", $daniel, "mathematique", "L1");
    MatiereDAO::insertMatiere($mathematique);
?>
</body>