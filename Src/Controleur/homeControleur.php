<?php

    class HomeControleur extends Controleur
    {
        public function home()
        {
            $this->setLayout('home_layout');
            return $this->render('home');
        }

        public function handleHome(Request $request)
        {
            
        }
    }

?>