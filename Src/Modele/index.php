<?php
    include("./creationbase.php");
    define("NOMBDD", "projet");
    define("SERVER", new Creationbase());
    define("ATTRIBUTS", "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL");

    function createTable($array, $nomTable, $conditionsFin){
        $stringAttributs = "";
        foreach($array as $key => $type){
            $stringAttributs .= $key . " " . $type . ", ";
        }
        $stringAttributs .= $conditionsFin;
        SERVER->createTable(NOMBDD, "utilisateur", $stringAttributs);
    }

    function createProjetTable(){
        SERVER->createBDD("projet");
        echo "Creation des tables pour le projet<br>";
        $arrayUtilisateur = ["login" => "VARCHAR(50)", "mdp" => "VARCHAR(50)", "mail" => "VARCHAR(50)", "prenom" => "VARCHAR(50)", "nom" => "VARCHAR(50)", "typeUtilisateur" => "ENUM('Etudiant', 'Professeur')"];
        $arrayEleve = ["id" => "INT(6)", "niveau" => "VARCHAR(50)", "nDossier" => "INT(20)", "dateNaissance" => "VARCHAR(59)", "universite" => "VARCHAR(50)", "villeEtablissement" => "VARCHAR(50)", "cycle" => "VARCHAR(5)", "anneeEtude" => "VARCHAR(60)", "baccalaureat" => "VARCHAR(50)", "aneeBAC" => "VARCHAR(50)", "metionBAC" => "VARCHAR(50)", "etablissementBAC" => "VARCHAR(50)", "numeroPortable" => "INT(12)", "matiereSuivies" => "VARCHAR(50)"];
        createTable($arrayUtilisateur, "utilisateur", "PRIMARY KEY(login, mdp)");
        createTable($arrayEleve, "eleve", "PRIMARY KEY(id)");
        /*
        $Daniel = array("'Zokey', 'mdp', 'mail@mail.com', 'Daniel', 'Pinson', 'Etudiant'",
                "'Pseudo2', 'autreMDP', 'mail2@mail.com', 'Louis', 'CroixVBaton', 'Etudiant'");
        //SERVER->insertData(NOMBDD, );
        SERVER->insertData(NOMBDD, "eleve",
        "niveau, nDossier, dateNaissance, universite, villeEtablissement, cycle, anneeEtude, baccalaureat, anneeBAC, mentionBAC, etablissementBAC, numeroPortable, matiereSuivies",
        array("'L2', '12345678', '05/10/2000', 'Universite de Bourgogne-Franche-Comte', 'Dijon', 'License informatique', 'L2', 'BAC', '2018', 'Bien', 'Eiffel', '0652435145', 'Math'",
        "'L3', '12345679', '05/11/2000', 'Universite de Bourgogne-Franche-Comte', 'Dijon', 'License mathématique', 'L3', 'BAC', '2017', 'TBien', 'Carnot', '0652435144', 'Français'"));
        echo "Insertion d'un élève et d'un utilisateur<br>";
        */
    }

    //launchTestSuite();
    // Vider toutes les tables des informations qui sont dedans
    SERVER->deleteData(NOMBDD, "eleve");
    SERVER->deleteData(NOMBDD, "utilisateur");
    createProjetTable();
    //SERVER->deleteNOMBDD("projet");
    //deleteAllTestTable();

?>
</body>