<?php
    class DelUserControleur extends Controleur
    {
        public function delUser(){
            $this->setLayout('home_layout');
            return $this->render('/delUser', ["users" => UtilisateurDAO::getAll()]);
        }

        public function suppressionUtilisateur(Request $request){
            $data = $request->getData();
            if ($data["choix"] == "oui"){
                $u = UtilisateurDAO::getById($request->getId());
                if($u !== false)
                {
                    UtilisateurDAO::delete($u);
                    header("Location: /user");
                    exit;
                }
                else{
                    $_SESSION["delUser"] = false;
                    header("Location: /delUser/" . $request->getId());
                    exit;
                }
            }
            else{
                header("Location: /user");
                exit;
            }
        }
    }
?>