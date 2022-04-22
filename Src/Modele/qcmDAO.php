<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controleur/qcm.php");
    class QCMDAO {
        /**
         * @return array[QCM] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.qcm;");
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
            $res = array();
            if ($data !== false){
                foreach($data as $row){
                    array_push($res, self::fromRow($row));
                }
            }
            return $res;
        }
        
        /**
         * @param entier $id
         * @return QCM Le qcm de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.qcm WHERE id=:i;", [":i" => "$id"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $questions
         * @return QCM Le qcm de la base correspondant aux questions en paramètre
         */
        public static function getByQuestions($questions){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.qcm WHERE questions=:q;", [":q" => "$questions"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère un qcm dans la base de données (mise à jour si le qcm existe déja)
         * 
         * @param QCM $qcm
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($qcm){
            if (!is_null($qcm->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.qcm SET id_prof=:idP, questions=:q WHERE id=:i;",
                        array(
                            "i" => $qcm->getId(),
                            "idP" => $qcm->getIdProf(),
                            "q" => $qcm->getQuestions()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.qcm(id_prof, questions) VALUES(:idP, :q);",
                    array(
                        'idP' => $qcm->getIdProf(),
                        'q' => $qcm->getQuestions()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime le qcm passée en paramètre de la base
         * 
         * @param QCM $e
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($qcm){
            if(!is_null($qcm->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.qcm WHERE id=:i;", array('i' => $qcm->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime toutes les qcm de la table qcm
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.qcm;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en QCM
         *
         * @param array[] $row
         * @return QCM
         */
        private static function fromRow($row){
            return new QCM(
                $row['id'],
                $row['id_prof'],
                $row['questions']
            );
        }
    }
?>