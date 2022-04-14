<?php
    include("utilisateur.php");
    include("Niveau.php");
    class Etudiant extends Utilisateur
    {
        private $id;
        private $niveau;

        //Constructeur
        private function __construct($id = null, $niveau)
        {
            $this->id = $id;
            $this->niveau = $niveau;
        }

        //Setter
        public function setId($id)
        {
            $this->id = $id;
        }
        public function setNiveau($niveau)
        {
            $this->niveau = $niveau;
        }

        //Getter
        public function getId()
        {
            return $this->id;
        }
        public function getNiveau()
        {
            return $this->niveau;
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
