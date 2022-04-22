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