<?php

    include("../Controlleur/niveau.php");

    class Matiere{
        private $id;
        private $nom;
        private $dateCreation;
        private $id_createur;
        private $niveau;

        public function __construct($id = null, $nom, $dateCreation, $id_createur, $niveau){
            $this->id = $id;
            $this->nom = $nom;
            $this->dateCreation = $dateCreation;
            $this->id_createur = $id_createur;
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

        public function setid_createur($id_createur){
            $this->id_createur = $id_createur;
        }

        public function setNiveau($niveau){
            $this->niveau = $niveau;
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
            return $this->id_createur;
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