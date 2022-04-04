<?php
    require_once("bdd.php");
    require_once("../controlleur/cours.php");

    class CoursDAO {
        public static function getAllCours(){
            $data = BDD::query("SELECT * FROM projet.cours;");
            $res = array();
            if ($data !== false){
                foreach($data->fetchAll() as $row){
                    array_push($res, new Utilisateur($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]));
                }
            }
            return $res;
        }
        
        public static function getById($arrayId){
            $data = BDD::prepAndExec("SELECT * FROM projet.cours WHERE id=:i;", $arrayId);
        }
    }
    $var = new CoursDAO();
    echo "<pre>";
    print_r($var->getAllCours());

    echo "</pre>";
?>