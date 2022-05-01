<?php 
    class QCMControleur extends Controleur
    {
        public function qcm(Request $request)
        {
            $qcm = QCMDAO::getById($request->getId());
            $reponse = ReponseDAO::getCorrection($qcm);
            $param = [
                'q' => $qcm,
                'r' => $reponse
            ];
            $this->setLayout('home_layout');
            return $this->render('/qcm', $param);
        }

        public function reponseEleve(Request $request)
        {
            $data = $request->getData();
            $reponse = new Reponse(null, $request->getId(), $_SESSION['user']->getLogin() . ".xml");
            //ReponseDAO::create($reponse);
            var_dump($reponse); 
            header("Location: home");
            exit;
        }
    } 
?>