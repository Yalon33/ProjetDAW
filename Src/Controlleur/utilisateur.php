<?php
    include("typeUtilisateur.php");
    class Utilisateur
    {
        private $id;
        private $login;
        private $mdp;
        private $mail;
        private $prenom;
        private $nom;
        private $type;


        public function __construct($id = null, $login, $mdp, $mail, $prenom, $nom, $stringType)
        {
            $this->id = $id;
            $this->login = $login;
            $this->mdp = $mdp;
            $this->mail = $mail;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->type = TypeUtilisateur::toType($stringType);
        }
        
        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $val){
            $this->$attr = $val;
        }
        public function getId()
        {
            return $this->id;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function getMdp()
        {
            return $this->mdp;
        }

        public function getMail()
        {
            return $this->mail;
        }

        public function getType()
        {
            return $this->type;
        }

        public function setId($id)
        {
            $this->id=$id;
        }
        public function setLogin($login)
        {
            $this->login=$login;
        }

        public function setMdp($mdp)
        {
            $this->mdp=$mdp;
        }

        public function setMail($mail)
        {
            $this->mail=$mail;
        }

        public function setType($type)
        {
            $this->type = $type;
        }
    }
?>