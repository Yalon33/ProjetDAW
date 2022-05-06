<?php
    class DelQCMControleur extends Controleur{
        public function delQCM(){
            $this->setLayout('home_layout');
            return $this->render("/delQCM");
        }

        public function valid(Request $request){
            if($request->getData()[0] == 1){
                $qcm = QCMDAO::getById($request->getId());
                $fd = unlink("../files/QCM/Question/".$qcm->getQuestions());
                QCMDAO::delete($qcm);
                header("Location: /qcm");
                exit;
            }
            header("Location: /qcm/".$request->getId());
        }
    }
?>