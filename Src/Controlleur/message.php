<?php
    class Message {
        private $id;
        private $contenu;
        private $id_canal;
        private $id_auteur;

        public function __construct($id = null, $contenu, $id_canal, $id_auteur){
            $this->id = $id;
            $this->contenu = $contenu;
            $this->id_canal = $id_canal;
            $this->id_auteur = $id_auteur;
        }
        
        public function getId(){
            return $this->id;
        }

        public function getContenu(){
            return $this->contenu;
        }

        public function getIdCanal(){
            return $this->id_canal;
        }

        public function getIdAuteur(){
            return $this->id_auteur;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setContenu($contenu){
            $this->contenu = $contenu;
        }

        public function setIdCanal($id_canal){
            $this->id_canal = $id_canal;
        }

        public function setIdAuteur($id_auteur){
            $this->id_auteur = $id_auteur;
        }
    }
?>