<?php
    class DelUserControleur extends Controleur
    {
        public function delUser(){
            $this->setLayout('home_layout');
            return $this->render('/delUser', ["users" => UtilisateurDAO::getAll()]);
        }

        public function suppressionUtilisateur(Request $request){
            $data = $request->getData();
            var_dump($data);
            $u = UtilisateurDAO::getByLogin($data['name_user']);
            if($u !== false)
            {
                UtilisateurDAO::delete($u);
                header("Location: user");
                exit;
            }
            else{
                $_SESSION["delUser"] = false;
                header("Location: /delUser");
                exit;
            }
        }
    }
?>