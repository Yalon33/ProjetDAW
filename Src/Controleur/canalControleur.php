<?php
    class CanalControleur extends Controleur
    {
        public function canal()
        {
            $this->setLayout('home_layout');
            return $this->render('canal', []);
        }
    }
?>