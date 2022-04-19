<?php

    require_once("avancement.php");

    class MatiereSuivie{
        private $id_etu;
        private $id_mat;
        private $avancement;

        public function __construct($id_etu, $id_mat, $avancement){
            $this->id_etu = $id_etu;
            $this->id_mat = $id_mat;
            $this->avancement = is_string($avancement) ? Avancement::toType($avancement) : $avancement;
        }

        public function getIdEtu(){
            return $this->id_etu;
        }
        
        public function getIdMat(){
            return $this->id_mat;
        }
        
        public function getAvancement(){
            return $this->avancement;
        }

        public function setIdEtu($id_etud){
            $this->id_etud = $id_etud;
        }

        public function setIdMat($id_mat){
            $this->id_mat = $id_mat;
        }

        public function setAvancement($avancement){
            $this->avancement = $avancement;
        }
    }
?>