<?php
    require_once("Src/Modele/forumDAO.php");

    function testInsertUniqueForum($nomTest){
        BDD::query("ALTER TABLE projet.forum auto_increment=4");
        BDD::query("START TRANSACTION;");
        $algebreLineaire = new Forum(null, "algebre lineaire");
        ForumDAO::create($algebreLineaire);
        ForumDAO::getByNom($algebreLineaire->getNom()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateForum($nomTest){
        BDD::query("ALTER TABLE projet.forum auto_increment=4");
        BDD::query("START TRANSACTION;");
        $algebreLineaire = new Forum(null, "algebre line");
        ForumDAO::create($algebreLineaire);
        $algebreLineaire->setNom("algebre lineaire");
        ForumDAO::create($algebreLineaire);
        ForumDAO::getByNom("algebre lineaire") !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowForum($nomTest){
        BDD::query("ALTER TABLE projet.forum auto_increment=4");
        BDD::query("START TRANSACTION;");
        $algebreLineaire = new Forum(null, "algebre lineaire");
        ForumDAO::create($algebreLineaire);
        $algebreLineaire = ForumDAO::getByNom($algebreLineaire->getNom());
        ForumDAO::delete($algebreLineaire);
        ForumDAO::getById(4) === false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testForumUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.forum auto_increment=4");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");

        $algebreLineaire = new Forum(null, "algebre lineaire");
        ForumDAO::create($algebreLineaire);
        $algebreLineaire = ForumDAO::getByNom($algebreLineaire->getNom());

        AssociationDAO::createParticipantForum($daniel->getId(), $algebreLineaire->getId());

        ForumDAO::getByUser($daniel) == array($algebreLineaire) ? succeededTest($nomTest) : failedTest($nomTest);       
    }

    function testForumDAO(){
        testClearTable("forum");
        testInsertUniqueForum("Insertion d'un unique forum dans la table forum");
        testForumUtilisateur("Récupération d'un forum auquel participe un utilisateur");
        testUpdateForum("Mise à jour d'un forum dans la table");
        testDeleteRowForum("Suppression d'un forum parmi les autres");
    }
?>