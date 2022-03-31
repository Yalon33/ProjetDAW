<body style='background-color:black;'>
<style>
    Body {
        color:grey;
    }
</style>
<?php
    $SUCCES = 0;
    $ECHEC = 0;
    function testCreateDatabase(){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        if (SERVER->createBDD("testCreationDB")){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Création de la base de donnée";
        } else {
            $ECHEC++;
            echo "<br>[<font color='red'>FAIL</font>] Échec du test de création de la base de donnée";
        }
    }

    function testCreateTable(){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $nomBDD = "testTable";
        $nomTable = "maTable";
        if (SERVER->createBDD($nomBDD) || SERVER->createTable($nomBDD, $nomTable, ATTRIBUTS)){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Création de la table";
        } else {
            echo "<br>[<font color='red'>FAIL</font>] Échec du test de création de la table";
            $ECHEC++;
        }
    }

    function testInsertData($nomBDD, $nomTest, $arrayData){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $nomTable = "maTable";
        $column = "firstname, lastname";
        if (SERVER->createBDD($nomBDD) && SERVER->createTable($nomBDD, $nomTable, ATTRIBUTS)){
            foreach ($arrayData as $data){
                if (!SERVER->insertData($nomBDD, $nomTable, $column, $data)){
                    echo "<br>[<font color='red'>FAIL</font>] $nomTest";
                    $ECHEC++;
                    return;
                }
            }
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] $nomTest";
        } else {
            echo "<br>[<font color='red'>FAIL</font>] $nomTest";
            $ECHEC++;
        }
    }

    function deleteAllTestTable(){
        SERVER->deleteBDD("testCreationDB");
        SERVER->deleteBDD("testTable");
        SERVER->deleteBDD("testInsertData");
        SERVER->deleteBDD("testInsertMultipleData");
        SERVER->deleteBDD("testInsertMultipleSameData");
    }

    function launchTestSuite(){
        deleteAllTestTable();
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        testCreateDatabase();
        testCreateTable();
        testInsertData("testInsertData", "Insertion d'une personne", array("'Daniel', 'Pinson'"));
        testInsertData("testInsertMultipleData", "Insertion de plusieurs personnes différentes", array("'Daniel', 'Pinson'", "'Thomas', 'Aglos'"));
        testInsertData("testInsertMultipleSameData", "Insertion de plusieurs même personnes", array("'Daniel', 'Pinson'", "'Daniel', 'Pinson'"));
        echo "<br><b>Synthèse de la testsuite: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
        | Réussi: <font color='green'>$SUCCES</font> 
        | Échoués: <font color='red'>$ECHEC</font></b><br>";
    }
?>