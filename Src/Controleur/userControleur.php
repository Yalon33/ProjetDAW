<?php
    class UserControleur extends Controleur
    {
        public function user()
        {
            $params = [
                'user' => $_SESSION['user']
            ];
            $this->setLayout('home_layout');
            return $this->render('user', $params);
        }
    }


?>