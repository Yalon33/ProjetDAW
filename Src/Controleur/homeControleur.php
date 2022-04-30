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

        public function pageattend(Request $request)
        {
            $this->setLayout('home_layout');
            return $this->render('pageAttend');
        }

        public function pageattend1(Request $request)
        {
            // $this->setLayout('home_layout');
            // return $this->render('pageAttend');
            header("Location :/pageAttend");
        }
    }

?>