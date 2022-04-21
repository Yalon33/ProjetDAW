<?php

    class AuthControleur extends Controleur
    {

        public function login()
        {
            $this->setLayout('login_layout');
            return $this->render('login');
        }

        public function handleLogin(Request $request)
        {
            $data = $request->getData();
            $u = UtilisateurDAO::getByLogin($data['login_form']);
            if(empty($u))
            {
                header("Location: /login");
                exit;
            }
            if($u->getMdp() != $data['password_form'])
            {
                header("Location: /login");
                exit;
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