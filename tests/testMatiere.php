<?php
    require_once("Src/Modele/matiereDAO.php");

    function testInsertUniqueMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        if (MatiereDAO::create($calculMat) !== false){
            $matiereBDD = MatiereDAO::getByNom("calcul matriciel");
            $calculMat->compareTo($matiereBDD) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testInsertPlusieursMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        $algLin = new Matiere(null, "algebre linéraire", "16-03-2022", $daniel->getId(), "M2", "imageAlgebreLineaire.png");
        if(MatiereDAO::create($calculMat) !== false && MatiereDAO::create($algLin)){
            print_r(MatiereDAO::getAll());
            echo"<br>";
            $calculMatBDD = MatiereDAO::getByNom($calculMat->getNom());
            $algLinBDD = MatiereDAO::getByNom($algLin->getNom());
            ($calculMat->compareTo($calculMatBDD) && $algLin->compareTo($algLinBDD)) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testUpdateMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageMatiere.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());
        $calculMat->setNiveau("L2");
        if(MatiereDAO::create($calculMat) !== false){
            $calculMatBDD = MatiereDAO::getByNom("calcul matriciel");
            $calculMat->compareTo($calculMatBDD) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testDeleteRowMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT", "image.png");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3", "imageCalculMatriciel.png");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());
        if(MatiereDAO::delete($calculMat) !== false){
            MatiereDAO::getByNom($calculMat->getNom()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testMatiereDAO(){
        testClearTable("matiere");
        testInsertUniqueMatiere("Insertion d'une unique matière dans la table matiere");
        testInsertPlusieursMatiere("Insertion de plusieurs matières dans la table matiere");
        testUpdateMatiere("Mise à jour d'une matiere dans la table");
        testDeleteRowMatiere("Suppression d'une matière parmi les autres");
    }
?>