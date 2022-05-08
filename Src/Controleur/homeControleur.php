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

        public function suivre(Request $request){
            $data = $request->getData();
            $m = MatiereDAO::getById($data['matiere']);
            if($m !== false){
                if (MatiereSuivieDAO::create($_SESSION["user"], $m, Avancement::ENCOURS) != false){
                    header("Location: /home");
                    exit;
                }
            }
            else
            {
                header("Location: 404");
                exit;
            }
        }
    }
?>