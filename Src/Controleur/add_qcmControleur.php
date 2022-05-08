<?php
    class AddQcmControleur extends Controleur{
        public function addQcm(){
            $this->setLayout('home_layout');
            return $this->render("/addQcm");
        }

        public function ajoutQCM(Request $request){
            $data = $request->getData();
            $q = new qcm(null, $_SESSION['user']->getId(), basename($_FILES["qcm_form"]["name"]));

            if(QCMDAO::create($q) !== false){
                $q = QCMDAO::getByQuestions($q->getQuestions());
                if ($q !== false){
                    $target_dir = "files/QCM/Question/";
                    $target_file = $target_dir . $q->getQuestions();
                    move_uploaded_file($_FILES["qcm_form"]["tmp_name"], $target_file);
                    header("Location: /qcm");
                    exit;
                }
            }
            else
            {
                $_SESSION["newQCM"] = false;
                header("Location: /addQcm");
                exit;
            }
        }
    }
?>