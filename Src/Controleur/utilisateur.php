<?php
    include("Src/Controleur/typeUtilisateur.php");
    class Utilisateur
    {
        private $id;
        private $login;
        private $mdp;
        private $mail;
        private $prenom;
        private $nom;
        private $type;
        private $image;


        public function __construct($id = null, $login, $mdp, $mail, $prenom, $nom, $stringType, $image)
        {
            $this->id = $id;
            $this->login = $login;
            $this->mdp = $mdp;
            $this->mail = $mail;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->type = TypeUtilisateur::toType($stringType);
            $this->image = $image;
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

        public function getPrenom(){
            return $this->prenom;
        }

        public function getNom(){
            return $this->nom;
        }

        public function getType(){
            return $this->type;
        }

        public function getImage(){
            return $this->image;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
        public function setLogin($login)
        {
            $this->login = $login;
        }

        public function setMdp($mdp)
        {
            $this->mdp = $mdp;
        }

        public function setMail($mail)
        {
            $this->mail = $mail;
        }

        public function setPrenom($prenom)
        {
            $this->prenom = $prenom;
        }

        public function setNom($nom)
        {
            $this->nom = $nom;
        }

        public function setType($type)
        {
            $this->type = $type;
        }

        public function setImage($image){
            $this->image = $image;
        }

        public function compareTo($user){
            $res = ($this->getlogin() == $user->getLogin() && $this->getMdp() == $user->getMdp() && $this->getMail() == $user->getMail()
                    && $this->getPrenom() == $user->getPrenom() && $this->getNom() == $user->getNom() && TypeUtilisateur::toString($this->getType()) == TypeUtilisateur::toString($user->getType()));
            return $res;
        }
    }
?>