<?php
    require_once("../Controlleur/canal.php");

    class CanalDAO {
        /**
         * @return array[Canal] Les étudiants dans la base
         */
        public static function getAll() {
            try{
                $data = BDD::query("SELECT * FROM projet.canal");
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
         * @return Canal Le canal de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.canal WHERE id=:i", array('i' => $id))->fetchAll();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $nom
         * @return Canal Le canal de la base correspondant au nom en paramètre
         */
        public static function getByNom($nom){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.canal WHERE nom=:n", array('n' => $nom))->fetchAll();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère un canal dans la base de données (mise à jour si le canal existe déjà)
         *
         * @param Canal $c
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($c){
            if(!is_null($c->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.canal SET nom=:n, id_forum=:id_f, id_createur=:id_c WHERE id=:i;", 
                        array(
                            'i' => $c->getId(), 
                            'n' => $c->getNom(),
                            'id_f' => $c->getIdForum(),
                            'id_c' => $c->getIdCreateur()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
            else{
                try{
                    return BDD::prepAndExec("INSERT INTO projet.canal (nom, id_forum, id_createur) VALUES (:n, :id_f, :id_c);", 
                    array( 
                        'n' => $c->getNom(),
                        'id_f' => $c->getIdForum(),
                        'id_c' => $c->getIdCreateur()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime le canal passé en paramètre de la base
         * 
         * @param Canal $c
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($c){
            if(!is_null($c->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.canal WHERE id=:i;", array('i' => $c->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime tous les canaux de la table canal
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.canal;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }

        }

        /**
         * Fonction privée traduisant le retour de la BDD en étudiant
         *
         * @param array[] $row
         * @return Canal
         */
        private static function fromRow($row){
            return new Canal(
                $row['id'],
                $row['nom'],
                $row['id_forum'],
                $row['id_createur']
            );
        }
    }
?>