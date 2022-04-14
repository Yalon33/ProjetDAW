<?php
    require_once("bdd.php");
    require_once("../Controlleur/utilisateur.php");
    class UtilisateurDAO {

        /**
         * @return array[Utilisateur] Les utilisateurs dans la base
         */
        public static function getAll() {
            try{
                $data = BDD::query("SELECT * FROM projet.utilisateur;");
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
         * @param string $login = le login de l'utilisateur à rechercher
         * @return array[Utilisateur] Les utilisateurs ayant le login en paramètre
         */
        public static function getByLogin($login){
            try{
                $data = BDD::prepAndExec("SELECT * FROM projet.UTILISATEUR WHERE login=:l;", array('l' => $login))->fetchAll()[0];
                if ($data !== false){
                    return self::fromRow($data);
                }
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Insère un utilisateur dans la base de données (mise à jour si l'utilisateur existe déjà)
         *
         * @param Utilisateur $u
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($u){
            if(!is_null($u->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.utilisateur SET login=:l, mdp=:mdp, mail=:ma, prenom=:pr, nom=:n, type=:tu  WHERE id=:i;", 
                        array(
                            'i' => $u->getId(), 
                            'l' => $u->getLogin(),
                            'mdp' => $u->getMdp(),
                            'ma' => $u->getMail(),
                            'pr' => $u->getPrenom(),
                            'n' => $u->getNom(),
                            'tu' => TypeUtilisateur::toString($u->getType())
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
            else{
                try{
                    return BDD::prepAndExec("INSERT INTO projet.utilisateur (login, mdp, mail, prenom, nom, type) VALUES (:l, :mdp, :ma, :pr, :n, :tu);", 
                    array( 
                        'l' => $u->getLogin(),
                        'mdp' => $u->getMdp(),
                        'ma' => $u->getMail(),
                        'pr' => $u->getPrenom(),
                        'n' => $u->getNom(),
                        'tu' => TypeUtilisateur::toString($u->getType())
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime l'utilisateur passé en paramètre de la base
         * 
         * @param Utilisateur $u
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($u){
            if(!is_null($u->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.UTILISATEUR WHERE id=:i;", array('i' => $u->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime tous les utilisateurs de la table utilisateur
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.utilisateur;") !== false;
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en Utilisateur
         *
         * @param array[] $row
         * @return Utilisateur
         */
        private static function fromRow($row){
            return new Utilisateur(
                $row['id'],
                $row['login'],
                $row['mdp'],
                $row['mail'],
                $row['prenom'],
                $row['nom'],
                $row['type']
            );
        }
    }
?>