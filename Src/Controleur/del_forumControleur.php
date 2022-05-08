<?php
    class DelForumControleur extends Controleur
    {
        public function delForum(){
            $this->setLayout("home_layout");
            return $this->render("delForum", ['forums' => ForumDAO::getAll()]);
        }

        public function supprimerForum(Request $request){
            $data = $request->getData();
            $forum = ForumDAO::getByNom($data["nom_form"]);
            if($forum !== false){
                ForumDAO::delete($forum);
                header("Location: /forum");
                exit;
            }
            else {
                $_SESSION["delForum"] = false;
                header("Location: /delForum");
                exit;
            }
        }
    }
?>