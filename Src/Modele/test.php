<?php
    require_once("bdd.php");
    require_once("etudiantDAO.php");
    require_once("matiereDAO.php");
    require_once("utilisateurDAO.php");
    $SUCCES = 0;
    $ECHEC = 0;

    function failedTest($nomTest){
        GLOBAL $ECHEC;
        $ECHEC ++;
        echo "[<font color='red'>FAIL</font>] $nomTest<br>";
        BDD::query("ROLLBACK;");
    }

    function succeededTest($nomTest){
        GLOBAL $SUCCES;
        $SUCCES++;
        echo "[<font color='blue'>SUCCES</font>] $nomTest<br>";
        BDD::query("ROLLBACK;");
    }

    function testInsertUniqueUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        if (UtilisateurDAO::create($daniel) !== false){
            $daniUser = UtilisateurDAO::getByLogin($daniel->getLogin());
            $daniel->compareTo($daniUser) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testCreationUtilisateurMauvaisType($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        try{
            $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "Etudian");
            failedTest($nomTest);
        } catch (Exception){
            succeededTest($nomTest);
        }
    }

    function testUpdateUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        $danielBDD = UtilisateurDAO::getByLogin($daniel->getLogin());
        $danielBDD->setMail("nouveaumail@mail.com");
        UtilisateurDAO::create($danielBDD);
        UtilisateurDAO::getByLogin($danielBDD->getLogin()) ? succeededTest($nomTest) : failedTest($nomTest);
    }

    function testClearTable($table){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $nomTest = "Nettoyage de la table $table";
        switch ($table){
            case("utilisateur"):
                UtilisateurDAO::deleteAll() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("matiere"):
                MatiereDAO::deleteAll() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            case("etudiant"):
                EtudiantDAO::deleteAll() ? succeededTest($nomTest) : failedTest($nomTest);
                break;
            default:
                echo "Nom de table '$table' est invalide";
        }
    }

    function testDeleteRowUtilisateur($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        if (UtilisateurDAO::delete($daniel) !== false){
            UtilisateurDAO::getByLogin($daniel->getLogin()) === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testUtilisateurDAO(){
        testClearTable("utilisateur");
        testInsertUniqueUtilisateur("Insertion d'un unique utilisateur dans la table utilisateur");
        testCreationUtilisateurMauvaisType("Insertion d'un utilisateur avec un type qui n'existe pas");
        testUpdateUtilisateur("Mise à jour d'un utilisateur dans la table");
        testDeleteRowUtilisateur("Suppression d'un utilisateur parmi les autres");
    }

    function testInsertUniqueEtudiant($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($danielUser);
        $danielEtudiant = new Etudiant(null, "L3");
        EtudiantDAO::create($danielEtudiant);
        try{
            succeededTest($nomTest);
        } catch (Exception){
            failedTest($nomTest);
        }
    }

    function testUpdateEtudiant($nomTest){
        BDD::query("ALTER TABLE projet.utilisateur auto_increment=5");
        BDD::query("START TRANSACTION;");
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
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
        $danielUser = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
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
        testUpdateEtudiant("Mise à jour d'un utilisateur dans la table");
        testDeleteRowEtudiant("Suppression d'un étudiant parmi les autres");
    }

    function testInsertUniqueMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin("Zokey");
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3");
        if (MatiereDAO::create($calculMat) !== false){
            $matiereBDD = MatiereDAO::getByNom("calcul matriciel");
            $calculMat->compareTo($matiereBDD) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testInsertPlusieursMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "PROFESSEUR");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3");
        $algLin = new Matiere(null, "algebre linéraire", "16-03-2022", $daniel->getId(), "M2");
        if(MatiereDAO::create($calculMat) !== false && MatiereDAO::create($algLin)){
            $calculMatBDD = MatiereDAO::getByNom($calculMat->getNom());
            $algLinBDD = MatiereDAO::getByNom($algLin->getNom());
            ($calculMat->compareTo($calculMatBDD) && $algLin->compareTo($algLinBDD)) ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testUpdateMatiere($nomTest){
        BDD::query("START TRANSACTION;");
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3");
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
        $daniel = new Utilisateur(null, "Zokey", "1234", "mail@mail.com", "Daniel", "Pinson", "ETUDIANT");
        UtilisateurDAO::create($daniel);
        $daniel = UtilisateurDAO::getByLogin($daniel->getLogin());
        $calculMat = new Matiere(null, "calcul matriciel", "12-01-2022", $daniel->getId(), "L3");
        MatiereDAO::create($calculMat);
        $calculMat = MatiereDAO::getByNom($calculMat->getNom());
        if(MatiereDAO::delete($calculMat) !== false){
            $a = MatiereDAO::getByNom($calculMat->getNom());
            $a === false ? succeededTest($nomTest) : failedTest($nomTest);
        }
    }

    function testMatiereDAO(){
        testClearTable("matiere");
        testInsertUniqueMatiere("Insertion d'une unique matière dans la table matiere");
        testInsertPlusieursMatiere("Insertion de plusieurs matières dans la table matiere");
        testUpdateMatiere("Mise à jour d'une matiere dans la table");
        testDeleteRowMatiere("Suppression d'une matière parmi les autres");
    }

    function launchTestSuite(){
        testUtilisateurDAO();
        testMatiereDAO();
        testEtudiantDAO();
    }

    launchTestSuite();

    echo "<br><b>Synthèse: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
    | Réussi: <font color='green'>$SUCCES</font> 
    | Échoués: <font color='red'>$ECHEC</font></b><br>";
?>