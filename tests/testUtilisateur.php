<?php
    require_once("Src/Modele/utilisateurDAO.php");

    function testInsertUniqueUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        if (UtilisateurDAO::create($daniel) !== false){
            $daniUser = UtilisateurDAO::getByLogin($daniel->getLogin());
            $daniel->compareTo($daniUser) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testCreationUtilisateurMauvaisType($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        try{
            $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudian", "image.png");
            failedTest($nomTest);
        } catch (Exception){
            succeededTest($nomTest);
        }
    }

    function testUpdateUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $danielBDD = UtilisateurDAO::getByLogin($daniel->getLogin());
        $danielBDD->setMail("nouveaumail@mail.com");
        UtilisateurDAO::create($danielBDD);
        UtilisateurDAO::getByLogin($danielBDD->getLogin()) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        if (UtilisateurDAO::delete($daniel) !== false){
            UtilisateurDAO::getByLogin($daniel->getLogin()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testUtilisateurDAO(){
        testClearTable("utilisateur");
        testInsertUniqueUtilisateur("Insertion d'un unique utilisateur dans la table utilisateur");
        //testCreationUtilisateurMauvaisType("Insertion d'un utilisateur avec un type qui n'existe pas");
        testUpdateUtilisateur("Mise à jour d'un utilisateur dans la table");
        testDeleteRowUtilisateur("Suppression d'un utilisateur parmi les autres");
    }
?>