<?php 
    class QCMControleur extends Controleur
    {
        public function qcms(){
            $this->setLayout('home_layout');
            return $this->render('/qcms', ["qcm" => QCMDAO::getAll()]);
        }

        public function qcm(Request $request)
        {
            $qcm = QCMDAO::getById($request->getId());
            $reponse = ReponseDAO::getCorrection($qcm);
            if($qcm !== false and $reponse !== false){
                $param = [
                    'qcm' => $qcm,
                    'correction' => $reponse,
                    'prof' => UtilisateurDAO::getById($qcm->getIdProf()),
                    'reponse' => null
                ];
                $r = ReponseDAO::getCopie($qcm, $_SESSION["user"]);
                if($r !== false){
                    $param["reponse"] = $r;
                }
                $this->setLayout('home_layout');
                return $this->render('/qcm', $param);
            }
            else{
                header("Location: /404");
                exit;
            }
        }

        public function reponseEleve(Request $request)
        {
            //Mise dans la base de données de la réponse du QCM
            $qcm = QCMDAO::getById($request->getId());
            $reponse = new Reponse(null, $request->getId(), $_SESSION['user']->getPrenom()."_".$_SESSION["user"]->getNom()."_".$request->getId().".xml");
            ReponseDAO::create($reponse);
            AssociationDAO::createReponseUtilisateur($_SESSION['user']->getId(), ReponseDAO::getByXML($reponse->getXML())->getId());
            $arrayTag = [];
            $arrayNiveau = [];

            // Création du fichier XML pour gérer le cas où il n'existe pas
            $fd = fopen("files/QCM/Reponse/".$reponse->getXML(), "w");
            fclose($fd);

            //Conversion des résultats du formulaire en xml
            $writer = new XMLWriter();
            $writer->openUri($_SERVER['DOCUMENT_ROOT']. "/files/QCM/Reponse/" . $reponse->getXML());
            $writer->startDocument("1.0", "UTF-8");
            $writer->setIndent(true);
            $writer->setIndentString("    ");
            $writer->startElement("questions");
            foreach($request->getData() as $key => $value){
                $arrayQR = explode('-', $key);
                $writer->startElement("question");
                $writer->writeAttribute('id', $arrayQR[0]);
                $writer->startElement("reponse");
                $writer->writeAttribute("id", $arrayQR[1]);
                $writer->text($value);
                if($qcm->getQuestions() == 'evaluation.xml'){
                    if($arrayQR[0] == 1){
                        array_push($arrayTag, TagDAO::getByContenu($value));
                    }
                    if($arrayQR[0] == 2){
                        array_push($arrayNiveau, Niveau::toType($value));
                    }
                }
                $writer->endElement();
                $writer->endElement();
            }
            $writer->endElement();
            $writer->endDocument();

            //Redirection sur home si le qcm effectué était l'évaluation
            if($qcm->getQuestions() == "evaluation.xml"){
                $recommend = [];
                foreach($arrayTag as $tag){
                    $arrayMat = MatiereDAO::getByTag($tag);
                    foreach($arrayMat as $mat){
                        if(!in_array($mat, $recommend) && in_array($mat->getNiveau(), $arrayNiveau)){
                            array_push($recommend, $mat);
                        }
                    }
                }
                $_SESSION["matiereRecommendee"]= $recommend;
                header("Location: /matieres");
                exit;
            }
            $param = [
                'qcm' => $qcm,
                'correction' => ReponseDAO::getCorrection($qcm),
                'prof' => UtilisateurDAO::getById($qcm->getIdProf()),
                'reponse' => $reponse
            ];
            $this->setLayout('home_layout');
            return $this->render('/qcm', $param);
        }
    } 
?>