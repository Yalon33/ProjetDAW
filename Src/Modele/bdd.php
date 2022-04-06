<?php
    class BDD {
        private static ?BDD $instance = null;
        private static ?PDO $pdo = null;

        /** 
         * Le constructeur est privé pour éviter qu'une autre classe puisse appeller le constructeur
         *  Voir le patron de conception du singleton 
         *  https://fr.wikipedia.org/wiki/Singleton_(patron_de_conception)
         */
        private function __construct() { }

        /**
         * Ferme la connection à la base de données
         */
        function __destruct() {
            self::$pdo = null;
        }

        /**
         * Récupère l'instance unique de la classe BDD, veuillez préférer l'utilisation directe des requêtes statiques (exemple BDD::query("SELECT * FROM USER;"))
         */
        public static function getInstance() {
            if(self::$instance == null) {
                self::$instance = new BDD();
                try{
                    self::$pdo = new PDO('mysql:host=localhost', "root", "");
                } catch (PDOException $e){
                    exit("Error: Impossible de se connecter au serveur sql, vérifier qu'il a bien été lancé et voir le message ci-dessous:<br>" . $e->getMessage() . "<br>");
                }
                //echo "Connexion avec le serveur établie<br>";
            }
            return self::$instance;
        }


        /**
         * Prépare et exécute une requête simple sans argument (exemple "SELECT * FROM USER;")
         * $string = la requête SQL à exécuter
         */
        public static function query($string){
            try{
                return self::getInstance()::$pdo->query($string);
            } catch (PDOException $e){
                echo "Error : La requête SQL \"$string\" est eronée. Voir le message d'erreur suivant : <br><t><b>" . $e->getMessage() . "</b><br>";
            }
        }

        /**
         * Prépare et exécute une requête avec arguments (exemple "SELECT * FROM USER WHERE X=Y")
         * $query = la requête SQL à préparer + exécuter
         * $array = le tableau des arguments à passer
         */
        public static function prepAndExec($query, $array){
            try{
                $q = self::getInstance()::$pdo->prepare($query);
                $q->execute($array);
                //return $q->fetchAll();
                return $q;
            } catch (PDOException $e){
                echo "Error : La requête SQL \"$query\" avec le tableau <pre>";
                print_r($array);
                echo "</pre>est eronée. Voir le message d'erreur suivant : <br><t><b>" . $e->getMessage() . "</b><br>";
            }
        }
    }
?>