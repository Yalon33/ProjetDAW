<?php
    require_once("bdd.php");
    require_once("../controlleur/message.php");
    class MessageDAO{
        public static function getAll(){
            $data = BDD::query("SELECT * FROM projet.message;");
            $res = array();
            if ($data !== false){
                foreach($data->fetchAll() as $row){
                    array_push($res, new Message($row[0], $row[1]));
               }
            }
            return $res;
        }

        public static function getById($id){
            $data = BDD::prepAndExec("SELECT * FROM projet.message WHERE id=:i;", [":i" => "$id"]);
            $res = array();
            if ($data !== false){
                foreach($data->fetchAll() as $row){
                    array_push($res, new Message($row[0], $row[1]));
               }
            }
            return $res;
        }

        public static function insertMessage($message){
            $arrayMes = [":c" => $message->getContenu()];
            if ($message->getId() == null){
                return BDD::prepAndExec("INSERT INTO projet.message(contenu) VALUES(:c);",$arrayMes) !== false;
            } 
           // else {
           //     array_push($arrayMat, [":i" => $matiere->getId()]);
           //     BDD::prepAndExec("INSERT INTO projet.matiere(id, nom, dateCreation, contenu, createur, tags, niveau) VALUES(:i, :n, :d, :cont, :crea, :t, :n);",$arrayMat);
           // }
        }

        public static function insertMessages($arrayMessage){
            $inserted = true;
            foreach($arrayMessage as $message){
                $inserted = MessageDAO::insertMessage($message);
                if ($inserted === false){
                    return false;
                }
            }
            return true;
        }

        public static function deleteMessages(){
            return BDD::query("DELETE FROM projet.message") !== false;
        }
    }   
?>
