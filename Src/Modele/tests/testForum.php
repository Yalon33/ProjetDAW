<?php
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

    function testForumDAO(){
        testClearTable("forum");
        testInsertUniqueForum("Insertion d'un unique forum dans la table forum");
        testUpdateForum("Mise à jour d'un forum dans la table");
        testDeleteRowForum("Suppression d'un forum parmi les autres");
    }
?>