<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controlleur/utilisateur.php");
    class UtilisateurDAO {

        /**
         * Retourne la liste de tous les utilisateurs de la base
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
         * Retourne la liste des utilisateurs de la base correspondant au login en paramètre
         * $login = le login de l'utilisateur à rechercher
         */
        public static function getByLogin($login){
            try{
                $data = BDD::prepAndExec("SELECT * FROM projet.UTILISATEUR WHERE login=:l;", array('l' => $login));
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
            }
            $array = array();
            foreach($data as $row){
                array_push($array, self::fromRow($row));
            }
            return $array;
        }

        /**
         * Insère un utilisateur dans la base de données (mise à jour si l'utilisateur existe déjà)
         * $u = l'utilisateur à insérer ou modifier
         */
        public static function create($u){
            if(!is_null($u->getId())){
                if (empty(BDD::prepAndExec("SELECT * FROM projet.utilisateur WHERE id=:i AND login=:l;", [":i" => $u->getId(), ":l" => $u->getLogin()])->fetchAll())){
                    throw new Exception("Impossible de modifier cet utilisateur");
                } else {
                    try{
                        return BDD::prepAndExec("UPDATE projet.UTILISATEUR SET login=:l, mdp=:mdp, mail=:ma, prenom=:pr, nom=:n, type=:tu  WHERE id=:i;", 
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
         * $u = l'utilisateur à supprimer
         */
        public static function delete($u){
            if(!is_null($u->getId()))
                try{
                    return BDD::prepAndExec("DELETE FROM projet.UTILISATEUR WHERE id=:i;", array('i' => $u->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                }
        }

        /**
         * Supprime tous les utilisateurs de la table utilisateur
         *
         * @return bool Renvoie false si la suppression n'a pas eu lieu
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
         * Fonction privée traduisant le retour de la BDD en utilisateur
         * $row = le résultat de la requête BDD à traduire
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