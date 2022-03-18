<?php
    class BDD {
        private static ?BDD $instance = null;
        private static ?PDO $pdo = null;


        private function __construct() {
            /** Le constructeur est privé pour éviter qu'une autre classe puisse appeller le constructeur
             *  Voir le patron de conception du singleton 
             *  https://fr.wikipedia.org/wiki/Singleton_(patron_de_conception)
             */
        }


        function __destruct() {
            self::$pdo = null;
        }


        public static function getInstance() {
            if(self::$instance == null) {
                self::$instance = new BDD();
                try{
                    self::$pdo = new PDO('mysql:host=localhost', "root", "");
                } catch (PDOException $e){
                    exit("Error: Impossible de se connecter au serveur sql, vérifier qu'il a bien été lancé et voir le message ci-dessous:<br>" . $e->getMessage() . "<br>");
                }
                echo "Connexion avec le serveur établie<br>";
            }
            return self::$instance;
        }


        public function query($string){
            try{
                return self::$pdo->query($string);
            } catch (PDOException $e){
                echo "<br>Error : La requête SQL \"$string\" est eronée. Voir le message d'erreur suivant : <br><b>" . $e->getMessage() . "</b><br><br>";
            }
        }
    }
?>