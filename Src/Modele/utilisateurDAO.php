<?php
    class UtilisateurDAO {

        /**
         * Retourne la liste de tous les utilisateurs de la base
         */
        public static function getAllUtilisateurs() {
            $data = BDD::query("SELECT * FROM UTILISATEURS");
            $array = array();
            /*
            foreach($data as $row){
                array_push($array, fromRowTuUser($row));
            }
            */
            return $array;
        }

        public static function getUtilisateurByLogin($login){
            $data = BDD::prepAndExec("SELECT * FROM UTILISATEURS WHERE login=:l", array('l' => $login));
            $array = array();
            /*
            foreach($data as $row){
                array_push($array, fromRowTuUser($row));
            }
            */
            return $array;
        }

        public static function createUtilisateur(/* Utilisateur $u */){
            $array = array();
            /*
            if(UtilisateurDAO::getUtilisateurByLogin($u->login)){
                $data = BDD::prepAndExec("UPDATE UTILISATEURS SET login=:l, mdp=:mdp, mail=:ma, prenom=:pr, nom=:n, typeUtilisateur:tu  WHERE id=:i;", 
                array(
                    'i' => $u->getId(), 
                    'l' => $u->getLogin(),
                    'mdp' => $u->getMdp(),
                    'ma' => $u->getMail(),
                    'pr' => $u->getPrenom(),
                    'n' => $u->getNom(),
                    'tu' => $u->getTypeUtilisateur()
                ));
            }
            else{
                $data = BDD::prepAndExec("INSERT INTO UTILISATEURS (id, login, mdp, mail, prenom, nom, typeUtilisateur) VALUES (:i, :l, :mdp, :ma, :pr, :n, :tu);", 
                array(
                    'i' => $u->getId(), 
                    'l' => $u->getLogin(),
                    'mdp' => $u->getMdp(),
                    'ma' => $u->getMail(),
                    'pr' => $u->getPrenom(),
                    'n' => $u->getNom(),
                    'tu' => $u->getTypeUtilisateur()
                ));
            }
            
            foreach($data as $row){
                array_push($array, fromRowTuUser($row));
            }
            */
            return $array;
        }

        public static function deleteUtilisateur($u){
            //BDD::prepAndExec("DELETE FROM UTILISATEURS WHERE id=:i", array('i' => $u->getId()));
        }

        /**
         * Fonction privée traduisant le retour de la BDD en utilisateur
         * $row = le résultat de la requête BDD à traduire
         */
        private function fromRowToUser($row){
            /*
            return new Utilisateur($row['login'],
            $row['mdp'],
            $row['mail'],
            $row['prenom'],
            $row['nom'],
            $row["typeUtilisateur"]);
            */
        }
    }
?>