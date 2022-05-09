<?php
    class UserControleur extends Controleur
    {
        public function user()
        {
            $params = [
                'user' => $_SESSION['user'],
                'all' => UtilisateurDAO::getAll()
            ];
            $this->setLayout('home_layout');
            return $this->render('user', $params);
        }

        public function updateUser(Request $request)
        {
            $data = $request->getData();
            $u = new Utilisateur($data["id_user"], $data["name_user"], $data["password_user"], $data["mail_user"], $data["prenom_user"], $data["nom_user"], $data["type_user"], $data["image_user"]);
            if($u != $_SESSION["user"])
            {
                if(UtilisateurDAO::create($u) !== false)
                {
                    $_SESSION["user"] = $u;
                    $_SESSION["newUser"] = true;
                    $allU = UtilisateurDAO::getAll();
                    var_dump($allU);
                    $params = [
                        'user' => $_SESSION['user'],
                        'all' => $allU
                    ];
                    $this->setLayout('home_layout');
                    return $this->render('user', $params);
                }
            }
            header("Location: /user");
            exit;
        }
    }
?>