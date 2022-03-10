<?php
// define($servername,"localhost");
// define($username,"root");
// define($password,"");
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
                echo "Connected successfully<br>";
            }
            return self::$instance;
        }
        public function createBDD($nomBDD){
              try{
                self::$pdo->exec("CREATE DATABASE $nomBDD");
                echo "Database created successfully<br>";
              } catch(PDOException $e) {
                echo "Error" . $e->getMessage() . "<br>";
              }
        }
        public function deleteBDD($nomBDD){
            try{
                self::$pdo->exec("DROP DATABASE $nomBDD");
                echo "Database dropped successfully<br>";
              } catch(PDOException $e) {
                echo "Error" . $e->getMessage() . "<br>";
              }
        }

        public function query($string){
            return self::$pdo->query($string);
        }

        public function createTableTest()
        {
            $sql="CREATE Table User(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
            )";

            if (self::$instance->query($sql)=== TRUE)
            {
                echo "created";
            }
            else
            {
                echo "error";
            }
        }
    }
    $db = BDD::getInstance();
    //  $db->createBDD("mybd");
    // $db->deleteBDD("mybd");

?>