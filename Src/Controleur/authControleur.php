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

        public function register()
        {
            $this->setLayout('login_layout');
            $params = [
                'types' => TypeUtilisateur::allTypeUtilisateur()
            ];
            if(isset($_SESSION['error-register']))
            {
                $params['error'] = "Une erreur s'est produite lors de l'inscription, veuillez essayer avec d'autres informations";
                unset($_SESSION['error-register']);
            }
            return $this->render('register', $params);
        }

        public function handleRegister(Request $request)
        {
            $data = $request->getData();
            $u = new Utilisateur(
                null,
                $data['login_form'],
                $data['password_form'],
                $data['mail_form'],
                $data['prenom_form'],
                $data['nom_form'],
                $data['type'],
                $data['login_form'] . '-' .basename($_FILES["image_form"]["name"])
            );
            if(UtilisateurDAO::create($u) !== false)
            {
                $u = UtilisateurDAO::getByLogin($data['login_form']);
                if($u !== false)
                {
                    $target_dir = "files/image/";
                    $target_file = $target_dir . $u->getImage();
                    move_uploaded_file($_FILES["image_form"]["tmp_name"], $target_file);
                    $_SESSION["user"] = $u;
                    header("Location: /home");
                    exit;
                }
                else
                {
                    $_SESSION['error-register'] = true;
                    header("Location: /register");
                    exit;
                }
            }
            else
            {
                $_SESSION['error-register'] = true;
                header("Location: /register");
                exit;
            }  
        }

        public function logout()
        {
            unset($_SESSION['user']);
            header("Location: /login");
            exit;
        }
    }

?>