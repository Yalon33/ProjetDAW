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
            // $createur = UtilisateurDAO::getById(intval($mat->getIdCreateur()))->getNom();
            $data = array();
            foreach ($mat as $m) 
            {
                $createur = UtilisateurDAO::getById(intval($m->getIdCreateur()));
                array_push($data,[$m,$createur]);
            }
            $params = [
                'data' => $data,
            ];
            $this->setLayout('home_layout');
            return $this->render('home', $params);
        }
    }

?>
