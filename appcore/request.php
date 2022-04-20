<?php 

    class Request
    {
        public function getPath()
        {
            $path = $_SERVER['REQUEST_URI'] ?? '/';
            $pos = strpos($path, '?');
            if($pos === false)
            {
                return $path;
            }
            $path = substr($path, 0, $pos);
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