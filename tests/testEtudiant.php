<?php
    require_once("Src/Modele/etudiantDAO.php");

    function testInsertUniqueEtudiant($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        try{
            succeededTest($nomTest);
        } catch (Exception){
            failedTest($nomTest);
        }
    }

    function testUpdateEtudiant($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        $danielEtudiant->setId(UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        $danielEtudiant->setNiveau("M1");
        EtudiantDAO::create($danielEtudiant);
        EtudiantDAO::getById($danielEtudiant->getId())->getNiveau() === Niveau::M1 ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowEtudiant($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        $danielEtudiant->setId(UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        EtudiantDAO::delete($danielEtudiant);
        (EtudiantDAO::getById($danielEtudiant->getId()) === false) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testEtudiantDAO(){
        testClearTable("etudiant");
        testInsertUniqueEtudiant("Insertion d'un unique étudiant dans la table etudiant");
        testUpdateEtudiant("Mise à jour d'un étudiant dans la table");
        testDeleteRowEtudiant("Suppression d'un étudiant parmi les autres");
    }
?>