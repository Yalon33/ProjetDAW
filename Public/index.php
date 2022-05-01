<?php 
    set_include_path("../");
    require_once('appcore/application.php');
    require_once('appcore/controleur.php');
    require_once('Src/Controleur/homeControleur.php');
    require_once('Src/Controleur/authControleur.php');
    require_once('Src/Controleur/userControleur.php');
    require_once('Src/Controleur/testControleur.php');
    require_once('Src/Controleur/forumControleur.php');
    require_once('Src/Controleur/canalControleur.php');
    require_once('Src/Controleur/add_matiereControleur.php');
    require_once('Src/Controleur/add_documentControleur.php');
    require_once('Src/Controleur/add_forumControleur.php');
    require_once('Src/Controleur/add_canalControleur.php');
    require_once('Src/Controleur/qcmControleur.php');
    require_once("Src/Modele/canalDAO.php");
    require_once("Src/Modele/forumDAO.php");
    require_once("Src/Modele/messageDAO.php");
    require_once('Src/Controleur/matiereControleur.php');
    require_once("Src/Modele/canalDAO.php");
    require_once("Src/Modele/forumDAO.php");
    require_once('Src/Controleur/matieresSuiviesControleur.php');
    require_once('Src/Modele/utilisateurDAO.php');
    require_once('Src/Modele/matiereDAO.php');
    require_once('Src/Modele/ReponseDAO.php');
    require_once('Src/Modele/QCMDAO.php');
    require_once('Src/Modele/matiereSuivieDAO.php');
    require_once('Src/Modele/contenuDAO.php');
    require_once('Src/Modele/associationDAO.php');

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

        $app->routeur()->post('/home', [HomeControleur::class, 'pageattend1']);

        $app->routeur()->get('/pageattend', [HomeControleur::class, 'pageattend']);

        $app->routeur()->get('/addMatiere', [AddMatiereControleur::class, 'addmatiere']);

        $app->routeur()->get('/home', [MatiereControleur::class, 'matiere_all']);

        $app->routeur()->get('/user', [usercontroleur::class, 'user']);
        $app->routeur()->post('/user', [usercontroleur::class, 'updateUser']);

        $app->routeur()->get('/addForum', [AddForumControleur::class,'addforum']);
        $app->routeur()->post('/addForum', [AddForumControleur::class,'creeforum']);
        
        $app->routeur()->get('/matieres', [MatieresSuiviesControleur::class, 'matieres']);
    
        $app->routeur()->get('/addMatiere', [AddMatiereControleur::class, 'addmatiere']);
        $app->routeur()->post('/addMatiere', [AddMatiereControleur::class, 'creematiere']);

        $app->routeur()->get('/matieres/{id}', [MatiereControleur::class, 'matiere']);

        $app->routeur()->get('/addDocument/{id}', [AddDocumentControleur::class, 'adddocument']);
        $app->routeur()->post('/addDocument/{id}', [AddDocumentControleur::class, 'creedocument']);

        $app->routeur()->get('/canal/{id}', [CanalControleur::class, 'canal']);
        $app->routeur()->post('/canal/{id}', [CanalControleur::class, 'envoiMessage']);

        $app->routeur()->get('/forum', [ForumControleur::class, 'forum']);

        $app->routeur()->get('/addCanal/{id}', [AddCanalControleur::class, 'addcanal']);
        $app->routeur()->post('/addCanal/{id}', [AddCanalControleur::class, 'creecanal']);

        $app->routeur()->get('/qcm/{id}', [QCMControleur::class, 'qcm']);

        $app->routeur()->get('/login', [AuthControleur::class, 'login']);

        $app->routeur()->post('/login', [AuthControleur::class, 'handleLogin']);

        $app->routeur()->get('/logout', [AuthControleur::class, 'logout']);

        $app->routeur()->get('/test', [TestControleur::class, 'runTest']);
        
    }

    $app->run();
?>