<?php
    include("./bdd.php");

    // Cette classe a pour rôle de créer la base de donnée pour qu'on travaille tous sur la même base et les mêmes tables.
    class Creationbase{
        public function __construct(){
            //Constructeur par défaut
        }

        function __destruct() {
            //Destructeur par défaut
        }

        //Est en privé car une instance de cette classe ne peut contenir que une base de donnée
        public function createBDD($nomBDD){
            // Pas besoin de faire un try/catch comme la query le fait déjà
            // Les echos deviennent vites illisibles
            return is_null(BDD::getInstance()->query("CREATE DATABASE IF NOT EXISTS $nomBDD;")) ? false : true;
        }


        public function deleteBDD($nomBDD){
            return is_null(BDD::getInstance()->query("DROP DATABASE IF EXISTS $nomBDD;")) ? false : true;
        }


        public function createTable($nomBDD, $nomTable, $attributString) {
            return is_null(BDD::getInstance()->query("CREATE Table IF NOT EXISTS $nomBDD.$nomTable($attributString);")) ? false : true;
        }

        public function insertData($nomBDD, $nomTable, $attributs, $values){
            return is_null(BDD::getInstance()->query("INSERT INTO $nomBDD.$nomTable($attributs) VALUES($values);")) ? false : true;
        }
    }
?>