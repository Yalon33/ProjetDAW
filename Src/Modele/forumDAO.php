<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controleur/forum.php");
    require_once("Src/Controleur/utilisateur.php");
    class ForumDAO {
        /**
         * @return array[Forum] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.forum;");
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
         * @return Forum Le forum de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.forum WHERE id=:i;", [":i" => "$id"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $name
         * @return Forum Le forum de la base correspondant aux nom en paramètre
         */
        public static function getByNom($nom){
            try{
                $req =  BDD::prepAndExec("SELECT * FROM projet.forum WHERE nom=:n;", [":n" => "$nom"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }
        
        /**
         * @param Utilisateur $u
         * @return array[Message] Renvoie tous les forums auxquels l'étudiant participe, est vide dans le cas où l'étudiant ne participe à aucun forum
         */
        public static function getByUser($u){
            if(!is_null($u->getId())){
                $req = BDD::prepAndExec("SELECT id_forum AS id, f.nom AS nom FROM projet.utilisateur AS u, projet.participer_forum AS pf, projet.forum AS f
                                            WHERE u.id=pf.id_part AND pf.id_forum=f.id AND pf.id_part=:id;",
                                        array("id" => $u->getId()))->fetchAll();
                return !empty($req) ? array_map("self::fromRow", $req) : $req;
            }
        }

        /**
         * Insère un forum dans la base de données (mise à jour si le forum existe déja)
         * 
         * @param Forum $f
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($f){
            if (!is_null($f->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.forum SET nom=:n WHERE id=:i;",
                        array(
                            ":i" => $f->getId(),
                            ":n" => $f->getNom()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.forum(nom) VALUES(:n);", array(
                        'n' => $f->getNom()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime le forum passée en paramètre de la base
         * 
         * @param Forum $f
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($f){
            if(!is_null($f->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.forum WHERE id=:i;", array('i' => $f->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime tous les forum de la table forum
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.forum;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en Forum
         *
         * @param array[] $row
         * @return Forum
         */
        private static function fromRow($row){
            return new Forum(
                $row['id'],
                $row['nom']
            );
        }
    }
?>