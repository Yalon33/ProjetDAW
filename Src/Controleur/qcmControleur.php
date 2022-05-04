<?php 
    class QCMControleur extends Controleur
    {
        public function qcm(Request $request)
        {
            $qcm = QCMDAO::getById($request->getId());
            $reponse = ReponseDAO::getCorrection($qcm);
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

        public function reponseEleve(Request $request)
        {
            $reponse = new Reponse(null, $request->getId(), $_SESSION['user']->getPrenom()."_".$_SESSION["user"]->getNom()."_".$request->getId().".xml");
            ReponseDAO::create($reponse);
            AssociationDAO::createReponseUtilisateur($_SESSION['user']->getId(), ReponseDAO::getByXML($reponse->getXML())->getId());
            $fd = fopen("files/QCM/Reponse/".$reponse->getXML(), "w");
            fclose($fd);
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
                $writer->endElement();
                $writer->endElement();
            }
            $writer->endElement();
            $writer->endDocument();

            $qcm = QCMDAO::getById($request->getId());
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