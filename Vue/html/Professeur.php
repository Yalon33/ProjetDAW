<?php
    include("Utilisateur.php");
    class Professeur extends Utilisateur
    {
        
        private function __construct($id2, $login2, $mdp2, $mail2) {
            parent::__construct($id2, $login2, $mdp2, $mail2);

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