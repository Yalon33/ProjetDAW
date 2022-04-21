<?php 
    require_once(__DIR__.'/../appcore/application.php');
    require_once(__DIR__.'/../appcore/controleur.php');
    require_once(__DIR__.'/../Src/Controleur/homeControleur.php');
    require_once(__DIR__.'/../Src/Controleur/authControleur.php');
    require_once(__DIR__.'/../Src/Controleur/userControleur.php');
    require_once(__DIR__.'/../Src/Modele/utilisateurDAO.php');

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

        $app->routeur()->get('/user', [UserControleur::class, 'user']);
    
        $app->routeur()->get('/login', [AuthControleur::class, 'login']);
        $app->routeur()->post('/login', [AuthControleur::class, 'handleLogin']);
    }

    $app->run();
?>