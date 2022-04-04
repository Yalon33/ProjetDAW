<body style='background-color:black;'>
<style>
    Body {
        color:grey;
    }
</style>
<?php
    include("./creationbase.php");
    define("PROJET", "projet");
    define("SERVER", new Creationbase());
    define("TABLES", array(
        ["nomTable" => "utilisateur", "conditionFin" => "PRIMARY KEY(login, mdp)", "attributs" => ["login" => "VARCHAR(64)", "mdp" => "VARCHAR(64)", "mail" => "VARCHAR(64)", "prenom" => "VARCHAR(64)", "nom" => "VARCHAR(64)", "typeUtilisateur" => "ENUM('Etudiant', 'Professeur')"]],
        ["nomTable" => "eleve", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT(8)", "niveau" => "VARCHAR(64)", "nDossier" => "INT(20)", "dateNaissance" => "VARCHAR(59)", "universite" => "VARCHAR(64)", "villeEtablissement" => "VARCHAR(64)", "cycle" => "VARCHAR(5)", "anneeEtude" => "VARCHAR(60)", "baccalaureat" => "VARCHAR(64)", "aneeBAC" => "VARCHAR(64)", "metionBAC" => "VARCHAR(64)", "etablissementBAC" => "VARCHAR(64)", "numeroPortable" => "INT(12)", "matiereSuivies" => "VARCHAR(64)"]],
        ["nomTable" => "forum", "conditionFin" => "PRIMARY KEY(canaux)", "attributs" => ["id" => "INT(8)", "nom" => "VARCHAR(64)", "participant" => "INT(20)"]],
        ["nomTable" => "canal", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["canaux" => "VARCHAR(50)"]],
        ["nomTable" => "matiere", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT(8)", "nom" => "VARCHAR(64)", "dateCreation" => "VARCHAR(64)", "contenu" => "VARCHAR(64)", "createur" => "VARCHAR(64)", "tags" => "VARCHAR(64)", "niveau" => "VARCHAR(64)"]],
        ["nomTable" => "message", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT(8)", "contenu" => "VARCHAR(64)"]],
        ["nomTable" => "reponse", "conditionFin" => "PRIMARY KEY(id)", "attributs" => ["id" => "INT(8)", "reponse" => "VARCHAR(1024)"]]
    ));

    function createTable($nomTable, $conditionsFin, $array){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $stringAttributs = "";
        foreach($array as $key => $type){
            $stringAttributs .= $key . " " . $type . ", ";
        }
        $stringAttributs .= $conditionsFin;
        SERVER->createTable(PROJET, $nomTable, $stringAttributs);
    }

    function createData($nomTable, $values, $arrayData){

    }

    /**
     * creation des tables du projet qui sont, dans l'ordre, utilisateur, eleve, professeur, canal, forum, matiere, message, reponse
     *
     * @return void
     */
    function createProjetTable(){
        foreach(TABLES as $table){
            createTable($table["nomTable"], $table["conditionFin"], $table["attributs"]);
        }
        echo "Creation des tables pour le projet réussi!<br>";
        /*
        $Daniel = array("'Zokey', 'mdp', 'mail@mail.com', 'Daniel', 'Pinson', 'Etudiant'",
                "'Pseudo2', 'autreMDP', 'mail2@mail.com', 'Louis', 'CroixVBaton', 'Etudiant'");
        //SERVER->insertData(PROJET, );
        SERVER->insertData(PROJET, "eleve",
        "niveau, nDossier, dateNaissance, universite, villeEtablissement, cycle, anneeEtude, baccalaureat, anneeBAC, mentionBAC, etablissementBAC, numeroPortable, matiereSuivies",
        array("'L2', '12345678', '05/10/2000', 'Universite de Bourgogne-Franche-Comte', 'Dijon', 'License informatique', 'L2', 'BAC', '2018', 'Bien', 'Eiffel', '0652435145', 'Math'",
        "'L3', '12345679', '05/11/2000', 'Universite de Bourgogne-Franche-Comte', 'Dijon', 'License mathématique', 'L3', 'BAC', '2017', 'TBien', 'Carnot', '0652435144', 'Français'"));
        echo "Insertion d'un élève et d'un utilisateur<br>";
        */
    }

    function createProjetData(){
        //createData("utilisateur", "");
    }

    //echo BDD::query("SELECT COUNT(*) FROM projet.eleve;")->fetchAll()[0][0] == 0 ? true : false;
    //createTable(["nom" => "VARCHAR(64)", "prenom" => "VARCHAR(64)"], "testEleve", "PRIMARY KEY(nom)");
    //SERVER->insertData("projet", "testeleve", "nom, prenom", "'Pinson', 'Daniel'");
    //$q = BDD::prepAndExec("SELECT COUNT(*) FROM projet.testeleve WHERE nom=:nom;", array("nom" => "Pinson"));
    //print_r($q);
    //SERVER->createBDD("projet");
    createProjetTable();
    createProjetData();
?>
</body>