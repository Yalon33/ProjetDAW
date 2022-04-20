<?php
    require_once("bdd.php");
    require_once("../Controlleur/matiere.php");
    require_once("../Controlleur/contenu.php");
    class AssociationDAO {

        /**
         * Insère une matiere_contenu dans la base de données
         * 
         * @param Int $id_mat
         * @param Int $id_c
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function createMatiereContenu($id_mat, $id_c){
            $rq = BDD::prepAndExec("SELECT * FROM projet.matiere_contenu WHERE id_mat=:idM AND id_contenus=:idC;", ["idM" => $id_mat, "idC" => $id_c])->fetchAll();
            if (empty($rq)){
                try{
                    return BDD::prepAndExec("INSERT INTO projet.matiere_contenu(id_mat, id_contenus) VALUES(:idM, :idC);",[
                        'idM' => $id_mat,
                        'idC' => $id_c
                    ]);
                } catch (PDOException $e){
                    throw $e;
                }
            }
            return false;
        }

        /**
         * Insère une matiere_tag dans la base de données
         * 
         * @param Int $id_m
         * @param Int $id_t
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function createMatiereTag($id_mat, $id_t){
            if (empty(BDD::prepAndExec("SELECT * FROM projet.matiere_tag WHERE id_mat=:idM AND id_tag=:idT;", ["idM" => $id_mat, "idT" => $id_t])->fetchAll())){
                try{
                    return BDD::prepAndExec("INSERT INTO projet.matiere_tag (id_mat, id_tag) VALUES(:idM, :idT);",[
                        'idM' => $id_mat,
                        'idT' => $id_t
                    ]);
                } catch (PDOException $e){
                    throw $e;
                }
            }
            return false;
        }

        /**
         * Insère un participant au forum dans la base de données
         * 
         * @param Int $id_part
         * @param Int $id_forum
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function createParticipantForum($id_part, $id_forum){
            if (empty(BDD::prepAndExec("SELECT * FROM projet.participer_forum WHERE id_part=:idP AND id_forum=:idF;", ["idP" => $id_part, "idF" => $id_forum])->fetchAll())){
                try{
                    return BDD::prepAndExec("INSERT INTO projet.participer_forum (id_part, id_forum) VALUES(:idP, :idF);",[
                        'idP' => $id_part,
                        'idF' => $id_forum
                    ]);
                } catch (PDOException $e){
                    throw $e;
                }
            }
            return false;
        }

        /**
         * Insère une réponse d'un utilisateur dans la base de données
         * 
         * @param Int $id_uti
         * @param Int $id_rep
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function createReponseUtilisateur($id_uti, $id_rep){
            if (empty(BDD::prepAndExec("SELECT * FROM projet.reponse_utilisateur WHERE id_uti=:idU AND id_rep=:idR;", ["idU" => $id_uti, "idR" => $id_rep])->fetchAll())){
                try{
                    return BDD::prepAndExec("INSERT INTO projet.reponse_utilisateur (id_uti, id_rep) VALUES(:idU, :idR);", [
                        'idU' => $id_uti,
                        'idR' => $id_rep
                    ]);
                } catch (PDOException $e){
                    throw $e;
                }
            }
            return false;
        }
    }
?>