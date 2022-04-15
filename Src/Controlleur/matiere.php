<?php

    require_once("../Controlleur/niveau.php");

    class Matiere{
        private $id;
        private $nom;
        private $dateCreation;
        private $createur;
        private $niveau;

        public function __construct($id = null, $nom, $dateCreation, $createur, $niveau){
            $this->id = $id;
            $this->nom = $nom;
            $this->dateCreation = $dateCreation;
            $this->createur = $createur;
            $this->niveau = Niveau::toType($niveau);
        }

        //Setter
        public function setId($id){
            $this->id = $id;
        }
        
        public function setNom($nom){
            $this->nom = $nom;
        }

        public function setDateCreation($dateCreation){
            $this->dateCreation = $dateCreation;
        }

        public function setCreateur($createur){
            $this->createur = $createur;
        }

        public function setNiveau($niveau){
            gettype($niveau) == "string" ? $this->niveau = Niveau::toType($niveau) : $this->niveau = $niveau;
        }

        //Getter
        public function getId(){
            return $this->id;
        }

        public function getNom(){
            return $this->nom;
        }

        public function getDateCreation(){
            return $this->dateCreation;
        }

        public function getIdCreateur(){
            return $this->createur;
        }

        public function getNiveau(){
            return $this->niveau;
        }

        public function compareTo($mat){
            return ($mat->getNom() === $this->getNom()
                    && $mat->getDateCreation() === $this->getDateCreation()
                    && $mat->getIdCreateur() == $this->getIdCreateur()
                    && Niveau::toString($mat->getNiveau()) === Niveau::toString($this->getNiveau()));
        }
    }
?>