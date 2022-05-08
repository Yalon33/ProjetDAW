<?php
    class DelCanalControleur extends Controleur
    {
        public function delCanal(Request $request){
            $f = ForumDAO::getById($request->getId());
            $param = [
                'f' => $f->getNom(),
                'canaux' => CanalDAO::getByForum($f)
            ];
            $this->setLayout("home_layout");
            return $this->render("delCanal", $param);
        }

        public function supprimerCanal(Request $request){
            $data = $request->getData();
            $c = CanalDAO::getByNom($data);
            if($c !== false){
                CanalDAO::delete($c);
                header("Location: /forum");
                exit;
            }
            else
            {
                $_SESSION["delCanal"] = false;
                header("Location: /delCanal/".$request->getId());
                exit;
            }
        }
    }
?>