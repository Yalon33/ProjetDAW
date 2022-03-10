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
                self::$pdo = new PDO('mysql:host=localhost', "root", "");
            }
            return self::$instance;
        }
        public function createBDD($nomBDD){
            return self::$pdo->query("CREATE DATABASE $nomBDD");
        }
        public function deleteBDD($nomBDD){
            return self::$pdo->query("DROP DATABASE $nomBDD");
        }

        public function query($string){
            return self::$pdo->query($string);
        }
    }
    $db = BDD::getInstance();
?>