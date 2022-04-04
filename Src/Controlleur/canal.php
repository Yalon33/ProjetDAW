<?php
    class Canal
    {
        private $id;
        private $nom;
        private $participant;

        private function __construct($id,$nom,$participant)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->participant = $participant;
        }
        
        public function getId()
        {
            return $this->id;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getParticipant()
        {
            return $this->participant;
        }
        
        public function setId($id)
        {
            $this->id=$id;
        }

        public function setNom($nom)
        {
            $this->nom=$nom;
        }
        public function setParticipant($participant)
        {
            $this->participant=$participant;
        }
    }
?>