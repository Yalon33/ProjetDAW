<?php

    class AuthController extends Controller
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
            if($u[0]->getMdp() != $data['password_form'])
            {
                header("Location: /login");
                exit;
            }
            $_SESSION["user"] = $u[0];
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
    }

?>