<?php
    class Utilisateur
    {
        
        private $id;
        private $login;
        private $mdp;
        private $mail;

        private function __construct($id2, $login2, $mdp2, $mail2)
        {
            $this->$id=$id2;
            $this->$login=$login2;
            $this->$mdp=$mdp2;
            $this->$mail=$mail2;
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

        public function setId($id2)
        {
            $this->$id=$id2;
        }

        public function setLogin($login2)
        {
            $this->$login=$login2;
        }

        public function setMdp($mdp2)
        {
            $this->$mdp=$mdp2;
        }

        public function setMail($mail2)
        {
            $this->$mail=$mail2;
        }





    }


?>