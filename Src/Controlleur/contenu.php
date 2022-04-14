<?php
    class Contenu{
        private $id;
        private $uri;

        public function __construct($id, $uri){
            $this->id = $id;
            $this->uri = $uri;
        }

        public function getId(){
            return $this->id;
        }

        public function getUri(){
            return $this->uri;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setUri($uri){
            $this->uri = $uri;
        }
    }
?>