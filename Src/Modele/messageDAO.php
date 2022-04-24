<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controleur/message.php");

    class MessageDAO {
        /**
         * @return array[Message] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.message;");
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
         * @return Message Le message de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.message WHERE id=:i;", [":i" => "$id"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $contenu
         * @return Message Le message de la base correspondant au contenu en paramètre
         */
        public static function getByContenu($contenu){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.message WHERE contenu=:c;", [":c" => "$contenu"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        public static function getByCanal($c){
            $req = BDD::prepAndExec("SELECT m.id AS id, m.contenu AS contenu, c.id AS id_canal, m.id_auteur AS id_auteur FROM projet.message AS m, projet.canal AS c
                                        WHERE m.id_canal=c.id AND c.id=:id;",
                                    array("id" => $c->getid()))->fetchAll();
            return !empty($req) ? array_map("self::fromRow", $req) : $req;
        }

        /**
         * Insère un message dans la base de données (mise à jour si le message existe déja)
         * 
         * @param Message $m
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($m){
            if (!is_null($m->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.message SET contenu=:c, id_canal=:idC, id_auteur=:idA WHERE id=:i;",
                        array(
                            "i" => $m->getId(),
                            "c" => $m->getContenu(),
                            "idC" => $m->getIdCanal(),
                            "idA" => $m->getIdAuteur()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.message(contenu, id_canal, id_auteur) VALUES(:c, :idC, :idA);",
                    array(
                        'c' => $m->getContenu(),
                        'idC' => $m->getIdCanal(),
                        'idA' => $m->getIdAuteur()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime le message passée en paramètre de la base
         * 
         * @param Message $e
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($m){
            if(!is_null($m->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.message WHERE id=:i;", array('i' => $m->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime toutes les messages de la table message
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.message;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en Message
         *
         * @param array[] $row
         * @return Message
         */
        private static function fromRow($row){
            return new Message(
                $row['id'],
                $row['contenu'],
                $row['id_canal'],
                $row['id_auteur']
            );
        }
    }
?>