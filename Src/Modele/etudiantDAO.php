<?php
    require_once("bdd.php");
    require_once("../Controlleur/etudiant.php");

    class EtudiantDAO {
        /**
         * @return array[Etudiant] Les étudiants dans la base
         */
        public static function getAll() {
            try{
                $data = BDD::query("SELECT * FROM projet.etudiant");
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
            $array = array();
            foreach($data as $row){
                array_push($array, self::fromRow($row));
            }
            return $array;
        }

        /**
         * @param int $id
         * @return Etudiant/false L'étudiant de la base correspondant à l'id en paramètre et false si il n'existe pas d'étudiant avec un tel Id
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.etudiant WHERE id=:i", array('i' => $id))->fetchAll();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère un étudiant dans la base de données (mise à jour si l'étudiant existe déjà)
         *
         * @param Etudiant $e
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($e){
            if(!is_null($e->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.etudiant SET niveau=:niv WHERE id=:i;", 
                        array(
                            'i' => $e->getId(), 
                            'niv' => Niveau::toString($e->getNiveau())
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
            else{
                try{
                    return BDD::prepAndExec("INSERT INTO projet.etudiant(id, niveau) VALUES (:i, :niv);", 
                    array( 
                        'i' => BDD::query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'projet' AND TABLE_NAME = 'utilisateur'")->fetchAll()[0]["AUTO_INCREMENT"] - 1,
                        'niv' => Niveau::toString($e->getNiveau())
                    ));
                } catch (PDOException $e){
                    //echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime l'étudiant passé en paramètre de la base
         * 
         * @param Etudiant $e
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($e){
            if(!is_null($e->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.etudiant WHERE id=:i;", array('i' => $e->getId()));
                } catch (PDOException $err){
                    echo $err->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime tous les étudiants de la table etudiant
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.etudiant;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }

        }

        /**
         * Fonction privée traduisant le retour de la BDD en étudiant
         *
         * @param array[] $row
         * @return Etudiant
         */
        private static function fromRow($row){
            return new Etudiant(
                $row['id'],
                $row["niveau"]
            );
        }
    }
?>