<?php
    require_once("Src/Modele/messageDAO.php");

    function testInsertUniqueMessage($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.message auto_increment=8");
        BDD::query("ALTER TABLE projet.canal auto_increment=8");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);

        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);

        $interface = new Canal(null, "Interfaces", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($daniel->getLogin())->getId());
        CanalDAO::create($interface);

        $interfaceAbstraites = new Message(null, "Les interfaces c'est pas la même chose que les classes abstraites!",
            CanalDAO::getByNom($interface->getNom())->getId(),
            UtilisateurDAO::getByLogin($daniel->getLogin())->getId()
        );
        MessageDAO::create($interfaceAbstraites);
        $interfaceAbstraites = MessageDAO::getByContenu($interfaceAbstraites->getContenu());

        MessageDAO::getByContenu($interfaceAbstraites->getContenu()) == $interfaceAbstraites ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateMessage($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.message auto_increment=8");
        BDD::query("ALTER TABLE projet.canal auto_increment=8");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);

        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);

        $interface = new Canal(null, "Interfaces", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($daniel->getLogin())->getId());
        CanalDAO::create($interface);

        $interfaceAbstraites = new Message(null, "Les interfaces s'est pas le même chose que les classes abstraites!",
            CanalDAO::getByNom($interface->getNom())->getId(),
            UtilisateurDAO::getByLogin($daniel->getLogin())->getId()
        );
        MessageDAO::create($interfaceAbstraites);
        $interfaceAbstraites->setContenu("Les interfaces c'est pas la même chose que les classes abstraites!");
        MessageDAO::create($interfaceAbstraites);
        $interfaceAbstraites = MessageDAO::getByContenu($interfaceAbstraites->getContenu());

        MessageDAO::getByContenu("Les interfaces c'est pas la même chose que les classes abstraites!") == $interfaceAbstraites ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowMessage($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.message auto_increment=8");
        BDD::query("ALTER TABLE projet.canal auto_increment=8");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);
        $interface = new Canal(null, "Interfaces", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($daniel->getLogin())->getId());
        CanalDAO::create($interface);
        $interfaceAbstraites = new Message(null, "Les interfaces s'est pas le même chose que les classes abstraites!",
            CanalDAO::getByNom($interface->getNom())->getId(),
            UtilisateurDAO::getByLogin($daniel->getLogin())->getId()
        );
        MessageDAO::create($interfaceAbstraites);
        $interfaceAbstraites = MessageDAO::getByContenu($interfaceAbstraites->getContenu());
        MessageDAO::delete($interfaceAbstraites);
        MessageDAO::getByContenu($interfaceAbstraites->getContenu()) === false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testRecuperationCanal($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.message auto_increment=8");
        BDD::query("ALTER TABLE projet.canal auto_increment=8");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);

        $php = new Forum(null, "Langage PHP");
        ForumDAO::create($php);

        $interface = new Canal(null, "Interfaces", ForumDAO::getByNom($php->getNom())->getId(), UtilisateurDAO::getByLogin($daniel->getLogin())->getId());
        CanalDAO::create($interface);
        $interface = CanalDAO::getByNom($interface->getNom());

        $interfaceAbstraites = new Message(null, "Les interfaces s'est pas le même chose que les classes abstraites!",
            CanalDAO::getByNom($interface->getNom())->getId(),
            UtilisateurDAO::getByLogin($daniel->getLogin())->getId()
        );
        $rappelCours = new Message(null, "Il s'agirait de relire le cours",
            CanalDAO::getByNom($interface->getNom())->getId(),
            UtilisateurDAO::getByLogin($daniel->getLogin())->getId()
        );
        MessageDAO::create($interfaceAbstraites);
        MessageDAO::create($rappelCours);
        $interfaceAbstraites = MessageDAO::getByContenu($interfaceAbstraites->getContenu());
        $rappelCours = MessageDAO::getByContenu($rappelCours->getContenu());

        MessageDAO::getByCanal($interface) == array($interfaceAbstraites, $rappelCours) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testMessageDAO(){
        testClearTable("message");
        testInsertUniqueMessage("Insertion d'un unique message dans la table message");
        testRecuperationCanal("Récupération de tous les messages dans un canal");
        testUpdateMessage("Mise à jour d'un message dans la table");
        testDeleteRowMessage("Suppression d'un message parmi les autres");
    }
?>