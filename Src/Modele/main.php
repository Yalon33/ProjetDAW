
<body style='background-color:black;'>
<style>
    Body {
        color:gray;
    }
</style>

<?php
    include("./creationbase.php");
    $SUCCES = 0;
    $ECHEC = 0;
    define("BDD", "projet");
    define("SERVER", new Creationbase());
    define("ATTRIBUTS", "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL");

    //A chaque instance de cette classe correspond une base de donnée, dans laquelle on peut créer des tables etc...
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

    function createProjetTable(){
        SERVER->createBDD("projet");
        echo "Creation des tables pour le projet<br>";
        $attributsUtilisateur = "
        login VARCHAR(50),
        mdp VARCHAR(50),
        mail VARCHAR(50),
        prenom VARCHAR(60),
        nom VARCHAR(60),
        typeUtilisateur ENUM('Etudiant', 'Professeur')
        ";
        $attributsEtudiant = "
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        niveau VARCHAR(30) NOT NULL, 
        nDossier INT(20),
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
        SERVER->createTable(BDD, "utilisateur", $attributsUtilisateur);
        SERVER->createTable(BDD, "eleve", $attributsEtudiant);
        echo "Creation des tables<br>";
        SERVER->insertData(BDD, "utilisateur",
        "login, mdp, mail, prenom, nom, typeUtilisateur",
        array("'Zokey', 'mdp', 'mail@mail.com', 'Daniel', 'Pinson', 'Etudiant'",
        "'Pseudo2', 'autreMDP', 'mail2@mail.com', 'Louis', 'CroixVBaton', 'Professeur'"
        )
        );
        SERVER->insertData(BDD, "eleve",
        "niveau, nDossier, dateNaissance, universite, villeEtablissement, cycle, anneeEtude, baccalaureat, anneeBAC, mentionBAC, etablissementBAC, numeroPortable, matiereSuivies",
        array("'L2', '12345678', '05/10/2000', 'Universite de Bourgogne-Franche-Comte', 'Dijon', 'License informatique', 'L2', 'BAC', '2018', 'Bien', 'Eiffel', '0652435145', 'Math'",
        "'L3', '12345679', '05/11/2000', 'Universite de Bourgogne-Franche-Comte', 'Dijon', 'License mathématique', 'L3', 'BAC', '2017', 'TBien', 'Carnot', '0652435144', 'Français'"));
        echo "Insertion d'un élève et d'un utilisateur<br>";
    }

    //launchTestSuite();
    // Vider toutes les tables des informations qui sont dedans
    SERVER->deleteData(BDD, "eleve", NULL);
    SERVER->deleteData(BDD, "utilisateur", NULL);

    createProjetTable();
    //SERVER->deleteBDD("projet");
    //deleteAllTestTable();

?>
</body>