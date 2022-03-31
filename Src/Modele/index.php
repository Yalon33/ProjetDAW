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
        SERVER->createTable(NOMBDD, $nomTable, $stringAttributs);
    }

    /**
     * creation des tables du projet qui sont, dans l'ordre, utilisateur, eleve, professeur, canal, forum, matiere, message, reponse
     *
     * @return void
     */
    function createProjetTable(){
        SERVER->createBDD("projet");
        createTable(["login" => "VARCHAR(64)", "mdp" => "VARCHAR(64)", "mail" => "VARCHAR(64)", "prenom" => "VARCHAR(64)", "nom" => "VARCHAR(64)", "typeUtilisateur" => "ENUM('Etudiant', 'Professeur')"], "utilisateur", "PRIMARY KEY(login, mdp)");
        createTable(["id" => "INT(8)", "niveau" => "VARCHAR(64)", "nDossier" => "INT(20)", "dateNaissance" => "VARCHAR(59)", "universite" => "VARCHAR(64)", "villeEtablissement" => "VARCHAR(64)", "cycle" => "VARCHAR(5)", "anneeEtude" => "VARCHAR(60)", "baccalaureat" => "VARCHAR(64)", "aneeBAC" => "VARCHAR(64)", "metionBAC" => "VARCHAR(64)", "etablissementBAC" => "VARCHAR(64)", "numeroPortable" => "INT(12)", "matiereSuivies" => "VARCHAR(64)"], "eleve", "PRIMARY KEY(id)");
        //createTable([], "professeur", "");
        createTable(["id" => "INT(8)", "nom" => "VARCHAR(64)", "participant" => "INT(20)"], "canal", "PRIMARY KEY(id)");
        createTable(["canaux" => "VARCHAR(50)"], "forum", "PRIMARY KEY(canaux)");
        createTable(["id" => "INT(8)", "nom" => "VARCHAR(64)", "dateCreation" => "VARCHAR(64)", "contenu" => "VARCHAR(64)", "createur" => "VARCHAR(64)", "tags" => "VARCHAR(64)", "niveau" => "VARCHAR(64)"], "matiere", "PRIMARY KEY(id)");
        createTable(["id" => "INT(8)", "contenu" => "VARCHAR(64)"], "message", "PRIMARY KEY(id)");
        createTable(["id" => "INT(8)", "reponse" => "VARCHAR(1024)"], "reponse", "PRIMARY KEY(id)");
        echo "Creation des tables pour le projet réussi!<br>";
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