<?php
    require_once("../controlleur/utilisateur.php");
    require_once("matiereDAO.php");
    require_once("messageDAO.php");
    require_once("utilisateurDAO.php");
    define("PROJET", "projet");
    $SUCCES = 0;
    $ECHEC = 0;
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
    
    function resetTests(){
        UtilisateurDAO::deleteUtilisateurs();
        MatiereDAO::deleteMatieres();
        MessageDAO::deleteMessages();
    }

    function failedTest($nomTest){
        GLOBAL $ECHEC;
        $ECHEC ++;
        echo "[<font color='red'>FAIL</font>] $nomTest<br>";
        resetTests();
    }

    function succeededTest($nomTest){
        GLOBAL $SUCCES;
        $SUCCES++;
        echo "[<font color='blue'>SUCCES</font>] $nomTest<br>";
        resetTests();

    }

    function testClearTable($table){
        $nomTest = "Nettoyage de la table $table";
        switch ($table){
            case("utilisateur"):
                UtilisateurDAO::deleteUtilisateurs() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("matiere"):
                MatiereDAO::deleteMatieres() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            default:
                echo "Nom de table '$table' est invalide";
        }
    }

    function testInsertUtilisateurUnique(){
        $nomTest = "Insertion d'un unique utilisateur dans la table utilisateur";
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
        if (UtilisateurDAO::createUtilisateur($daniel) !== false){
            $data = UtilisateurDAO::getAllUtilisateurs();
            $daniel->compare($data[0]) ? succeededTest($nomTest) : failedTest($nomTest);
        }
        failedTest($nomTest);
    }

    function testInsertPlusieursUtilisateurs(){
        $nomTest = "Insertion de plusieurs utilisateurs dans la table utilisateur";
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudiant");
        $sasuke = new Utilisateur(null, "xX-Sasuke-Xx", "tropDark", "noir@village.com", "Clément", "Pouilly", "Etudiant");
        $arrayUtilisateur = [$daniel, $sasuke];
        UtilisateurDAO::createUtilisateur($daniel);
        UtilisateurDAO::createUtilisateur($sasuke);
        $utilisateurBDD = UtilisateurDAO::getAllUtilisateurs();
        for($i = 0; $i < sizeof($arrayUtilisateur); $i++){
            if (!$arrayUtilisateur[$i]->compare($utilisateurBDD[$i])){
                failedTest("$nomTest, $utilisateurBDD[$i] n'est pas dans la BDD ou ne correspond pas à $arrayUtilisateur[$i]");
                return;
            }
        }
        succeededTest($nomTest);
    }

    function testUtilisateurDAO(){
        testClearTable("utilisateur");
        testInsertUtilisateurUnique();
        testInsertPlusieursUtilisateurs();
    }

    function testInsertMatiereUnique(){
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
        $calculMat = new Matiere(null, "calcul matriciel", "12/01/2022", "calculMat.txt", $daniel, "mathematique", "L3");
        $nomTest = "Insertion d'une unique matière dans la table matière";
        UtilisateurDAO::createUtilisateur($daniel);
        if (MatiereDAO::insertMatiere($calculMat) === false){
            failedTest("$nomTest : L'insertion de $calculMat ne s'est pas effectuée correctement");
            return;
        }
        $matiereBDD = MatiereDAO::getAll();
        //$matiereBDD[0]->compare($calculMat) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testInsertPlusieursMatieres(){
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
        $calculMat = new Matiere(null, "calcul matriciel", "12/01/2022", "calculMat.txt", $daniel, "mathematique", "L3");
        $algebre = new Matiere(null, "algebre", "11/12/2012", "algebreLineraire.txt", $daniel, "mathematique", "L1");
        $arrayMatiere = [$calculMat, $algebre];
        foreach($arrayMatiere as $matiere){
            MatiereDAO::insertMatiere($matiere);
        }
        $matieresBDD = MatiereDAO::getAll();
        for($i = 0; $i < sizeof($arrayMatiere); $i++){
            if (!$arrayMatiere[$i]->compare($matieresBDD[$i])){
                failedTest("Insertion de plusieurs matières, $matieresBDD[$i] n'est pas dans la BDD");
                return;
            }
        }
        return;
    }

    function testMatiereDAO(){
        //$allMatiere = MatiereDAO::getAll();
        ////$calcMatBDD = MatiereDAO::getById(2);
        //$algebreBDD = MatiereDAO::getById(1);
        //echo "<pre>";
        //print_r($allMatiere);
        //echo "Avec l'identifiant";
        //print_r($algebreBDD);
        //echo "</pre>";
        //echo MatiereDAO::deleteMatieres() ? "Suppression des éléments dans matières<br>" : "Impossible de supprimer les matières<br>";
        //echo MatiereDAO::insertMatieres([$algebre, $calculMat]) ? "Insertion des matières en même temps réussie<br>" : "Impossible d'insérer les matières en même temps<br>";
        //echo MatiereDAO::deleteMatieres() ? "Suppression des éléments dans matières<br>" : "Impossible de supprimer les matières<br>";
        //echo MatiereDAO::insertMatieres($allMatiere) ? "Insertion des matières avec un identifiant en même temps réussie<br>" : "Impossible d'insérer les matières avec un identifiant en même temps<br>";
        testClearTable("matiere");
        testInsertMatiereUnique();
    }

    function testMessageDAO(){
        $question = new Message(null, "Comment on fait le DM?");
        $reponse = new Message(null, "Avec ton cerveau.");
        MessageDAO::insertMessage($question);
        MessageDAO::insertMessage($reponse);
        $allMessage = MessageDAO::getAll();
        $reponseBDD = MessageDAO::getById(2);
        echo "<pre>";
        print_r($allMessage);
        echo "Avec l'identifiant";
        print_r($reponseBDD);
        echo "</pre>";
        echo MessageDAO::deleteMessages() ? "Suppression des éléments dans message<br>" : "Impossible de supprimer tous les messages";
        echo MessageDAO::insertMessages([$question, $reponse]) ? "Insertion des messages en même temps réussie<br>" : "Impossible d'insérer les messages en même temps<br>";
        echo MessageDAO::deleteMessages() ? "Suppression des éléments dans message<br>" : "Impossible de supprimer tous les messages";
    }

    function launchTestSuite(){
        testUtilisateurDAO();
        testMatiereDAO();
    }

    launchTestSuite();
    echo "<b>Synthèse de la testsuite: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
    | Réussi: <font color='green'>$SUCCES</font> 
    | Échoués: <font color='red'>$ECHEC</font></b><br>";
?>