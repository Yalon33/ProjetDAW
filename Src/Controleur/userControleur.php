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

        public function updateUser(Request $request)
        {
            $data = $request->getData();
            $u = new Utilisateur($data["id_user"], $data["name_user"], $data["password_user"], $data["mail_user"], $data["prenom_user"], $data["nom_user"], $data["type_user"], $data["image_user"]);
            if($u != $_SESSION["user"])
            {
                if(UtilisateurDAO::create($u) !== false)
                {
                    $_SESSION["user"] = $u;
                    header("Location: /home");
                    exit;
                }
            }
            header("Location: /user");
            exit;
        }
    }

    class LessonControleur extends Controleur
    {
        public function lessons()
        {
            $params = [
                'lessons' => $_SESSION['lessons']
            ];
            $this->setLayout('home_layout');
            return $this->render('lessons', $params);
        }
    }

    class Lesson_SuiviControleur extends Controleur
    {
        public function lesson_suivi()
        {
            $params = [
                'lesson_suivi' => $_SESSION['lesson_suivi']
            ];
            $this->setLayout('home_layout');
            return $this->render('lesson_suivi', $params);
        }
    }




?>