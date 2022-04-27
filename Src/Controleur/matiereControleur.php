<?php
    
    class MatiereControleur extends Controleur
    {
        public function matiere(Request $request)
        {
            $mat = MatiereDAO::getById($request->getId());
            $params = [
                'm' => $mat,
                'p' => UtilisateurDAO::getById($mat->getIdCreateur()),
                'contenus' => ContenuDAO::getByMatiere($mat)
            ];
            $this->setLayout('home_layout');
            return $this->render('matiere', $params);
        }

        public function matiere_all()
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
                'liste_cycle' => $liste_cycle,
            ];
            $this->setLayout('home_layout');
            return $this->render('home', $params);
        }
    }

?>
