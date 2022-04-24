<?php
    require_once("Src/Modele/tagDAO.php");

    function testInsertUniqueTag($nomTest){
        BDD::query("ALTER TABLE projet.tag auto_increment=7");
        BDD::query("START TRANSACTION;");

        $medecine = new Tag(null, "Medecine");
        TagDAO::create($medecine);
        TagDAO::getByContenu($medecine->getContenu()) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testUpdateTag($nomTest){
        BDD::query("ALTER TABLE projet.tag auto_increment=7");
        BDD::query("START TRANSACTION;");

        $medecine = new Tag(null, "medecine");
        TagDAO::create($medecine);

        $nomMedecine = "Medecine";
        $medecine->setContenu($nomMedecine);
        TagDAO::create($medecine);

        TagDAO::getByContenu($nomMedecine) !== false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testDeleteRowTag($nomTest){
        BDD::query("ALTER TABLE projet.tag auto_increment=7");
        BDD::query("START TRANSACTION;");

        $medecine = new Tag(null, "medecine");
        TagDAO::create($medecine);
        $medecine->setId(TagDAO::getByContenu($medecine->getContenu())->getId());

        TagDAO::delete($medecine);

        TagDAO::getByContenu($medecine->getContenu()) === false ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testRecuperationTagMatiere($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("ALTER TABLE projet.matiere auto_increment=3");
        BDD::query("ALTER TABLE projet.tag auto_increment=7");
        BDD::query("START TRANSACTION;");

        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");

        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());

        $medecine = new Tag(null, "medecine");
        TagDAO::create($medecine);
        $medecine->setId(TagDAO::getByContenu($medecine->getContenu())->getId());

        AssociationDAO::createMatiereTag($calculMat->getId(), $medecine->getId());

        TagDao::getByMatiere($calculMat) == array($medecine) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testTagDAO(){
        testClearTable("tag");
        testInsertUniqueTag("Insertion d'une unique tag dans la table tag");
        testRecuperationTagMatiere("Récupération des tags associés à une matière");
        testUpdateTag("Mise à jour d'une tag dans la table");
        testDeleteRowTag("Suppression d'une tag parmi les autres");
    }
?>