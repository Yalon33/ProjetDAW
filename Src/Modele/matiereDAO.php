<?php
    require_once("bdd.php");
    require_once("../controlleur/matiere.php");

    class MatiereDAO {
        public static function getAllMatiere(){
            $data = BDD::query("SELECT * FROM projet.matiere;");
            $res = array();
            if ($data !== false){
                foreach($data->fetchAll() as $row){
                    array_push($res, new Matiere($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]));
               }
            }
            return $res;
        }
        
        public static function getById($arrayId){
            $data = BDD::prepAndExec("SELECT * FROM projet.matiere WHERE id=:i;", $arrayId);
        }

        public static function insertMatiere($matiere){
            $arrayMat = [":n" => $matiere->getNom(), ":d" => $matiere->getDateCreation(), ":cont" => $matiere->getContenu(), ":crea" => $matiere->getCreateur()->getLogin(), ":t" => $matiere->getTags(), ":niv" => $matiere->getNiveau()];
            if ($matiere->getId() == null){
                BDD::prepAndExec("INSERT INTO projet.matiere(nom, dateCreation, contenu, createur, tags, niveau) VALUES(:n, :d, :cont, :crea, :t, :niv);",$arrayMat);
            } 
           // else {
           //     array_push($arrayMat, [":i" => $matiere->getId()]);
           //     BDD::prepAndExec("INSERT INTO projet.matiere(id, nom, dateCreation, contenu, createur, tags, niveau) VALUES(:i, :n, :d, :cont, :crea, :t, :n);",$arrayMat);
           // }
        }
    }
?>