<?php
    require_once("Src/Modele/qcmDAO.php");

    function testInsertUniqueQCM($nomTest){
        BDD::query("ALTER TABLE projet.qcm auto_increment=3");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $exam = new QCM(null, UtilisateurDAO::getByLogin($daniel->getLogin())->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        QCMDAO::getByQuestions($exam->getQuestions()) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateQCM($nomTest){
        BDD::query("ALTER TABLE projet.qcm auto_increment=3");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $exam = new QCM(null, UtilisateurDAO::getByLogin($daniel->getLogin())->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        $exam = QCMDAO::getByQuestions($exam->getQuestions());
        $exam->setQuestions("Cours/AlgebreLineaire/examBis.xml");
        QCMDAO::create($exam);
        QCMDAO::getByQuestions($exam->getQuestions()) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowQCM($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=3");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $exam = new QCM(null, UtilisateurDAO::getByLogin($daniel->getLogin())->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        $exam = QCMDAO::getByQuestions($exam->getQuestions());
        if (QCMDAO::delete($exam) !== false){
            QCMDAO::getByQuestions($exam->getQuestions()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testQCMDAO(){
        testClearTable("qcm");
        testInsertUniqueQCM("Insertion d'un unique qcm dans la table qcm");
        testUpdateQCM("Mise à jour d'un qcm dans la table");
        testDeleteRowQCM("Suppression d'un qcm parmi les autres");
    }
?>