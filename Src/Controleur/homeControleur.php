<?php
    class HomeControleur extends Controleur
    {
        public function home()
        {
            $mat = MatiereDAO::getAll();
            $data = array();
            $liste_cycle = array();
            foreach ($mat as $m) 
            {
                $createur = UtilisateurDAO::getById(intval($m->getIdCreateur()));
                array_push($data,[$m,$createur]);
                if(!in_array(Niveau::toString($m->getNiveau()),$liste_cycle))
                {
                array_push($liste_cycle,Niveau::toString($m->getNiveau()));
                }
            }
            $params = [
                'data' => $data,
                'liste_cycle' => $liste_cycle
            ];
            $this->setLayout('home_layout');
            return $this->render('home', $params);
        }
    }
?>