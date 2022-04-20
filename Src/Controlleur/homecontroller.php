<?php

    class HomeController extends Controller
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