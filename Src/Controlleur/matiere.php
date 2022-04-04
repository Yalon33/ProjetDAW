<?php

    include("Niveau.php");

    class Matiere 
    {
        private $id;
        private $nom;
        private $dateCreation;
        private $contenu;
        private $createur;
        private $tags;
        private $niveau;

        private function __construct($id,$nom,$dateCreation,$contenu,$createur,$tags,$niveau)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->dateCreation = $dateCreation;
            $this->contenu = $contenu;
            $this->createur = $createur;
            $this->tags = $tags;
            $this->niveau = $niveau;
            
        }
        //Setter
        public function setId($id)
        {
            $this->id = $id;
        }
        public function setNom($nom)
        {
            $this->nom = $nom;
        }
        public function setDateCreation($dateCreation)
        {
            $this->dateCreation = $dateCreation;
        }
        public function setContenu($contenu)
        {
            $this->contenu = $contenu;
        }
        public function setCreateur($createur)
        {
            $this->createur = $createur;
        }
        public function setTags($tags)
        {
            $this->tags = $tags;
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
        public function getNom()
        {
            return $this->nom;
        }
        public function getDateCreation()
        {
            return $this->dateCreation;
        }
        public function getContenu()
        {
            return $this->contenu;
        }
        public function getCreateur()
        {
            return $this->createur;
        }
        public function getTags()
        {
            return $this->tags;
        }
        public function getNiveau()
        {
            return $this->niveau;
        }
        public function getSimilar($cours): Cours
        {
            
        }
    }
?>