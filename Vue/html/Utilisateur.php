<?php
    class Utilisateur
    {
        
        private $id;
        private $login;
        private $mdp;
        private $mail;

        private function __construct($id, $login, $mdp, $mail)
        {
            $this->$id=$id;
            $this->$login=$login;
            $this->$mdp=$mdp;
            $this->$mail=$mail;
        }

        public function getId()
        {
            return $id;
        }

        public function getLogin()
        {
            return $login;
        }

        public function getMdp()
        {
            return $mdp;
        }

        public function getMail()
        {
            return $mail;
        }

        public function setId($id)
        {
            $this->$id=$id;
        }

        public function setLogin($login)
        {
            $this->$login=$login;
        }

        public function setMdp($mdp)
        {
            $this->$mdp=$mdp;
        }

        public function setMail($mail)
        {
            $this->$mail=$mail;
        }





    }


?>