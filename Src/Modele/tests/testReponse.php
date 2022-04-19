<?php
    function testInsertUniqueReponse($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.qcm auto_increment=3");
        BDD::query("ALTER TABLE projet.reponse auto_increment=4");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        UtilisateurDAO::create($daniel);
        $exam = new QCM(null, UtilisateurDAO::getByLogin($daniel->getLogin())->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        $exam = new Reponse(null, QCMDAO::getByQuestions($exam->getQuestions())->getId(), "Cours/AlgebreLineaire/responseExam.xml");
        ReponseDAO::create($exam);
        ReponseDAO::getByXML($exam->getXML()) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateReponse($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.qcm auto_increment=3");
        BDD::query("ALTER TABLE projet.reponse auto_increment=4");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        UtilisateurDAO::create($daniel);
        $exam = new QCM(null, UtilisateurDAO::getByLogin($daniel->getLogin())->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        $repExam = new Reponse(null, QCMDAO::getByQuestions($exam->getQuestions())->getId(), "Cours/AlgebreLineaire/responseExam.xml");
        ReponseDAO::create($repExam);
        $repExam = ReponseDAO::getByXML($repExam->getXML());
        $nouvelleRepQCM = "Cours/AlgebreLineaire/responseExamBis.xml";
        $repExam->setXML($nouvelleRepQCM);
        ReponseDAO::create($repExam);
        ReponseDAO::getByXML($nouvelleRepQCM) !== false ? succeededTest($nomTest) : failedTest($nomTest);

    }

    function testDeleteRowReponse($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.qcm auto_increment=3");
        BDD::query("ALTER TABLE projet.reponse auto_increment=4");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        UtilisateurDAO::create($daniel);
        $daniel->setId(UtilisateurDAO::getByLogin($daniel->getLogin())->getId());
        $exam = new QCM(null, $daniel->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        $exam->setId(QCMDAO::getByQuestions($exam->getQuestions())->getId());
        $repExam = new Reponse(null, $exam->getId(), "Cours/AlgebreLineaire/reponseExam.xml");
        ReponseDAO::create($repExam);
        $repExam = ReponseDAO::getByXML($repExam->getXML());
        if (ReponseDAO::delete($repExam) !== false){
            $b = ReponseDAO::getById($repExam->getId());
            $b === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testReponseDAO(){
        testClearTable("reponse");
        testInsertUniqueReponse("Insertion d'une unique reponse dans la table reponse");
        testUpdateReponse("Mise à jour d'une reponse dans la table");
        testDeleteRowReponse("Suppression d'une reponse parmi les autres");
    }
?>