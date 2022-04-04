<body style='background-color:black;'>
<style>
    Body {
        color:grey;
    }
</style>
<?php
    include("creationbase.php");
    include("../controlleur/etudiant.php");
    define("NOMBDD", "tests");
    define("SERVER", new Creationbase());
    $SUCCES = 0;
    $ECHEC = 0;


    function testCreateDatabase(){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        if (SERVER->createBDD(NOMBDD)){
            $SUCCES++;
            echo "[<font color='blue'>SUCCES</font>] Création de la base de donnée<br>";
        } else {
            $ECHEC++;
            echo "[<font color='red'>FAIL</font>] Échec du test de création de la base de donnée ".NOMBDD."<br>";
        }
    }

    function testCreateTable(){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $nomTable = "maTable<br>";
        $attributs = "nom VARCHAR(64), prenom VARCHAR(64)<br>";
        if (SERVER->createBDD(NOMBDD) || SERVER->createTable(NOMBDD, $nomTable, $attributs)){
            $SUCCES++;
            echo "[<font color='blue'>SUCCES</font>] Création de la table<br>";
        } else {
            echo "[<font color='red'>FAIL</font>] Échec du test de création de la table $nomTable<br>";
            $ECHEC++;
        }
    }

    function testInsertPrepare($nomTest){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $nomTable = "testInsertPreparedData";
        $columns = "nom, prenom";
        $query = "INSERT INTO ".NOMBDD.".$nomTable($columns) VALUES(:n, :p)";
        $attributs = "nom VARCHAR(64), prenom VARCHAR(64)";
        $arrayData = array(array("n" => "'Pinson'", "p" => "'Daniel'"));
        if (SERVER->createBDD(NOMBDD) && SERVER->createTable(NOMBDD, $nomTable, $attributs)){
            foreach ($arrayData as $data){
                if (SERVER->insertData($query, $data) == 0){
                    echo "[<font color='red'>FAIL</font>] $nomTest : l'insertion du tableau { ";
                    print_r($data);
                    echo "} à échouée<br>";
                    $ECHEC++;
                    return;
                }
            }
            $SUCCES++;
            echo "[<font color='blue'>SUCCES</font>] $nomTest<br>";
        } else {
            echo "[<font color='red'>FAIL</font>] $nomTest : creation de la table ou de la base de donnée à échouée<br>";
            $ECHEC++;
        }
    }

    function launchTestSuite(){
        SERVER->deleteBDD(NOMBDD);
        testCreateDatabase();
        testCreateTable();
        testInsertPrepare("Insertion d'une personne avec un prepare");
        //testInsertData("testInsertMultipleData", "Insertion de plusieurs personnes différentes", array("'Daniel', 'Pinson'", "'Thomas', 'Aglos'"));
        //testInsertData("testInsertMultipleSameData", "Insertion de plusieurs même personnes", array("'Daniel', 'Pinson'", "'Daniel', 'Pinson'"));
    }

    launchTestSuite();
    echo "<b>Synthèse de la testsuite: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
    | Réussi: <font color='green'>$SUCCES</font> 
    | Échoués: <font color='red'>$ECHEC</font></b><br>";
?>