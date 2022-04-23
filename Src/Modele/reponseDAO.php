<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controleur/reponse.php");
    class ReponseDAO {
        /**
         * @return array[Reponse] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.reponse;");
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
         * @return Reponse La reponse de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.reponse WHERE id=:i;", [":i" => "$id"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $xml
         * @return Reponse La reponse de la base correspondant à l'xml en paramètre
         */
        public static function getByXML($xml){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.reponse WHERE xml_uri=:x;", [":x" => "$xml"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Récupération des réponses d'un utilisateur
         *
         * @param Utilisateur $u
         * @return array[Reponse] Un tableau contenant les réponses de l'utilisateur donnée en argument
         */
        public static function getByUtilisateur($u){
            if(!is_null($u->getId())){
                $req = BDD::prepAndExec("SELECT r.id AS id, r.id_qcm AS id_qcm, r.xml_uri AS xml_uri FROM projet.reponse AS r, projet.reponse_utilisateur AS ru, projet.utilisateur AS u
                                            WHERE r.id=ru.id_rep AND ru.id_uti=u.id AND u.id=:id;",
                                        array("id" => $u->getId()))->fetchAll();
                if(!empty($req)){
                    $res = array();
                    foreach($req as $row){
                        array_push($res, self::fromRow($row));
                    }
                    return $res;
                }
                return $req;
            }
        }

        /**
         * Insère une reponse dans la base de données (mise à jour si la reponse existe déja)
         * 
         * @param Reponse $m
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($r){
            if (!is_null($r->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.reponse SET id_qcm=:idQ, xml_uri=:xml WHERE id=:i;",
                        array(
                            "i" => $r->getId(),
                            "idQ" => $r->getIdQCM(),
                            "xml" => $r->getXML()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.reponse(id_qcm, xml_uri) VALUES(:idQ, :xml);",
                    array(
                        'idQ' => $r->getIdQCM(),
                        'xml' => $r->getXML()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime la reponse passée en paramètre de la base
         * 
         * @param Reponse $r
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($r){
            if(!is_null($r->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.reponse WHERE id=:i;", array('i' => $r->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime toutes les reponses de la table reponse
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.reponse;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en reponse
         *
         * @param array[] $row
         * @return QCM
         */
        private static function fromRow($row){
            return new Reponse(
                $row['id'],
                $row['id_qcm'],
                $row['xml_uri']
            );
        }
    }
?>