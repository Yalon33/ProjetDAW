<?php
    // A supprimer?
    include("StatusCours.php");

    class etudiantMatiere 
    {
        private $avancement;

        private function __construct($avancement)
        {
            $this->avancement=$avancement;
        }

        public function getAvancement()
        {
            return $this->avancement;
        }

        public function setCanaux($avancement)
        {
            $this->canaux=$avancement;
        }
    }
?>