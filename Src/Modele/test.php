<?php
    require_once("../controlleur/utilisateur.php");
    require_once("matiereDAO.php");
    require_once("messageDAO.php");
    require_once("utilisateurDAO.php");
    require_once("bdd.php");
    $SUCCES = 0;
    $ECHEC = 0;
    /*
    function createData($nomTable, $attributs, $arrayData){
        foreach($arrayData as $data)
        SERVER->insertData("INSERT INTO ".PROJET.".$nomTable($attributs) VALUES(:l, :mdp, :m, :p, :n, :t);", $data);
    }
    */

    function failedTest($nomTest){
        GLOBAL $ECHEC;
        $ECHEC ++;
        echo "[<font color='red'>FAIL</font>] $nomTest<br>";
        BDD::query("ROLLBACK;");
    }

    function succeededTest($nomTest){
        GLOBAL $SUCCES;
        $SUCCES++;
        echo "[<font color='blue'>SUCCES</font>] $nomTest<br>";
        BDD::query("ROLLBACK;");
    }

    function testInsertUnique($nomTest){
        BDD::query("START TRANSACTION;");
        $obj1 = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        if (UtilisateurDAO::create($obj1) !== false){
            $data = UtilisateurDAO::getByLogin('Zokey');
            $obj1->compareTo($data[0]) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testInsertPlusieursUtilisateurs($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        $sasuke = new Utilisateur(null, "xX-Sasuke-Xx", "tropDark", "noir@village.com", "Clément", "Pouilly", "ETUDIANT");
        $arrayUtilisateur = [$daniel, $sasuke];
        UtilisateurDAO::create($daniel);
        UtilisateurDAO::create($sasuke);
        $utilisateurBDD = array(UtilisateurDAO::getByLogin('Zokey')[0], UtilisateurDAO::getByLogin('xX-Sasuke-Xx')[0]);
        for($i = 0; $i < sizeof($arrayUtilisateur); $i++){
            if (!$arrayUtilisateur[$i]->compareTo($utilisateurBDD[$i])){
                failedTest("$nomTest, $utilisateurBDD[$i] n'est pas dans la BDD ou ne correspond pas à $arrayUtilisateur[$i]");
            }
        }
        succeededTest($nomTest);
    }

    /**
    * Comme le serveur incrémente de lui même les identifiants, il est intéressant de voir comment il réagit si
    * on insère un identifiant qui n'est pas dans 'bon'
    */
    function testInsertUtilisateurMauvaisId($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(2, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        try {
            UtilisateurDAO::create($daniel);
            failedTest($nomTest);
        } catch (Exception $e){
            succeededTest($nomTest);
        }
    }

    function testCreationUtilisateurMauvaisType($nomTest){
        BDD::query("START TRANSACTION;");
        try{
            $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudian");
            failedTest($nomTest);
        } catch (Exception $e){
            succeededTest($nomTest);
        }
    }

    function testRecuperationUtilisateurParticulier($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        $sasuke = new Utilisateur(null, "xX-Sasuke-Xx", "tropDark", "noir@village.com", "Clément", "Pouilly", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        UtilisateurDAO::create($sasuke);
        $sasukeBDD = UtilisateurDAO::getByLogin("xX-Sasuke-Xx")[0];
        $sasuke->compareTo($sasukeBDD) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateUtilisateur($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        $danielBDD = UtilisateurDAO::getByLogin($daniel->getLogin())[0];
        $danielBDD->setMail("nouveaumail@mail.com");
        UtilisateurDAO::create($danielBDD);
        UtilisateurDAO::getByLogin($danielBDD->getLogin())[0] ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testClearTable($table){
        BDD::query("START TRANSACTION;");
        $nomTest = "Nettoyage de la table $table";
        switch ($table){
            case("utilisateur"):
                UtilisateurDAO::deleteAll() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("matiere"):
                MatiereDAO::deleteMatieres() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            default:
                echo "Nom de table '$table' est invalide";
        }
    }

    function testDeleteRow($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        $daniel->setId(1);
        if (UtilisateurDAO::delete($daniel) !== false){
            UtilisateurDAO::getByLogin($daniel->getLogin()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testUtilisateurDAO(){
        testClearTable("Nettoyage de la table", "utilisateur");
        testInsertUnique("Insertion d'un unique utilisateur dans la table utilisateur");
        testInsertPlusieursUtilisateurs("Insertion de plusieurs utilisateurs dans la table utilisateur");
        testInsertUtilisateurMauvaisId("Mise à jour d'un utilisateur avec un identifiant qui n'est pas dans l'ordre ne marche pas");
        testCreationUtilisateurMauvaisType("Insertion d'un utilisateur avec un type qui n'existe pas");
        testRecuperationUtilisateurParticulier("Récupération d'un utilisateur dans la BDD qui en contient plusieurs");
        testUpdateUtilisateur("Mise à jour d'un utilisateur dans la table");
        testDeleteRow("Suppression d'un utilisateur parmi les autres");
    }

    function testInsertMatiereUnique(){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
        $calculMat = new Matiere(null, "calcul matriciel", "12/01/2022", "calculMat.txt", $daniel, "mathematique", "L3");
        $nomTest = "Insertion d'une unique matière dans la table matière";
        UtilisateurDAO::create($daniel);
        if (MatiereDAO::create($calculMat) !== false){
            $matiereBDD = MatiereDAO::getAll();
            $calculMat->compareTo($matiereBDD) ? succeededTest($nomTest) : failedTest($nomTest);
        }
        //$matiereBDD = MatiereDAO::getAll();
        //$matiereBDD[0]->compareTo($calculMat) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testInsertPlusieursMatieres(){
//        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
//        $calculMat = new Matiere(null, "calcul matriciel", "12/01/2022", "calculMat.txt", $daniel, "mathematique", "L3");
//        $algebre = new Matiere(null, "algebre", "11/12/2012", "algebreLineraire.txt", $daniel, "mathematique", "L1");
//        $arrayMatiere = [$calculMat, $algebre];
//        foreach($arrayMatiere as $matiere){
//            MatiereDAO::insertMatiere($matiere);
//        }
//        $matieresBDD = MatiereDAO::getAll();
//        for($i = 0; $i < sizeof($arrayMatiere); $i++){
//            if (!$arrayMatiere[$i]->compareTo($matieresBDD[$i])){
//                failedTest("Insertion de plusieurs matières, $matieresBDD[$i] n'est pas dans la BDD");
//                return;
//            }
//        }
//        return;
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
        //testInsertMatiereUnique();
    }

    function testMessageDAO(){
        $question = new Message(null, "Comment on fait le DM?");
        $reponse = new Message(null, "Avec ton cerveau.");
        MessageDAO::insertMessage($question);
        MessageDAO::insertMessage($reponse);
        $allMessage = MessageDAO::getAll();
        $reponseBDD = MessageDAO::getById(2);
        //echo "<pre>";
        //print_r($allMessage);
        //echo "Avec l'identifiant";
        //print_r($reponseBDD);
        //echo "</pre>";
        echo MessageDAO::deleteMessages() ? "Suppression des éléments dans message<br>" : "Impossible de supprimer tous les messages";
        echo MessageDAO::insertMessages([$question, $reponse]) ? "Insertion des messages en même temps réussie<br>" : "Impossible d'insérer les messages en même temps<br>";
        echo MessageDAO::deleteMessages() ? "Suppression des éléments dans message<br>" : "Impossible de supprimer tous les messages";
    }

    function launchTestSuite(){
        testUtilisateurDAO();
        testMatiereDAO();
    }

    launchTestSuite();
    echo "<br><b>Synthèse: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
    | Réussi: <font color='green'>$SUCCES</font> 
    | Échoués: <font color='red'>$ECHEC</font></b><br>";
?>