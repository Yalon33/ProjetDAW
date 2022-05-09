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
            if(array_key_exists("matiereRecommendee", $_SESSION) and !empty($_SESSION["matiereRecommendee"])){
                $recommend=[];
                $arrayMat = $_SESSION["matiereRecommendee"];
                foreach($arrayMat as $mat){
                    array_push($recommend, [$mat, UtilisateurDAO::getById($mat->getIdCreateur())]);
                }
            } else {
                $suivi = MatiereDAO::getByEtudiant($_SESSION['user']);
                $recommend = [];
                foreach($suivi as $matS)
                {
                    $tagMat = TagDAO::getByMatiere($matS);
                    foreach($tagMat as $tag)
                    {
                        $matTag = MatiereDAO::getByTag($tag);
                        foreach($matTag as $matT)
                        {
                            $prof = UtilisateurDAO::getById($matT->getIdCreateur());
                            if(!in_array([$matT, $prof], $recommend) && !in_array($matT, $suivi))
                            {
                                array_push($recommend, [$matT, $prof]);
                            }
                        }
                    }
                }
            }
            $params = [
                'data' => $data,
                'matiereRecommendee' => $recommend
            ];
            $this->setLayout('home_layout');
            return $this->render('matieres', $params);
        }
    }
?>