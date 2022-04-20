<?php

    class Controller
    {
        private string $layout = 'main';

        public function render($view, $params =[])
        {
            return Application::getInstance()->routeur()->render($view, $params);
        }

        public function setLayout($layout)
        {
            $this->layout = $layout;
        }

        public function getLayout()
        {
            return $this->layout;
        }
    }
    
?>