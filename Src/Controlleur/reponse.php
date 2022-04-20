<?php
    class Reponse {
        private $id;
        private $id_qcm;
        private $xml;

        public function __construct($id = null, $id_qcm, $xml){
            $this->id = $id;
            $this->id_qcm = $id_qcm;
            $this->xml = $xml;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdQCM(){
            return $this->id_qcm;
        }

        public function getXML(){
            return $this->xml;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdQCM($id_qcm){
            $this->id_qcm = $id_qcm;
        }

        public function setXML($xml){
            $this->xml = $xml;
        }
    }
?>