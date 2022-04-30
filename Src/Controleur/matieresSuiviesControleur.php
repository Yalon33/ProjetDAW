<?php

    class MatieresSuiviesControleur extends Controleur
    {
        public function matieres()
        {
            $matieres = MatiereDAO::getByEtudiant($_SESSION['user']);
            $data = array();
            foreach($matieres as $m)
            {
                array_push($data, [$m, Avancement::toString(MatiereSuivieDAO::getAvancement($_SESSION['user'], $m)), UtilisateurDAO::getById($m->getIdCreateur())]);
            }
            $params = [
                'data' => $data
            ];
            $this->setLayout('home_layout');
            return $this->render('matieres', $params);
        }
    }

?>