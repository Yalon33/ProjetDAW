<?php
    class Utilisateur
    {
        
        private $id;
        private $login;
        private $mdp;
        private $mail;

        private function __construct($id, $login, $mdp, $mail)
        {
            $this->id = $id;
            $this->login = $login;
            $this->mdp = $mdp;
            $this->mail = $mail;
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
    }
?>