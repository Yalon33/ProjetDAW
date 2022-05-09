<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Modele/parseDate.php");
    require_once("Src/Controleur/matiere.php");
    require_once("Src/Controleur/niveau.php");

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
                $req = BDD::prepAndExec("SELECT * FROM projet.matiere WHERE id=:i;", [":i" => "$id"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param Tag $t
         * @return array[Matiere] Renvoie toutes les matières ayant le même tag que celui passé en paramètre
         */
        public static function getByTag($t){
            if(!is_null($t->getId())){
                $req = BDD::prepAndExec("SELECT m.id AS id, m.nom AS nom, m.date_creation AS date_creation, m.id_createur AS id_createur, m.niveau AS niveau, m.image AS image
                                            FROM projet.matiere AS m, projet.matiere_tag AS mt, projet.tag AS t
                                            WHERE m.id=mt.id_mat AND mt.id_tag=t.id AND t.id=:id",
                                        array("id" => $t->getId()))->fetchAll();
                return !empty($req) ? array_map("self::fromRow", $req) : $req;
            }
        }

        /**
         * @param string $nom
         * @return Matiere La matière de la base correspondant au nom en paramètre
         */
        public static function getByNom($nom){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.matiere WHERE nom=:n;", [":n" => "$nom"])->fetchAll();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param Niveau $n
         * @return array[Matiere] Les matières qui ont ce niveau
         */
        public static function getByNiveau($n){
            if(!is_string($n)){
                $n = Niveau::toString($n);
            }
            $req = BDD::prepAndExec("SELECT * FROM projet.matiere AS m WHERE m.niveau=:n", array("n" => $n))->fetchAll();
            return !empty($req) ? array_map("self::fromRow", $req) : $req;
        }

        /**
         * @param Etudiant $e
         * @return array[Matiere] Renvoie toutes les matières suivient par l'étudiant
         */
        public static function getByEtudiant($e){
            if(!is_null($e->getId())){
                $req = BDD::prepAndExec("SELECT id_mat AS id, nom, date_creation, id_createur, m.niveau AS niveau, image FROM projet.matiere AS m, projet.matiere_suivie AS ms, projet.etudiant AS e WHERE
                                            e.id=ms.id_etu ANd ms.id_mat = m.id AND e.id=:id;",
                                            array('id' => $e->getId()))->fetchAll();
                return !empty($req) ? array_map("self::fromRow", $req) : $req;
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
                    return BDD::prepAndExec("UPDATE projet.matiere SET nom=:n, date_creation=:d, id_createur=:c, niveau=:niv, image=:im WHERE id=:i;",
                        array(
                            "i" => $m->getId(),
                            "n" => $m->getNom(),
                            "d" => ParseDate::parse($m->getDateCreation()),
                            "c" => $m->getIdCreateur(),
                            "niv" => Niveau::toString($m->getNiveau()),
                            "im" => $m->getImage()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.matiere(nom, date_creation, id_createur, niveau, image) VALUES(:n, :d, :crea, :niv, :im);", array(
                        'n' => $m->getNom(),
                        'd' => ParseDate::parse($m->getDateCreation()),
                        'crea' => $m->getIdCreateur(),
                        'niv' => Niveau::toString($m->getNiveau()),
                        'im' => $m->getImage()
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
                ParseDate::parse($row['date_creation']),
                $row['id_createur'],
                $row['niveau'],
                $row['image']
            );
        }
    }
?>