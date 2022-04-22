<?php
    require_once("Src/Modele/matiereSuivieDAO.php");

    function testInsertUniqueMatiereSuivie($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());

        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        $danielEtudiant->setId($daniel->getId());

        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        MatiereSuivieDAO::create($danielEtudiant, $calculMat, Avancement::ENCOURS);

        empty(array_diff(MatiereSuivieDAO::getByIdEtuMat($daniel->getId(), $calculMat->getId()), [$calculMat->getId() => "EN COURS"]))
        ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateMatiereSuivie($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());

        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        $danielEtudiant->setId($daniel->getId());

        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        MatiereSuivieDAO::create($danielEtudiant, $calculMat, Avancement::ENCOURS);
        MatiereSuivieDAO::create($danielEtudiant, $calculMat, Avancement::TERMINE);

        empty(array_diff(MatiereSuivieDAO::getByIdEtuMat($daniel->getId(), $calculMat->getId()), [$calculMat->getId() => "TERMINE"]))
        ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowMatiereSuivie($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());

        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        $danielEtudiant->setId($daniel->getId());

        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        MatiereSuivieDAO::create($danielEtudiant, $calculMat, Avancement::ENCOURS);

        if(MatiereSuivieDAO::delete($daniel, $calculMat) !== false){
            MatiereSuivieDAO::getByIdEtuMat($danielEtudiant->getId(), $calculMat->getId()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testMatiereSuivieDAO(){
        testClearTable("matiere_suivie");
        testInsertUniqueMatiereSuivie("Insertion d'une unique matiere_suivie dans la table matiere_suivie");
        testUpdateMatiereSuivie("Mise à jour d'une matiere_suivie dans la table");
        testDeleteRowMatiereSuivie("Suppression d'une matiere_suivie parmi les autres");
    }
?>