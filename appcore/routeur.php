<?php
    require_once("application.php");
    /**
     * Routeur de l'application, décrit les routes possibles et les actions associées
     */
    class Routeur {
        
        private array $routes = [];

        public function __construct()
        {
        }

        public function get($path, $func)
        {
            $this->routes['get'][$path] = $func;

        }

        public function post($path, $func)
        {
            $this->routes['post'][$path] = $func;

        }

        public function resolveURL()
        {
            $path = Application::getInstance()->request()->getPath();
            $method = Application::getInstance()->request()->method();
            $func = $this->routes[$method][$path] ?? false;
            if($func === false) 
            {
                Application::getInstance()->response()->setStatusCode(404);
                return $this->renderOnlyView("_404");
            }

            if(is_string($func))
            {
                return $this->render($func);
            }

            if(is_array($func))
            {
                Application::getInstance()->setControleur(new $func[0]());
                $func[0] = Application::getInstance()->getControleur();
            }

            return call_user_func($func, Application::getInstance()->request());
        }

        public function render($view, $params = [])
        {
            $layout = $this->layout();
            $view = $this->renderOnlyView($view, $params);
            return str_replace('{{content}}', $view, $layout);
        }

        protected function layout()
        {
            $layout = Application::getInstance()->getControleur()->getLayout();
            ob_start();
            include_once Application::getInstance()->currDir()."/Src/vue/layout/$layout.php";
            return ob_get_clean();
        }

        protected function renderOnlyView($view, $params = [])
        {
            foreach ($params as $k => $v)
            {
                $$k = $v;
            }
            ob_start();
            include_once Application::getInstance()->currDir()."/Src/vue/html/$view.php";
            return ob_get_clean();
        }
    }

?>