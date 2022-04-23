<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controleur/contenu.php");
    class ContenuDAO {
        /**
         * @return array[Contenu] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.contenu;");
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
         * @return Contenu Le contenu de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.contenu WHERE id=:i;", [":i" => "$id"])->fetchALL()[0];
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $uri
         * @return Contenu Le contenu de la base correspondant à l'uri en paramètre
         */
        public static function getByUri($uri){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.contenu WHERE uri=:u;", [":u" => "$uri"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Permet de récupérer les contenus d'une matière
         *
         * @param Matiere $m
         * @return array[Contenu] Les contenus qui sont associés à la matière donnée en paramètre
         */
        public static function getByMatiere($m){
            if(!is_null($m->getId())){
                $req = BDD::prepAndExec("SELECT * FROM projet.matiere AS m, projet.matiere_contenu AS mc, projet.contenu AS c
                                            WHERE m.id=mc.id_mat AND mc.id_contenus=c.id AND mc.id_mat=:id;",
                                        array(":id" => $m->getId()))->fetchAll();
                if (!empty($req)){
                    $res = array();
                    foreach($req as $row){
                        array_push($res, new Contenu(
                            $row['id_contenus'],
                            $row['uri']
                        ));
                    }
                    return $res;
                }
                return array();
            }
        }

        /**
         * Insère un contenu dans la base de données (mise à jour si le contenu existe déja)
         * 
         * @param Contenu $matiere
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($c){
            if (!is_null($c->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.contenu SET uri=:uri WHERE id=:i;",
                        array(
                            ":i" => $c->getId(),
                            ":uri" => $c->getUri()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.contenu(uri) VALUES(:uri);", 
                    array(
                        'uri' => $c->getUri()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime le contenu passée en paramètre de la base
         * 
         * @param Contenu $c
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($c){
            if(!is_null($c->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.contenu WHERE id=:i;", array('i' => $c->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime tous les contenus de la table contenu
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.contenu;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en Contenu
         *
         * @param array[] $row
         * @return Contenu
         */
        private static function fromRow($row){
            return new Contenu(
                $row['id'],
                $row['uri']
            );
        }
    }
?>