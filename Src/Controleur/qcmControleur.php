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
    } 
?>