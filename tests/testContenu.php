<?php
    require_once("Src/Modele/contenuDAO.php");

    function testInsertUniqueContenu($nomTest){
        BDD::query("ALTER TABLE projet.contenu auto_increment=4");
        BDD::query("START TRANSACTION;");
        $CM4 = new Contenu(null, "CM-04-JAVA.pptx");
        ContenuDAO::create($CM4);
        ContenuDAO::getByUri($CM4->getUri()) !== false? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateContenu($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=4");
        BDD::query("START TRANSACTION;");
        $CM4 = new Contenu(null, "CM-04-JAVA.pptx");
        ContenuDAO::create($CM4);
        $CM4BDD = ContenuDAO::getByUri($CM4->getUri());
        $CM4BDD->setUri("CM-05-JAVA.pptx");
        ContenuDAO::create($CM4BDD);
        ContenuDAO::getByUri("CM-05-JAVA.pptx") !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowContenu($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=4");
        BDD::query("START TRANSACTION;");
        $CM4 = new Contenu(null, "CM-04-JAVA.pptx");
        ContenuDAO::create($CM4);
        $daniel = ContenuDAO::getByUri($CM4->getUri());
        if (ContenuDAO::delete($daniel) !== false){
            ContenuDAO::getByUri($daniel->getUri()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testRecuperationContenuUniqueMatiere($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("ALTER TABLE projet.contenu auto_increment=8");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");

    }

    function testContenuDAO(){
        testClearTable("contenu");
        testInsertUniqueContenu("Insertion d'un unique contenu dans la table contenu");
        //testRecuperationContenuUniqueMatiere("Récupération du contenu d'une matière");
        testUpdateContenu("Mise à jour d'un contenu dans la table");
        testDeleteRowContenu("Suppression d'un contenu parmi les autres");
    }
?>