<?php 
    require_once("routeur.php");
    require_once("request.php");
    require_once("response.php");
    /**
     * Classe représentant l'application web, elle est appelée à l'arrivée sur la route '/'
     */
    class Application {

        private static ?Application $app = null;
        private Routeur $routeur;
        private Request $request;
        private Response $response;
        private Controleur $controleur;
        private static string $dir;

        private function __construct()
        {
            self::$dir = dirname(__DIR__);
            $this->routeur = new Routeur();
            $this->request = new Request();
            $this->response = new Response();
        }

        public static function getInstance()
        {
            if(is_null(self::$app))
            {
                self::$app = new Application();
            }
            return self::$app;
        }

        public function run()
        {
            echo $this->routeur->resolveURL();
        }

        public function routeur()
        {
            return $this->routeur;
        }

        public function request()
        {
            return $this->request;
        }
        
        public function response()
        {
            return $this->response;
        }

        public function currDir()
        {
            return self::$dir;
        }

        public function getControleur()
        {
            return $this->controleur;
        }

        public function setControleur(Controleur $c)
        {
            $this->controleur = $c;
        }
    }

?>