<?php
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

    function testRecuperationUniqueMatiereEtudiant($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("START TRANSACTION");

        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($danielUser);
        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);

        $danielUser = UtilisateurDAO::getByLogin($danielUser->getLogin());
        $danielEtudiant = EtudiantDAO::getById($danielUser->getId());

        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $danielUser->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        MatiereSuivieDAO::create($danielEtudiant, $calculMat, Avancement::ENCOURS);
        $a = MatiereSuivieDAO::getByIdEtuMat($danielEtudiant->getId(), $calculMat->getId());

        if(($res = EtudiantDAO::getMatiereSuivie($danielEtudiant)) !== false && !empty($res)){
            $res[0] == $calculMat ? succeededTest($nomTest) : failedTest($nomTest);
            return;
        }
        failedTest($nomTest);
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
        testRecuperationUniqueMatiereEtudiant("Récupération de l'unique matière suivie par un étudiant");
        testUpdateEtudiant("Mise à jour d'un étudiant dans la table");
        testDeleteRowEtudiant("Suppression d'un étudiant parmi les autres");
    }
?>