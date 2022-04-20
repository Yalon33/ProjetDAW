<?php 
    set_include_path('../');
    require_once('appcore/application.php');
    require_once('appcore/controller.php');
    require_once('Src/Controlleur/homecontroller.php');
    require_once('Src/Controlleur/authcontroller.php');
    require_once('Src/Controlleur/usercontroller.php');
    require_once('Src/Modele/utilisateurDAO.php');

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

        $app->routeur()->get('/login', [AuthController::class, 'login']);
        $app->routeur()->post('/login', [AuthController::class, 'handleLogin']);
    }
    else
    {
        $app->routeur()->get('/', function() {
            header("Location: /home");
            exit;
        });
    
        $app->routeur()->get('/home', [HomeController::class, 'home']);

        $app->routeur()->get('/user', [UserController::class, 'user']);
    
        $app->routeur()->get('/login', [AuthController::class, 'login']);
        $app->routeur()->post('/login', [AuthController::class, 'handleLogin']);
    }

    $app->run();
?>