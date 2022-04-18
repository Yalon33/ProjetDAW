<?php
    require_once("canalDAO.php");
    require_once("contenuDAO.php");
    require_once("etudiantDAO.php");
    require_once("forumDAO.php");
    require_once("matiereDAO.php");
    //require_once("messageDAO.php");
    //require_once("qcmDAO.php");
    //require_once("reponseDAO.php");
    require_once("utilisateurDAO.php");
    require_once("tests/testCanal.php");
    require_once("tests/testContenu.php");
    require_once("tests/testEtudiant.php");
    require_once("tests/testForum.php");
    require_once("tests/testMatiere.php");
    //require_once("tests/testMessage.php");
    //require_once("tests/testQCM.php");
    //require_once("tests/testReponse.php");
    require_once("tests/testUtilisateur.php");
    
    $SUCCES = 0;
    $ECHEC = 0;

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

    function affiche_resultat(){
        GLOBAL $SUCCES, $ECHEC;
        echo "<br><b>Synthèse: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
        | Réussi: <font color='green'>$SUCCES</font> 
        | Échoués: <font color='red'>$ECHEC</font></b><br>";
    }

    function testClearTable($table){
        BDD::query("START TRANSACTION;");
        $nomTest = "Nettoyage de la table $table";
        switch ($table){
            case("canal"):
                (CanalDAO::deleteAll() !== false) && (empty(CanalDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            //case("contenu"):
            //    (ContenuDAO::deleteAll() !== false) && (empty(Contenu::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
            //    break;
            case("etudiant"):
                (EtudiantDAO::deleteAll() !== false) && (empty(EtudiantDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("forum"):
                (ForumDAO::deleteAll() !== false) && (empty(ForumDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("matiere"):
                (MatiereDAO::deleteAll() !== false) && (empty(MatiereDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            //case("message"):
            //    (MessageDAO::deleteAll() !== false) && (empty(Message::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
            //    break;
            //case("qcm"):
            //    (QCMDAO::deleteAll() !== false) && (empty(QCM::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
            //    break;
            //case("reponse"):
            //    (ReponseDAO::deleteAll() !== false) && (empty(Reponse::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
            //    break;
            case("utilisateur"):
                (UtilisateurDAO::deleteAll() !== false) && (empty(UtilisateurDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            default:
                echo "Nom de table '$table' est invalide";
        }
    }

    function launchTestSuite(){
        echo "========================TestCanal========================<br>";
        testCanalDAO();
        echo "========================TestContenu========================<br>";
        testContenuDAO();
        echo "========================TestEtudiant========================<br>";
        testEtudiantDAO();
        echo "========================TestForum========================<br>";
        testForumDAO();
        echo "========================TestMatiere========================<br>";
        testMatiereDAO();
        echo "========================TestUtilisateur========================<br>";
        testUtilisateurDAO();
        affiche_resultat();
    }

    launchTestSuite();
?>