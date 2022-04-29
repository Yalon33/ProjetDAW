<?php
    class ForumControleur extends Controleur
    {
        public function forum()
        {
            $forums = ForumDAO::getAll();
            $canauxForums = array();
            foreach($forums as $form){
                $canauxForum = array();
                foreach(CanalDAO::getByForum($form) as $canal){
                    array_push($canauxForum, $canal);
                    $createurCanaux[$canal->getId()] = UtilisateurDAO::getById($canal->getIdCreateur())->getNom();
                }
                $canauxForums[$form->getId()] = $canauxForum;
            }
            $params = [
                "arrayForum" => $forums,
                "arrayCanal" => $canauxForums,
                "arrayCreateur" => $createurCanaux
            ];
            $this->setLayout('home_layout');
            return $this->render('forum', $params);
        }
    }
?>