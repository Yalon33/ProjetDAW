<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Modele/matiereDAO.php");
    require_once("Src/Controleur/avancement.php");
    class MatiereSuivieDAO {
        /**
         * @return array[Int=>Avancement] Un tableau associatif avec l'identifiant de la matière en clé et l'avancement en valeur
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.matiere_suivie;");
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            } 
            $res = array();
            if ($data !== false){
                foreach($data as $row){
                    array_push($res, [$row['id_mat'] => $row('avancement')]);
                }
            }
            return $res;
        }

        /**
         * @param Etudiant $id_etu
         * @param Matiere $id_mat
         * @return array[string=>string] Un tableau associatif avec le nom de la matière en clef et l'avancement en string en valeur
         */
        public static function getAvancement($id_etu, $id_mat){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.matiere_suivie WHERE id_etu=:idE AND id_mat=:idM;", [":idE" => $id_etu, ":idM" => $id_mat])->fetchALL();
                return !empty($req) ? array(MatiereDAO::getById($req[0]['id_mat'])->getNom() => $req[0]['avancement']) : array();
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère une matiere_suivie dans la base de données (mise à jour si la matiere_suivie existe déja)
         * 
         * @param Etudiant $e
         * @param Matiere $m
         * @param Avancement $a
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($e, $m, $a){
            $req = self::getAvancement($e->getId(), $m->getId());
            if (!empty($req)){
                try{
                    return BDD::prepAndExec("UPDATE projet.matiere_suivie SET avancement=:a WHERE id_etu=:idE AND id_mat=:idM",
                        array(
                            "idE" => $e->getId(),
                            "idM" => $m->getId(),
                            "a" => Avancement::toString($a)
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.matiere_suivie(id_etu, id_mat, avancement) VALUES(:idE, :idM, :a);",
                    array(
                        'idE' => $e->getId(),
                        'idM' => $m->getId(),
                        'a' => Avancement::toString($a)
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime la matiere_suivie passée en paramètre de la base
         * 
         * @param Etudiant $e l'étudiant qui ne veut plus suivre la matière
         * @param Matiere $m La matière qwe l'étudiant ne veux plus suivre
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($e, $m){
            if(self::getAvancement($e->getId(), $m->getId()) !== false){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.matiere_suivie WHERE id_etu=:idE AND id_mat=:idM", array('idE'=> $e->getId(), 'idM'=>$m->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime toutes les matiere_suivies de la table matiere_suivie
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.matiere_suivie;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }
    }
?>