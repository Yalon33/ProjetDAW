<?php
    include("utilisateur.php");
    include("Niveau.php");
    class Etudiant
    {
        private $niveau;
        private $matiereSuivies;

        //Constructeur
        private function __construct($niveau, $matiereSuivies)
        {
            $this->niveau = $niveau;
            $this->matiereSuivies = $matiereSuivies;
        }

        //Setter
        public function setNiveau($niveau)
        {
            $this->niveau = $niveau;
        }
        public function setMatieres($matiereSuivies)
        {
            $this->matiereSuivies = $matiereSuivies;
        }

        //Getter
        public function getNiveau()
        {
            return $this->niveau;
        }
        public function getMatieresSuivies()
        {
            return $this->matiereSuivies;
        }


        public function suivreCours($Matiere): void
        {
        }

        public function ecrireMessage($string): void
        {
        }

        public function modifierMessage($Matiere): void
        {
        }

        public function repondreQCM($qcm): void
        {
        }

    }

?>
