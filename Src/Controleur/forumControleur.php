<?php
    class ForumControleur extends Controleur
    {
        public function forums()
        {
            $forums = ForumDAO::getAll();
            $canauxForum = array();
            foreach($forums as $form){
                $a = array();
                foreach(CanalDAO::getByForum($form) as $canal){
                    array_push($a, $canal);
                    $createurCanaux[$canal->getId()] = UtilisateurDAO::getById($canal->getIdCreateur())->getNom();
                }
                $canauxForum[$form->getId()] = $a;
            }
            $params = [
                "arrayForum" => $forums,
                "arrayCanal" => $canauxForum,
                "arrayCreateur" => $createurCanaux
            ];
            $this->setLayout('home_layout');
            return $this->render('forums', $params);
        }
    }
?>