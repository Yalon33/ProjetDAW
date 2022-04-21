<?php
    require_once("utilisateur.php");
    require_once("Niveau.php");
    class Etudiant extends Utilisateur
    {
        private $id;
        private $niveau;


        //Constructeur
        public function __construct($id = null, $niveau){
            $this->id = $id;
            $this->niveau = gettype($niveau) == "string" ? Niveau::toType($niveau) : $niveau;
        }

        //Setter
        public function setId($id){
            $this->id = $id;
        }

        public function setNiveau($niveau){
            gettype($niveau) == "string" ? $this->niveau = Niveau::toType($niveau) : $this->niveau = $niveau;
        }

        //Getter
        public function getId(){
            return $this->id;
        }

        public function getNiveau(){
            return $this->niveau;
        }
    }

?>
