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
    }

?>