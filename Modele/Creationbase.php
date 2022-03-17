<?php
    include("./bdd.php");
    // Cette classe a pour rôle de créer la base de donnée pour qu'on travaille tous sur la même base et les mêmes tables.
    class Creationbase{
        public $nomBD;

        public function __construct(){
            self::createBDD("test");
        }

        function __destruct() {
            self::deleteBDD("test");
        }


        public function createBDD($nomBDD){
            try{
                BDD::getInstance()->query("CREATE DATABASE $nomBDD");
                echo "Database created successfully<br>";
            } catch(PDOException $e) {
                throw "Error" . $e->getMessage() . "<br>";
            }
        }


        public function deleteBDD($nomBDD){
            self::$nomBD = $nomBDD;
            try{
                BDD::getInstance()->query("DROP DATABASE" . self::$nomBD);
                echo "Database dropped successfully<br>";
            } catch(PDOException $e) {
                echo "Error" . $e->getMessage() . "<br>";
            }
        }


        public function createTableTest()
        {
            $sql="CREATE Table " . self::$nomBD . ".User(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL
            );";

            if (!is_null(BDD::getInstance()->query($sql)))
            {
                echo "Table User a été créée<br>";
            }
            else
            {
                echo "La table User n'a pas été créée<br>";
            }
        }
    }
    $creation = new Creationbase();
    $creation->createTableTest();
?>