<?php
    require_once("Src/Modele/associationDAO.php");

    function testInsertUniqueMatiereContenu($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("ALTER TABLE projet.contenu auto_increment=8");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        $CM4 = new Contenu(null, "CM-04-JAVA.pptx");
        ContenuDAO::create($CM4);
        $CM4 = ContenuDAO::getByUri($CM4->getUri());

        AssociationDAO::createMatiereContenu($calculMat->getId(), $CM4->getId()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testInsertUniqueMatiereTag($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("ALTER TABLE projet.tag auto_increment=7");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        $medecine = new Tag(null, "medecine");
        TagDAO::create($medecine);
        $medecine->setId(TagDAO::getByContenu($medecine->getContenu())->getId());

        AssociationDAO::createMatiereTag($calculMat->getId(), $medecine->getId()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testInsertUniqueParticipantForum($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.forum auto_increment=4");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");

        $algebreLineaire = new Forum(null, "algebre lineaire");
        ForumDAO::create($algebreLineaire);
        $algebreLineaire = ForumDAO::getByNom($algebreLineaire->getNom());

        AssociationDAO::createParticipantForum($daniel->getId(), $algebreLineaire->getId()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }
    
    function terstInsertUniqueReponseUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.qcm auto_increment=3");
        BDD::query("ALTER TABLE projet.reponse auto_increment=4");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");

        $exam = new QCM(null, $daniel->getId(), "Cours/AlgebreLineaire/exam.xml");
        QCMDAO::create($exam);
        $exam->setId(QCMDAO::getByQuestions($exam->getQuestions())->getId());
        $repExam = new Reponse(null, $exam->getId(), "Cours/AlgebreLineaire/reponseExam.xml");
        ReponseDAO::create($repExam);
        $repExam = ReponseDAO::getByXML($repExam->getXML());

        AssociationDAO::createReponseUtilisateur($daniel->getId(), $repExam->getId()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testAssociationDAO(){
        testInsertUniqueMatiereContenu("Insertion d'une association entre matière et contenu dans la table matiere_contenu");
        testInsertUniqueMatiereTag("Insertion d'une association entre matière et tag dans la table matiere_tag");
        testInsertUniqueParticipantForum("Insertion d'une participation au forum dans la table participer_forum");
        terstInsertUniqueReponseUtilisateur("Insertion d'une reponse de la part d'un utilisateur dans la table reponse_utilisateur");
    }
?>