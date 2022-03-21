
<body style='background-color:black;'>
<style>
    Body {
        color:gray;
    }
</style>

<?php
    $SUCCES = 0;
    $ECHEC = 0;
    define("ATTRIBUTS", "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL");
    define("BDD", "projet");
    define("TABELEVE", "eleve");
    define("COLELEVE", "login, mdp, mail, niveau, nDossier, prenom, nom, dateNaissance, universite, villeEtablissement, cycle, anneeEtude,
        baccalaureat, anneeBAC, mentionBAC, etablissementBAC, numeroPortable, matiereSuivies");
    define("DANIEL", "'monLogin', 'motDePasse', 'mail@mail.com', 'L2', '12345678', 'Daniel', 'Pinson', '05/10/2000', 'Dijon', 'Dijon',
    'L3', 'L3', 'BAC', '2018', 'Bien', 'Eiffel', '0652435145', 'Math'");

    //A chaque instance de cette classe correspond une base de donnée, dans laquelle on peut créer des tables etc...
    function testCreateDatabase($server){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        if ($server->createBDD("testCreationDB")){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Création de la base de donnée";
        } else {
            $ECHEC++;
            echo "<br>[<font color='red'>FAIL</font>] Échec du test de création de la base de donnée";
        }
    }

    function testCreateTable($server){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $nomBDD = "testTable";
        $nomTable = "maTable";
        if ($server->createBDD($nomBDD) || $server->createTable($nomBDD, $nomTable, ATTRIBUTS)){
            $SUCCES++;
            echo "<br>[<font color='blue'>SUCCES</font>] Création de la table";
        } else {
            echo "<br>[<font color='red'>FAIL</font>] Échec du test de création de la table";
            $ECHEC++;
        }
    }

    function testInsertData($server, $nomBDD, $nomTest, $arrayData){
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        $nomTable = "maTable";
        $column = "firstname, lastname";
        if ($server->createBDD($nomBDD) && $server->createTable($nomBDD, $nomTable, ATTRIBUTS)){
            foreach ($arrayData as $data){
                if (!$server->insertData($nomBDD, $nomTable, $column, $data)){
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

    function deleteAllTestTable($server){
        $server->deleteBDD("testCreationDB");
        $server->deleteBDD("testTable");
        $server->deleteBDD("testInsertData");
        $server->deleteBDD("testInsertMultipleData");
        $server->deleteBDD("testInsertMultipleSameData");
    }

    function launchTestSuite($server){
        deleteAllTestTable($server);
        GLOBAL $SUCCES;
        GLOBAL $ECHEC;
        testCreateDatabase($server);
        testCreateTable($server);
        testInsertData($server, "testInsertData", "Insertion d'une personne", array("'Daniel', 'Pinson'"));
        testInsertData($server, "testInsertMultipleData", "Insertion de plusieurs personnes différentes", array("'Daniel', 'Pinson'", "'Thomas', 'Aglos'"));
        testInsertData($server, "testInsertMultipleSameData", "Insertion de plusieurs même personnes", array("'Daniel', 'Pinson'", "'Daniel', 'Pinson'"));
        echo "<br><b>Synthèse de la testsuite: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
        | Réussi: <font color='green'>$SUCCES</font> 
        | Échoués: <font color='red'>$ECHEC</font></b><br>";
    }

    function insertEleve($server){
        echo "Insertion d'élève dans la table<br>";
        $server->insertData(BDD, TABELEVE, COLELEVE, DANIEL);
    }

    function createEtudiant($server){
        $server->createBDD(BDD);
        $attributsEtudiant = "
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(30) NOT NULL,
        mdp VARCHAR(30) NOT NULL,
        mail VARCHAR(30) NOT NULL,
        niveau VARCHAR(30) NOT NULL, 
        nDossier INT(20),
        prenom VARCHAR(60),
        nom VARCHAR(60),
        dateNaissance VARCHAR(60),
        universite VARCHAR(60),
        villeEtablissement VARCHAR(60),
        cycle VARCHAR(60),
        anneeEtude VARCHAR(60),
        baccalaureat VARCHAR(60),
        anneeBAC VARCHAR(60),
        mentionBAC VARCHAR(60),
        etablissementBAC VARCHAR(60),
        numeroPortable INT(12),
        matiereSuivies VARCHAR(60)
        "; // A voir pour les données particulière telles que niveau ou les dates
        $server->createTable(BDD, TABELEVE, $attributsEtudiant);
        echo "Creation des tables du projet<br>";
        insertEleve($server);
    }

    function createProjetTable($server){
        createEtudiant($server);
    }

    $serv = new Creationbase();
    //launchTestSuite($serv);
    createProjetTable($serv);

?>
</body>