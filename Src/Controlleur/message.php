<?php
    class Message 
    {
        private $id;
        private $contenu;

        public function __construct($id = null,$contenu)
        {
            $this->id = $id;
            $this->contenu = $contenu;
        }
        public function getId()
        {
            return $this->id;
        }
        public function getContenu()
        {
            return $this->contenu;
        }
        public function setId($id)
        {
            $this->id=$id;
        }
        public function setContenu($contenu)
        {
            $this->contenu = $contenu;
        }
    }
?>