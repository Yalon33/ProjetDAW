<?php
    require_once("bdd.php");
    require_once("../controlleur/matiere.php");
    require_once("parseDate.php");
    require_once("../controlleur/niveau.php");

    class MatiereDAO {
        /**
         * @return array[Matiere] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.matiere;");
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
         * @param int $id
         * @return Matiere La matière de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $a = self::fromRow(BDD::prepAndExec("SELECT * FROM projet.matiere WHERE id=:i;", [":i" => "$id"])->fetchALL()[0]);
                return $a;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $nom
         * @return Matiere La matière de la base correspondant au nom en paramètre
         */
        public static function getByNom($nom){
            try{
                return self::fromRow(BDD::prepAndExec("SELECT * FROM projet.matiere WHERE nom=:n;", [":n" => "$nom"])->fetchALL()[0]);
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère une matière dans la base de données (mise à jour si la matière existe déja)
         * 
         * @param Matiere $m
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($m){
            if (!is_null($m->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.matiere SET nom=:n, date_creation=:d, id_createur=:c, niveau=:niv WHERE id=:i;",
                        array(
                            ":n" => $m->getNom(),
                            ":d" => ParseDate::toBDD($m->getDateCreation()),
                            ":crea" => $m->getIdCreateur(),
                            ":niv" => Niveau::toString($m->getNiveau())
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.matiere(nom, date_creation, id_createur, niveau) VALUES(:n, :d, :crea, :niv);", array(
                        'n' => $m->getNom(),
                        'd' => ParseDate::toBDD($m->getDateCreation()),
                        'crea' => $m->getIdCreateur(),
                        'niv' => Niveau::toString($m->getNiveau())
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime la matière passée en paramètre de la base
         * 
         * @param Matiere $e
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($m){
            if(!is_null($m->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.matiere WHERE id=:i;", array('i' => $m->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime toutes les matières de la table matiere
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.matiere;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en Matiere
         *
         * @param array[] $row
         * @return Matiere
         */
        private static function fromRow($row){
            return new Matiere(
                $row['id'],
                $row['nom'],
                ParseDate::fromBDD($row['date_creation']),
                $row['id_createur'],
                $row['niveau']
            );
        }
    }
?>