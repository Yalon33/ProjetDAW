<?php
/*
    function testInsertUniqueContenu($nomTest){
        BDD::query("ALTER TABLE projet.wcontenutilisateur auto_increment=4");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        UtilisateurDAO::create($daniel);
        $exam = new Contenu(null, UtilisateurDAO::getByLogin($daniel->getNom()),"Cours/AlgebreLineaire/exam.xml");
        ContenuDAO::create($exam);
        $examBDD = ContenuDAO::getByQuestions($exam->getQuestions());
        $daniel->compareTo($daniUser) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateContenu($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=4");
        BDD::query("START TRANSACTION;");
        $daniel = new Contenu(null, "Zokey", "1233", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        ContenuDAO::create($daniel);
        $danielBDD = ContenuDAO::getByLogin($daniel->getLogin());
        $danielBDD->setMail("nouveaumail@mail.com");
        ContenuDAO::create($danielBDD);
        ContenuDAO::getByLogin($danielBDD->getLogin()) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowContenu($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=4");
        BDD::query("START TRANSACTION;");
        $daniel = new Contenu(null, "Zokey", "1233", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        ContenuDAO::create($daniel);
        $daniel = ContenuDAO::getByLogin($daniel->getLogin());
        if (ContenuDAO::delete($daniel) !== false){
            ContenuDAO::getByLogin($daniel->getLogin()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testContenuDAO(){
        testClearTable("utilisateur");
        testInsertUniqueContenu("Insertion d'un unique utilisateur dans la table utilisateur");
        //testUpdateContenu("Mise à jour d'un utilisateur dans la table");
        //testDeleteRowContenu("Suppression d'un utilisateur parmi les autres");
    }
*/
?>