<?php 

    class Request
    {
        private int $id = -1;

        public function getPath()
        {
            $path = $_SERVER['REQUEST_URI'] ?? '/';
            $posQuestionMark = strpos($path, '?');
            $explodedPath = explode('/', $path);
            if(count($explodedPath) == 3)
            {
                $this->id = intval($explodedPath[2]);
                $explodedPath[2] = '{id}';
                return implode('/', $explodedPath);
            }
            if($posQuestionMark === false)
            {
                return $path;
            }
            $path = substr($path, 0, $posQuestionMark);
        }

        public function method()
        {
            return strtolower($_SERVER['REQUEST_METHOD']);
        }

        public function isGet()
        {
            return $this->method() === 'get';
        }

        public function isPost()
        {
            return $this->method() === 'post';
        }

        public function getId()
        {
            return $this->id;
        }

        public function getData()
        {
            $data = [];
            if($this->method() === 'get')
            {
                foreach($_GET as $k => $v)
                {
                    $data[$k] = filter_input(INPUT_GET, $k, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            if($this->method() === 'post')
            {
                foreach($_POST as $k => $v)
                {
                    $data[$k] = filter_input(INPUT_POST, $k, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            return $data;
        }
    }

?>