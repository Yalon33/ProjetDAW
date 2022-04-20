<?php
    function testInsertUniqueCanal($nomTest){
        BDD::query("ALTER TABLE projet.canal auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);
        $interface = new Canal(null, "Interface", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        CanalDAO::create($interface);
        CanalDAO::getByNom($interface->getNom()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateCanal($nomTest){
        BDD::query("ALTER TABLE projet.canal auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);
        $interface = new Canal(null, "Interface", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        CanalDAO::create($interface);
        $interface->setId(CanalDAO::getByNom($interface->getNom())->getId());
        $newName = "interfaces";
        $interface->setNom($newName);
        CanalDAO::create($interface);
        CanalDAO::getByNom($newName) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowCanal($nomTest){
        BDD::query("ALTER TABLE projet.canal auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);
        $interface = new Canal(null, "Interface", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($danielUser->getLogin())->getId());
        CanalDAO::create($interface);
        $interface->setId(CanalDAO::getByNom($interface->getNom())->getId());
        CanalDAO::delete($interface);
        (CanalDAO::getById($interface->getId()) === false) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testCanalDAO(){
        testClearTable("canal");
        testInsertUniqueCanal("Insertion d'un unique canal dans la table canal");
        testUpdateCanal("Mise à jour d'un canal dans la table");
        testDeleteRowCanal("Suppression d'un canal parmi les autres");
    }
?>