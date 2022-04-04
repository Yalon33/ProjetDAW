<?php
    require_once("bdd.php");
    require_once("../Controlleur/utilisateur.php");
    class UtilisateurDAO {

        /**
         * Retourne la liste de tous les utilisateurs de la base
         */
        public static function getAllUtilisateurs() {
            $data = BDD::query("SELECT * FROM UTILISATEURS");
            $array = array();
            foreach($data as $row){
                array_push($array, self::fromRowToUser($row));
            }
            return $array;
        }

        /**
         * Retourne la liste des utilisateurs de la base correspondant au login en paramètre
         * $login = le login de l'utilisateur à rechercher
         */
        public static function getUtilisateurByLogin($login){
            $data = BDD::prepAndExec("SELECT * FROM UTILISATEURS WHERE login=:l", array('l' => $login));
            $array = array();
            foreach($data as $row){
                array_push($array, self::fromRowToUser($row));
            }
            return $array;
        }

        /**
         * Insère un utilisateur dans la base de données (mise à jour si l'utilisateur existe déjà)
         * $u = l'utilisateur à insérer ou modifier
         */
        public static function createUtilisateur($u){
            if(!is_null($u->getId())){
                $data = BDD::prepAndExec("UPDATE UTILISATEURS SET login=:l, mdp=:mdp, mail=:ma, prenom=:pr, nom=:n, typeUtilisateur:tu  WHERE id=:i;", 
                array(
                    'i' => $u->getId(), 
                    'l' => $u->getLogin(),
                    'mdp' => $u->getMdp(),
                    'ma' => $u->getMail(),
                    'pr' => $u->getPrenom(),
                    'n' => $u->getNom(),
                    'tu' => $u->getType()
                ));
            }
            else{
                $data = BDD::prepAndExec("INSERT INTO UTILISATEURS (login, mdp, mail, prenom, nom, typeUtilisateur) VALUES (:l, :mdp, :ma, :pr, :n, :tu);", 
                array( 
                    'l' => $u->getLogin(),
                    'mdp' => $u->getMdp(),
                    'ma' => $u->getMail(),
                    'pr' => $u->getPrenom(),
                    'n' => $u->getNom(),
                    'tu' => $u->getType()
                ));
            }      
        }

        /**
         * Supprime l'utilisateur passé en paramètre de la base
         * $u = l'utilisateur à supprimer
         */
        public static function deleteUtilisateur($u){
            if(!is_null($u->getId()))
                BDD::prepAndExec("DELETE FROM UTILISATEURS WHERE id=:i", array('i' => $u->getId()));
        }

        /**
         * Fonction privée traduisant le retour de la BDD en utilisateur
         * $row = le résultat de la requête BDD à traduire
         */
        private static function fromRowToUser($row){
            return new Utilisateur(
                $row['id'],
                $row['login'],
                $row['mdp'],
                $row['mail'],
                $row['prenom'],
                $row['nom'],
                $row["typeUtilisateur"]
            );
        }
    }
?>