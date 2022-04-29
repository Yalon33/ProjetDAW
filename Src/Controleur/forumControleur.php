<?php
    class ForumControleur extends Controleur
    {
        public function forum()
        {
            $forums = ForumDAO::getAll();
            $arrayCanauxForums = array();
            foreach($forums as $form){
                $arrayCanauxForum = array();
                $canauxForum = CanalDAO::getByForum($form);
                if($canauxForum != false)
                {
                    foreach($canauxForum as $canal){
                        array_push($arrayCanauxForum, $canal);
                        $createurCanaux[$canal->getId()] = UtilisateurDAO::getById($canal->getIdCreateur())->getNom();
                    }
                    $arrayCanauxForums[$form->getId()] = $arrayCanauxForum;
                }
            }
            $params = [
                "arrayForum" => $forums,
                "arrayCanal" => $arrayCanauxForums,
                "arrayCreateur" => $createurCanaux
            ];
            $this->setLayout('home_layout');
            return $this->render('forum', $params);
        }
    }
?>