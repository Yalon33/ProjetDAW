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
         * @param entier $id
         * @return Matiere La matière de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                return BDD::prepAndExec("SELECT * FROM projet.matiere WHERE id=:i;", [":i" => "$id"])->fetchALL()[0];
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère une matière dans la base de données (mise à jour si la matière existe déja)
         * 
         * @param Matiere $matiere
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($m){
            if (!is_null($m->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.matiere SET nom=:n, dateCreation=:d, contenu=:d, createur=:c, tag=:t, niveau=:niv) WHERE id=:i;",
                        [":n" => $m->getNom(),
                        ":d" => ParseDate::toBDD($m->getDateCreation()),
                        ":cont" => $m->getContenu(),
                        ":crea" => $m->getCreateur()->getId(),
                        ":t" => $m->getTags(),
                        ":niv" => Niveau::toString($m->getNiveau())
                        ]);
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.matiere(nom, dateCreation, createur, niveau) VALUES(:n, :d, :crea, :niv);", array(
                        'n' => $m->getNom(),
                        'd' => ParseDate::toBDD($m->getDateCreation()),
                        'crea' => $m->getCreateur()->getId(),
                        'niv' => Niveau::toString($m->getTag())
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
                return BDD::query("DELETE FROM projet.utilisateur;");
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
                $row['dateCreation'],
                $row['contenu'],
                $row['createur'],
                $row['tags'],
                $row['niveau']
            );
        }
    }
?>