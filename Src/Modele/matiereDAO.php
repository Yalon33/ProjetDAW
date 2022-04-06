<?php
    require_once("bdd.php");
    require_once("../controlleur/matiere.php");

    class MatiereDAO {
        public static function getAll(){
            $data = BDD::query("SELECT * FROM projet.matiere;");
            $res = array();
            if ($data !== false){
                foreach($data->fetchAll() as $row){
                    echo "<pre>";
                    print_r($row);
                    echo "</pre>";
                    array_push($res, new Matiere($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));
               }
            }
            return $res;
        }
        
        public static function getById($id){
            $data = BDD::prepAndExec("SELECT * FROM projet.matiere WHERE id=:i;", [":i" => "$id"]);
            $res = array();
            if ($data !== false){
                foreach($data->fetchAll() as $row){
                    array_push($res, new Matiere($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));
               }
            }
            return $res;
        }

        public static function insertMatiere($matiere){
            $arrayMat = [":n" => $matiere->getNom(), ":d" => $matiere->getDateCreation(), ":cont" => $matiere->getContenu(), ":crea" => $matiere->getCreateur()->getLogin(), ":t" => $matiere->getTags(), ":niv" => $matiere->getNiveau()];
            if ($matiere->getId() == null){
                return BDD::prepAndExec("INSERT INTO projet.matiere(nom, dateCreation, contenu, createur, tags, niveau) VALUES(:n, :d, :cont, :crea, :t, :niv);",$arrayMat) !== false;
            } 
            //else {
            //    array_push($arrayMat, [":i" => $matiere->getId()]);
            //    BDD::prepAndExec("INSERT INTO projet.matiere(id, nom, dateCreation, contenu, createur, tags, niveau) VALUES(:i, :n, :d, :cont, :crea, :t, :n);",$arrayMat);
            //}
        }

        public static function insertMatieres($arrayMatiere){
            $inserted = true;
            foreach($arrayMatiere as $matiere){
                $inserted = MatiereDAO::insertMatiere($matiere);
                if ($inserted === false){
                    return false;
                }
            }
            return true;
        }

        public static function deleteMatieres(){
            return BDD::query("DELETE FROM projet.matiere") !== false;
        }
    }
?>