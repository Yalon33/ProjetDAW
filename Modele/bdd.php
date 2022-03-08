<?php
    class BDD {
        private static ?BDD $instance = null;
        private static ?PDO $pdo = null;

        private function __construct() {}

        function __destruct() {
            self::$pdo = null;
        }

        public static function getInstance() {
            if(self::$instance == null) {
                self::$instance = new BDD();
                self::$pdo = new PDO('mysql:host=localhost;dbname=test', "test", "test");
            }
            return self::$instance;
        }

        public function query($string){
            return self::$pdo->query($string);
        }
    }
?>