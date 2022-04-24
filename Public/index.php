<?php 
    set_include_path("../");
    require_once('appcore/application.php');
    require_once('appcore/controleur.php');
    require_once('Src/Controleur/homeControleur.php');
    require_once('Src/Controleur/authControleur.php');
    require_once('Src/Controleur/userControleur.php');
    require_once('Src/Controleur/testControleur.php');
    require_once('Src/Modele/utilisateurDAO.php');
    require_once('Src/Modele/matiereDAO.php');

    if(!session_id())
    {
        session_start();
    }

    $app = Application::getInstance();

    if(!isset($_SESSION['user']))
    {
        $app->routeur()->get('/', function() {
            header("Location: /login");
            exit;
        });

        $app->routeur()->get('/login', [AuthControleur::class, 'login']);
        $app->routeur()->post('/login', [AuthControleur::class, 'handleLogin']);
    }
    else
    {
        $app->routeur()->get('/', function() {
            header("Location: /home");
            exit;
        });
    
        $app->routeur()->get('/home', [HomeControleur::class, 'home']);

        $app->routeur()->get('/home', [HomeControleur::class, 'home']);

        $app->routeur()->get('/user', [UserControleur::class, 'user']);

        $app->routeur()->get('/lessons', [LessonControleur::class, 'lessons']);

        $app->routeur()->get('/lesson_suivi', [Lesson_SuiviControleur::class, 'lesson_suivi']);
    
        $app->routeur()->get('/login', [AuthControleur::class, 'login']);
        $app->routeur()->post('/login', [AuthControleur::class, 'handleLogin']);

        $app->routeur()->get('/logout', [AuthControleur::class, 'logout']);

        $app->routeur()->get('/test', [TestControleur::class, 'runTest']);
    }

    $app->run();
?>