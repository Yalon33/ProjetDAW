<?php
    require_once("bdd.php");
    require_once("../controlleur/matiere.php");

    class MatiereDAO {
        /**
         * Renvoie toutes les matières dans la table matiere
         *
         * @return array un tableau contenant toutes les matières dans la table matiere
         */
        public static function getAll(){
            $data = BDD::query("SELECT * FROM projet.matiere;")->fetchAll();
            $res = array();
            if ($data !== false){
                foreach($data as $row){
                    array_push($res, new Matiere($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));
               }
            }
            return $res;
        }
        
        /**
         * Renvoie une matiere selon son identifiant
         *
         * @param entier $id
         * @return array La matière correspondant à l'identifiant si une telle matière est dans la table, faux sinon
         */
        public static function getById($id){
            $data = BDD::prepAndExec("SELECT * FROM projet.matiere WHERE id=:i;", [":i" => "$id"]);
            if ($data !== false){
                return new Matiere($data[0][0], $data[0][1], $data[0][2], $data[0][3], $data[0][4], $data[0][5], $data[0][6]);
            }
            return false;
        }

        /**
         * permet d'insérer dans la table une matiere
         *
         * @param Matiere $matiere
         * @return bool Renvoie false si la requête a échoué, true sinon
         */
        public static function create($matiere){
            if (is_null($matiere->getId())){
                
                if ($matiere->getId() == null){
                    return BDD::prepAndExec("INSERT INTO projet.matiere(nom, dateCreation, contenu, createur, tags, niveau) VALUES(:n, :d, :cont, :crea, :t, :niv);",
                        [":n" => $matiere->getNom(),
                        ":d" => $matiere->getDateCreation(),
                        ":cont" => $matiere->getContenu(),
                        ":crea" => $matiere->getCreateur()->getId(),
                        ":t" => $matiere->getTags(),
                        ":niv" => $matiere->getNiveau()
                        ]);
                } 
                else {
                    array_push($arrayMat, [":i" => $matiere->getId()]);
                    BDD::prepAndExec("INSERT INTO projet.matiere(id, nom, dateCreation, contenu, createur, tags, niveau) VALUES(:i, :n, :d, :cont, :crea, :t, :n);",$arrayMat);
                }
            }
        }

        /**
         * Supprime toutes la matières dans la table matiere
         *
         * @return bool Renvoie false si la suppression n'a pas eu lieu
         */
        public static function deleteMatieres(){
            return BDD::query("DELETE FROM projet.matiere") !== false;
        }

        /**
         * Fonction privée traduisant le retour de la BDD en utilisateur
         * $row = le résultat de la requête BDD à traduire
         */
        //private static function fromRow($row){
        //    return new Matiere(
        //    );
        //}
    }
?>