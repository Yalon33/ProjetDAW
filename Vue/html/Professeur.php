<?php
    include("Utilisateur.php");
    class Professeur extends Utilisateur
    {
        
        private function __construct($id, $login, $mdp, $mail) {
            parent::__construct($id, $login, $mdp, $mail);

        }
        
        public function creerMatiere($nom)
        {

        }

        public function modifierMatiere($cours)
        {
            
        }

        public function supprimerMatiere($cours)
        {
            
        }

        public function creerEtudiant($nom)
        {
            
        }

        public function modifierMatiere($nom)
        {
            
        }

        public function supprimerMatiere($nom)
        {
            
        }


        public function creerCanalDiscussion($canal)
        {
            
        }

        public function supprimerCanalDiscussion($canal)
        {
            
        }


        public function supprimerMessage($message)
        {
            
        }

        public function afficherCanal($canal)
        {
            
        }

        public function creerQcm($nom)
        {
            
        }
    }




?>