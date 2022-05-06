<?php
    class AddQcmControleur extends Controleur{
        public function addQcm(){
            $this->setLayout('home_layout');
            return $this->render("/addQcm");
        }
    }
?>