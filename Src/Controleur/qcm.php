<?php
    class QCM {
        private $id;
        private $id_prof;
        private $questions;

        public function __construct($id = null, $id_prof, $questions){
            $this->id = $id;
            $this->id_prof = $id_prof;
            $this->questions = $questions;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdProf(){
            return $this->id_prof;
        }

        public function getQuestions(){
            return $this->questions;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdProf($id_prof){
            $this->id_prof = $id_prof;
        }

        public function setQuestions($questions){
            $this->questions = $questions;
        }
    }
?>