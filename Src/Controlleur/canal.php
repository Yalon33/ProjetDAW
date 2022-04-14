<?php
    class Canal
    {
        private $id;
        private $nom;
        private $id_forum;
        private $id_createur;

        private function __construct($id, $nom, $id_forum, $id_createur){
            $this->id = $id;
            $this->nom = $nom;
            $this->id_forum = $id_forum;
            $this->id_createur = $id_createur;
        }
        
        public function getId(){
            return $this->id;
        }

        public function getNom(){
            return $this->nom;
        }

        public function getIdForum(){
            return $this->id_forum;
        }
        
        public function getIdCreateur(){
            return $this->id_createur;
        }
        
        public function setId($id){
            $this->id = $id;
        }

        public function setNom($nom){
            $this->nom = $nom;
        }

        public function setIdForum($id_forum){
            $this->id_forum = $id_forum;
        }

        public function setIdCreateur($id_createur){
            $this->id_createur = $id_createur;
        }
    }
?>