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
            //return !is_null(BDD::query("CREATE DATABASE IF NOT EXISTS $nomBDD;"));
            return !is_null(BDD::query("CREATE DATABASE IF NOT EXISTS $nomBDD;"));
        }


        public function deleteBDD($nomBDD){
            return !is_null(BDD::query("DROP DATABASE IF EXISTS $nomBDD;"));
        }


        public function createTable($nomBDD, $nomTable, $attributString) {
            return !is_null(BDD::query("CREATE Table IF NOT EXISTS $nomBDD.$nomTable($attributString);"));
        }

        public function deleteTable($nomBDD, $nomTable){
            return !is_null(BDD::query("DROP TABLE IF EXISTS $nomBDD.$nomTable;"));
        }

        public function insertData($stringQuery, $arrayHolder){
            return BDD::prepAndExec($stringQuery, $arrayHolder) !==  false;
        }
        
        public function deleteData($nomBDD, $nomTable, $conditions = NULL){
            if (!is_null($conditions)){
                return !is_null(BDD::query("DELETE FROM $nomBDD.$nomTable WHERE $conditions;"));
            } else {
                return !is_null(BDD::query("DELETE FROM $nomBDD.$nomTable;"));
            }
        }
    }
?>