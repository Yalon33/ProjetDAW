<?php
    set_include_path("../");
    require_once("tests/testAssociation.php");
    require_once("tests/testCanal.php");
    require_once("tests/testContenu.php");
    require_once("tests/testEtudiant.php");
    require_once("tests/testForum.php");
    require_once("tests/testMatiere.php");
    require_once("tests/testMatiereSuivie.php");
    require_once("tests/testMessage.php");
    require_once("tests/testQCM.php");
    require_once("tests/testReponse.php");
    require_once("tests/testTag.php");
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
            case("contenu"):
                (ContenuDAO::deleteAll() !== false) && (empty(ContenuDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("etudiant"):
                (EtudiantDAO::deleteAll() !== false) && (empty(EtudiantDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("forum"):
                (ForumDAO::deleteAll() !== false) && (empty(ForumDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("matiere"):
                (MatiereDAO::deleteAll() !== false) && (empty(MatiereDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("matiere_suivie"):
                (MatiereSuivieDAO::deleteAll() !== false) && (empty(MatiereSuivieDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("message"):
                (MessageDAO::deleteAll() !== false) && (empty(MessageDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("qcm"):
                (QCMDAO::deleteAll() !== false) && (empty(QCMDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("reponse"):
                (ReponseDAO::deleteAll() !== false) && (empty(ReponseDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("tag"):
                (TagDAO::deleteAll() !== false) && (empty(TagDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("utilisateur"):
                (UtilisateurDAO::deleteAll() !== false) && (empty(UtilisateurDAO::getAll())) ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            default:
                echo "Nom de table '$table' est invalide<br>";
        }
    }

    function launchTestSuite(){
        echo "=============================<b>TestAssociation</b>==============================<br>";
        testAssociationDAO();
        echo "===============================<b>TestCanal</b>================================<br>";
        testCanalDAO();
        echo "==============================<b>TestContenu</b>===============================<br>";
        testContenuDAO();
        echo "==============================<b>TestEtudiant</b>===============================<br>";
        testEtudiantDAO();
        echo "===============================<b>TestForum</b>===============================<br>";
        testForumDAO();
        echo "==============================<b>TestMatiere</b>===============================<br>";
        testMatiereDAO();
        echo "=============================<b>TestMatiereSuivie</b>============================<br>";
        testMatiereSuivieDAO();
        echo "==============================<b>TestMessage</b>===============================<br>";
        testMessageDAO();
        echo "==============================<b>TestQCM</b>=================================<br>";
        testQCMDAO();
        echo "==============================<b>TestReponse</b>==============================<br>";
        testReponseDAO();
        echo "==============================<b>TestTag</b>==================================<br>";
        testTagDAO();
        echo "=============================<b>TestUtilisateur</b>==============================<br>";
        testUtilisateurDAO();
        affiche_resultat();
    }

    launchTestSuite();
?>