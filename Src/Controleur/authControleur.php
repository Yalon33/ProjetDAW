<?php

    class AuthControleur extends Controleur
    {

        public function login()
        {
            $this->setLayout('login_layout');
            return $this->render('login', ['error' => '']);
        }

        public function handleLogin(Request $request)
        {
            $data = $request->getData();
            $u = UtilisateurDAO::getByLogin($data['login_form']);
            if(empty($u))
            {
                $this->setLayout('login_layout');
                return $this->render('login', ['error' => "Cet identifiant n'existe pas"]);
            }
            if($u->getMdp() != $data['password_form'])
            {
                $this->setLayout('login_layout');
                return $this->render('login', ['error' => 'Identifiants Incorrects']);
            }
            $_SESSION["user"] = $u;
            header("Location: /home");
            exit;
        }

        public function register(Request $request)
        {
            $this->setLayout('login_layout');
            if($request->isPost())
            {
                return 'Handling submitted data';
                exit;
            }
            return $this->render('register');
        }

        public function logout()
        {
            unset($_SESSION['user']);
            header("Location: /login");
            exit;
        }
    }

?>