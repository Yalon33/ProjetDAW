<?php
    include("./bdd.php");

    // Cette classe a pour rôle de créer la base de donnée pour qu'on travaille tous sur la même base et les mêmes tables.
    class Creationbase{
        public $nomBase;
        public function __construct($nomBDD){
            $this->nomBase = $nomBDD;
            $this->createBDD($nomBDD);
        }

        function __destruct() {
            //Destructeur par défaut
        }


        //Est en privé car une instance de cette classe ne peut contenir que une base de donnée
        private function createBDD(){
            // Pas besoin de faire un try/catch comme la query le fait déjà
            if (is_null(BDD::getInstance()->query("CREATE DATABASE IF NOT EXISTS $this->nomBase;"))){
                echo "La création de la base de donnée $this->nomBase est un échec<br>"; //On a pas dire que ça n'a pas marché quand même
            } else {
                echo "La base de donnée $this->nomBase a été crée<br>";
            }
        }


        public function deleteBDD(){
            // Pas besoin de faire un try/catch comme la query le fait déjà
            if (is_null(BDD::getInstance()->query("DROP DATABASE $this->nomBase;"))){
                echo "La suppression de la base de donnée $this->nomBase est un échec<br>";
            } else {
                echo "La base de donnée $this->nomBase a été supprimée<br>";
            }
        }


        public function createTable($nomTable) {
            $sql="CREATE Table IF NOT EXISTS $this->nomBase.$nomTable(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL
            );";

            if (!is_null(BDD::getInstance()->query($sql))) {
                echo "La table '$nomTable' a été créée<br>";
            } else {
                echo "Impossible de créer la table '$nomTable'<br>";
            }
        }
    }
    //A chaque instance de cette classe correspon une base de donnée, dans laquelle on peut créer des tables etc...
    $base = new Creationbase("Main");
    //$base->createTable("User");
    //$base->deleteBDD();
    echo "Utilisez les fonctions de la classe Creationbase pour pouvoir créer des tables et des données à l'aide de requêtes SQL";
?>