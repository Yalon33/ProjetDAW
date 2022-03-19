<?php
    include("./bdd.php");

    // Cette classe a pour rôle de créer la base de donnée pour qu'on travaille tous sur la même base et les mêmes tables.
    class Creationbase{
        public function __construct(){
            //Constructeur par défaut
        }

        function __destruct() {
            //Destructeur par défaut
        }

        //Est en privé car une instance de cette classe ne peut contenir que une base de donnée
        public function createBDD($nomBDD){
            // Pas besoin de faire un try/catch comme la query le fait déjà
            // Les echos deviennent vites illisibles
            return is_null(BDD::getInstance()->query("CREATE DATABASE IF NOT EXISTS $nomBDD;")) ? false : true;
        }


        public function deleteBDD($nomBDD){
            return is_null(BDD::getInstance()->query("DROP DATABASE IF EXISTS $nomBDD;")) ? false : true;
        }


        public function createTable($nomBDD, $nomTable, $attributString) {
            return is_null(BDD::getInstance()->query("CREATE Table IF NOT EXISTS $nomBDD.$nomTable($attributString);")) ? false : true;
        }
    }
    $SUCCES = 0;
    $ECHEC = 0;

    //A chaque instance de cette classe correspond une base de donnée, dans laquelle on peut créer des tables etc...
    function testCreateDatabase($server, $nomTable){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        if ($server->createBDD($nomTable)){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Test de création de la base de donnée réussi";
        } else {
            $ECHEC++;
            echo "<br>[<font color='red'>FAIL</font>] Échec du test de création de la base de donnée";
        }
    }

    function testCreateTable($server, $nomBDD, $nomTable, $attributs){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        if ($server->createBDD($nomBDD) || $server->createTable($nomBDD, $nomTable, $attributs)){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Test de création de la table réussi";
        } else {
            echo "<br>[<font color='red'>FAIL</font>] Échec du test de création de la table";
            $ECHEC++;
        }
    }

    function testInsertionDonnée($server, $nomBDD, $nomTable, $attributs){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        if ($server->createBDD($nomBDD) || $server->createTable($nomBDD, $nomTable, $attributs)){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Test d'insertion de donnée dans une table réussi";
        } else {
            echo "<br>[<font color='red'>FAIL</font>] Échec du test d'insertion de donnée>";
            $ECHEC++;
        }
    }

    function deleteAllTestTable($server){
        $server->deleteBDD("testCreationDB");
        $server->deleteBDD("testTable");
    }

    function launchTestSuite($server){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        testCreateDatabase($server, "testCreationDB");
        $attributs = "
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL
        ";
        testCreateTable($server, "testTable", "maTable", $attributs);
        deleteAllTestTable($server);
        echo "<br><b>Synthèse de la testsuite: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
        | Réussi: <font color='green'>$SUCCES</font> 
        | Échoués: <font color='red'>$ECHEC</font></b><br>";
    }

    function createProjetTable($server){
        $server->createTable("Etudiant");
    }


    $serv = new Creationbase();
    launchTestSuite($serv);
?>