<?php
    require_once("../controlleur/utilisateur.php");
    require_once("matiereDAO.php");
    require_once("messageDAO.php");
    require_once("utilisateurDAO.php");
    require_once("index.php");
    //define("PROJET", "projet");
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
        reCreateTableProjet();
    }

    function succeededTest($nomTest){
        GLOBAL $SUCCES;
        $SUCCES++;
        echo "[<font color='blue'>SUCCES</font>] $nomTest<br>";
        reCreateTableProjet();

    }


    function testInsertUtilisateurUnique(){
        $nomTest = "Insertion d'un unique utilisateur dans la table utilisateur";
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
        if (UtilisateurDAO::createUtilisateur($daniel) !== false){
            $data = UtilisateurDAO::getAllUtilisateurs();
            $daniel->compareTo($data[0]) ? succeededTest($nomTest) : failedTest($nomTest);
        }
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
    function testInsertUtilisateurMauvaisId(){
        $nomTest = "Insertion d'un utilisateur avec un identifiant qui n'est pas dans l'ordre ne marche pas";
        $daniel = new Utilisateur(2, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Professeur");
        UtilisateurDAO::createUtilisateur($daniel) === false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testCreationUtilisateurMauvaisType(){
        $nomTest = "Insertion d'un utilisateur avec un identifiant qui n'est pas dans l'ordre ne marche pas";
        try{
            $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudian");
            failedTest($nomTest);
        } catch (Exception $e){
            succeededTest($nomTest);
        }
    }

    function testRecuperationUtilisateurParticulier(){
        $nomTest = "Récupération d'un utilisateur dans la BDD qui en contient plusieurs";
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudiant");
        $sasuke = new Utilisateur(null, "xX-Sasuke-Xx", "tropDark", "noir@village.com", "Clément", "Pouilly", "Etudiant");
        UtilisateurDAO::createUtilisateur($daniel);
        UtilisateurDAO::createUtilisateur($sasuke);
        $sasukeBDD = UtilisateurDAO::getUtilisateurByLogin("xX-Sasuke-Xx")[0];
        $sasuke->compareTo($sasukeBDD) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateUtilisateur(){
        $nomTest = "Mise à jour d'un utilisateur dans la table";
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudiant");
        UtilisateurDAO::createUtilisateur($daniel);
        $daniel->setId(1);
        $daniel->setMail("nouveaumail@mail.com");
        UtilisateurDAO::createUtilisateur($daniel);
        $danielBDD = UtilisateurDAO::getAllUtilisateurs()[0];
        $daniel->compareTo($danielBDD) ? succeededTest($nomTest) : failedTest($nomTest);
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

    function testDeleteRow(){
        $nomTest = "Suppression d'un utilisateur parmi les autres";
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudiant");
        $sasuke = new Utilisateur(null, "xX-Sasuke-Xx", "tropDark", "noir@village.com", "Clément", "Pouilly", "Etudiant");
        UtilisateurDAO::createUtilisateur($daniel);
        $daniel->setId(1);
        UtilisateurDAO::createUtilisateur($sasuke);
        $sasuke->setId(2);
        if (UtilisateurDAO::deleteUtilisateur($daniel) !== false){
            $data = UtilisateurDAO::getAllUtilisateurs();
            $sasuke->compareTo($data[0]) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testUtilisateurDAO(){
        testClearTable("utilisateur");
        testInsertUtilisateurUnique();
        testInsertPlusieursUtilisateurs();
        testInsertUtilisateurMauvaisId();
        testCreationUtilisateurMauvaisType();
        testRecuperationUtilisateurParticulier();
        testUpdateUtilisateur();
        testDeleteRow();
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
        testInsertMatiereUnique();
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