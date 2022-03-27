<?php
    
    class Canal
    {
        private $id;
        private $nom;
        private $participant


        public function getId()
        {
            return $this->$id;
        }

        public function getNom()
        {
            return $this->$nom;
        }

        public function getParticipant()
        {
            return $this->$participant;
        }
        
        public function setId($id)
        {
            $this->$id=$id;
        }

        public function setNom($nom)
        {
            $this->$nom=$nom;
        }
        public function setParticipant($participant)
        {
            $this->$participant=$participant;
        }
    }



?>
