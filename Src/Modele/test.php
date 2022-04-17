<?php
    require_once("utilisateurDAO.php");
    require_once("etudiantDAO.php");
    require_once("matiereDAO.php");
    require_once("tests/testUtilisateur.php");
    require_once("tests/testEtudiant.php");
    require_once("tests/testMatiere.php");
    require_once("tests/resultat.php");

    function launchTestSuite(){
        testUtilisateurDAO();
        testMatiereDAO();
        testEtudiantDAO();
        affiche_resultat();
    }

    launchTestSuite();
?>