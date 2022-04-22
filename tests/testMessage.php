<?php
    require_once("Src/Modele/messageDAO.php");

    function testInsertUniqueMessage($nomTest){
        BDD::query("ALTER TABLE projet.message auto_increment=8");
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
        MessageDAO::getByContenu($interfaceAbstraites->getContenu()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateMessage($nomTest){
        BDD::query("ALTER TABLE projet.message auto_increment=8");
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
        MessageDAO::getByContenu("Les interfaces c'est pas la même chose que les classes abstraites!") !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowMessage($nomTest){
        BDD::query("ALTER TABLE projet.forum auto_increment=4");
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

    function testMessageDAO(){
        testClearTable("message");
        testInsertUniqueMessage("Insertion d'un unique message dans la table message");
        testUpdateMessage("Mise à jour d'un message dans la table");
        testDeleteRowMessage("Suppression d'un message parmi les autres");
    }
?>