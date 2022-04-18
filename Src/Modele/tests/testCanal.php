<?php
    function testInsertUniqueCanal($nomTest){
        BDD::query("ALTER TABLE projet.canal auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($danielUser);
        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        try{
            succeededTest($nomTest);
        } catch (Exception){
            failedTest($nomTest);
        }
    }

    function testUpdateCanal($nomTest){
        BDD::query("ALTER TABLE projet.canal auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($danielUser);
        $danielCanal = new Etudiant(null, "L3");
        CanalDAO::create($danielCanal);
        $danielCanal->setId(UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        $danielCanal->setNiveau("M1");
        CanalDAO::create($danielCanal);
        CanalDAO::getById($danielCanal->getId()) === Niveau::M1 ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowCanal($nomTest){
        BDD::query("ALTER TABLE projet.canal auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($danielUser);
        $danielCanal = new Etudiant(null, "L3");
        CanalDAO::create($danielCanal);
        $danielCanal->setId(UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        CanalDAO::delete($danielCanal);
        (CanalDAO::getById($danielCanal->getId()) === false) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testCanalDAO(){
        testClearTable("etudiant");
        //testInsertUniqueCanal("Insertion d'un unique étudiant dans la table etudiant");
        //testUpdateCanal("Mise à jour d'un utilisateur dans la table");
        //testDeleteRowCanal("Suppression d'un étudiant parmi les autres");
    }
?>