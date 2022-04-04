<?php
    require_once("bdd.php");
    class EtudiantDAO {
        /**
         * Retourne la liste de tous les etudiants de la base
         */
        public static function getAllEtudiants() {
            $data = BDD::query("SELECT * FROM ETUDIANTS");
            $array = array();
            /*
            foreach($data as $row){
                array_push($array, fromRowTuUser($row));
            }
            */
            return $array;
        }

        public static function getEtudiantByLogin($login){
            $data = BDD::prepAndExec("SELECT * FROM ETUDIANTS WHERE login=:l", array('l' => $login));
            $array = array();
            /*
            foreach($data as $row){
                array_push($array, fromRowTuUser($row));
            }
            */
            return $array;
        }

        public static function createEtudiant(/* Etudiant $u */){
            $array = array();
            /*
            if(EtudiantDAO::getEtudiantByLogin($u->login)){
                $data = BDD::prepAndExec("UPDATE ETUDIANTS SET login=:l, mdp=:mdp, mail=:ma, prenom=:pr, nom=:n, typeEtudiant:tu  WHERE id=:i;", 
                array(
                    'i' => $u->getId(), 
                    'l' => $u->getLogin(),
                    'mdp' => $u->getMdp(),
                    'ma' => $u->getMail(),
                    'pr' => $u->getPrenom(),
                    'n' => $u->getNom(),
                    'tu' => $u->getTypeEtudiant()
                ));
            }
            else{
                $data = BDD::prepAndExec("INSERT INTO ETUDIANTS (id, login, mdp, mail, prenom, nom, typeEtudiant) VALUES (:i, :l, :mdp, :ma, :pr, :n, :tu);", 
                array(
                    'i' => $u->getId(), 
                    'l' => $u->getLogin(),
                    'mdp' => $u->getMdp(),
                    'ma' => $u->getMail(),
                    'pr' => $u->getPrenom(),
                    'n' => $u->getNom(),
                    'tu' => $u->getTypeEtudiant()
                ));
            }
            
            foreach($data as $row){
                array_push($array, fromRowTuUser($row));
            }
            */
            return $array;
        }

        public static function deleteEtudiant($u){
            //BDD::prepAndExec("DELETE FROM ETUDIANTS WHERE id=:i", array('i' => $u->getId()));
        }

        /**
         * Fonction privée traduisant le retour de la BDD en etudiant
         * $row = le résultat de la requête BDD à traduire
         */
        private function fromRowToUser($row){
            /*
            return new Etudiant($row['login'],
            $row['mdp'],
            $row['mail'],
            $row['prenom'],
            $row['nom'],
            $row["typeEtudiant"]);
            */
        }
    }
?>