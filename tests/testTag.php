<?php
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

    function testTagDAO(){
        testClearTable("tag");
        testInsertUniqueTag("Insertion d'une unique tag dans la table tag");
        testUpdateTag("Mise à jour d'une tag dans la table");
        testDeleteRowTag("Suppression d'une tag parmi les autres");
    }
?>