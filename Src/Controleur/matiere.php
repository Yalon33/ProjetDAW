<?php

    require_once("Src/Controleur/niveau.php");

    class Matiere{
        private $id;
        private $nom;
        private $dateCreation;
        private $createur;
        private $niveau;
        private $image;

        public function __construct($id = null, $nom, $dateCreation, $createur, $niveau, $image){
            $this->id = $id;
            $this->nom = $nom;
            $this->dateCreation = $dateCreation;
            $this->createur = $createur;
            $this->niveau = is_string($niveau) ? Niveau::toType($niveau) : $niveau;
            $this->image = $image;
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

        public function setImage($image){
            $this->image = $image;
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

        public function getImage(){
            return $this->image;
        }

        public function compareTo($mat){
            return ($mat->getNom() === $this->getNom()
                    && $mat->getDateCreation() === $this->getDateCreation()
                    && $mat->getIdCreateur() == $this->getIdCreateur()
                    && Niveau::toString($mat->getNiveau()) === Niveau::toString($this->getNiveau()));
        }
    }
?>