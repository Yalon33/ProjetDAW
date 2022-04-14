<?php

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
                return BDD::prepAndExec("SELECT * FROM projet.contenu WHERE id=:i;", [":i" => "$id"])->fetchALL()[0];
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
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
                    return BDD::prepAndExec("UPDATE projet.contenu SET uri=:uri) WHERE id=:i;",
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